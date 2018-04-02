<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partido;
use App\Liga; 
use App\Equipo; 
use App\User; 
use App\Publicacion; 
use Auth; 
use App\Http\Requests\PublicacionRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EmailNotification;
use Session;

class PublicacionController extends Controller{

    public function __construct(){
        $this->middleware('auth', ["only" => ["store", "match", "show", "publicacionesUsuario"]]);
    }

    //Envio de publicaciones activas al muro
	public function getPublicaciones(){
    	return Publicacion::getPublicacionesActivasMuro();
	}

	public function store(PublicacionRequest $request){
		$user = Auth::user();
		if ($user) {
			$liga = Liga::findOrFail($request->league);
			$equipoRetador = Equipo::findOrFail($request->id_retador);
			 
			//Calcular fecha de final del partido
			$fechaPartido = $request->date;
			$fechaFinalPartido = date('Y-m-d H:i:s', strtotime('+110 minute', strtotime($fechaPartido)));
			
			try {
				//Obtener equipo receptor solo si la publicación se crea satisfactoriamente
				$idEquipoReceptor = $request->id_retador == $request->idHomeTeam ? $request->idAwayTeam : $request->idHomeTeam;
				$equipoReceptor = Equipo::findOrFail($idEquipoReceptor);
				$estadoPublicacion = $request->estado_pago;
				$valorPublicacion = str_replace([",","$"], "", $request->valor);

				//Validar si el partido ya esta guardado en BD
				$partido = Partido::getPartidoByEquiposAndFecha($request->idHomeTeam, $request->idAwayTeam, $fechaPartido);
				if (is_null($partido)) {
					// Crear publicacion de nuevo partido
					$partido = Partido::create(["id" => $request->partido, "id_liga" => $liga->id, "id_local" => $request->idHomeTeam, "id_visitante" => $request->idAwayTeam, "fecha_inicio" => $fechaPartido, "fecha_final" => $fechaFinalPartido]);
				}

				//Crear la publicacion y retonar el mensaje de respuesta satisfactorio con las variables necesarias
				$publicacion = Publicacion::create(['id_partido' => $partido->id, 'id_usu_retador' => $user->id, 'id_equipo_retador' => $equipoRetador->id, 'id_equipo_receptor' => $equipoReceptor->id, 'valor' => $valorPublicacion, 'valor_ganado' => $request->valor_ganado, "estado" => $estadoPublicacion]);

				$linkCompartir = "publicaciones/".$publicacion->id;
				$publicacion->link = $linkCompartir;
				$publicacion->save();

				//Validar si hay que restar el credito del usuario, ya que tiene saldo disponible para pagar
				if ($estadoPublicacion == 0) {
					$user->saldo = $user->saldo - $valorPublicacion;
					$user->save();
				}

				return response()->json(["success" => "Se ha creado la publicación satisfactoriamente", "link" => url("publicaciones/".$publicacion->id), "publicacion" => $publicacion->id, "equipoRetador" => $equipoRetador, "saldo" => $user->saldo]);		

			}catch (Exception $e) {
				return response()->json(["success" => $e]);		
			}
		}else{
			return response()->json(["error" => "El usuario no se encuentra autenticado"]);
		}
	}

	public function match(Request $request){
		$valorPublicacion = $request->valor;
		$this->usuarioReceptor = Auth::user();
		$publicacion = Publicacion::findOrFail($request->id);
		$publicacion->id_usu_receptor = $this->usuarioReceptor->id;
		$publicacion->estado = 1;
		$publicacion->save();

		$this->usuarioReceptor->saldo = $this->usuarioReceptor->saldo - $valorPublicacion;
		$this->usuarioReceptor->save();
		$this->usuarioRetador = $publicacion->usuarioRetador;

		// Notificar a los usuarios del match
        $imagen = "match";
        $titulo = "Felicitaciones, encontraste tu Match!";
        $descripcion = "Tu publicación encontró el contrincante. Si tu equipo gana recibirás $".number_format($publicacion->valor_ganado); 
        $labelButton = "Continua publicando!";
        $url = url("publicar");
		$subject = 'Felicitaciones, Encontraste tu match en Parti2';

	    $this->usuarioRetador->notify(new EmailNotification($imagen, $titulo, $descripcion, $labelButton, $url, $subject));
	    $this->usuarioReceptor->notify(new EmailNotification($imagen, $titulo, $descripcion, $labelButton, $url, $subject));

	    //Notificar a los usuarios en espera de pago para hacer match
	    Publicacion::hasIntencionesMatch($publicacion, $this->usuarioReceptor);

		return response()->json(["success" => "Se ha creado el match con tu contrincante!", "saldo" => $this->usuarioReceptor->saldo]);		
	}

	public function show($idPublicacion){
		$publicacion = Publicacion::getPublicacionesActivas($idPublicacion)->first();
		
		if (is_null($publicacion->equipo_local->usuario)) {
			$publicacion->equipo_local->usuario = $publicacion->usuarioReceptor;
		}else{
			$publicacion->equipo_visitante->usuario = $publicacion->usuarioReceptor;
		}

		$publicacion->ganador = $publicacion->getGanadorPublicacion();
		dd($publicacion);
		return view("pages.dashboard.detalle-publicacion", compact("publicacion"));
	}

	public function publicacionesUsuario(){
		$publicaciones = Publicacion::getPublicacionesActivas("user");
		$publicacionesUsuario = $publicaciones->sortByDesc(function ($publicacion) {
   			return $publicacion->partido->fecha_inicio;
		});	
		
		return view('pages.dashboard.publicaciones', compact("publicacionesUsuario"));
	}

	//Los pagos vienen con metodos de pago inmediatos (tarjeta de credito)
	public function respuestaPasarela(Request $request){
		$signature = hash('sha256', $request->x_cust_id_cliente.'^86c18a3ad068b30d14c99a47940ad176bb0c7721^'.$request->x_ref_payco.'^'.$request->x_transaction_id.'^'.$request->x_amount.'^'.$request->x_currency_code);

		if ($signature == $request->x_signature) {
			$publicacion = Publicacion::findOrFail($request->x_id_invoice);
			switch ($request->x_cod_response) {
				//Transacción Aceptada
				case 1:
					$tipoPublicacion = $request->x_extra1;
					if ($tipoPublicacion == "publicacion") {
						$publicacion->estado = 0;
						$publicacion->save();

						//Actualizamos el saldo del usuario a $0
						$usuario = $publicacion->usuarioRetador;
						$usuario->saldo = 0;
						$usuario->save();
					}else{
						//Se ha creado el match
						$this->usuarioReceptor = User::findOrFail($request->x_extra2);
						$this->usuarioRetador = $publicacion->usuarioRetador;

						//Actualizamos el estado de la publicación
						$publicacion->id_usu_receptor = $this->usuarioReceptor->id;
						$publicacion->estado = 1;
						$publicacion->save();

						//Actualizamos el estado del saldo
						$this->usuarioReceptor->saldo = 0;
						$this->usuarioReceptor->save();
				
						// Notificar a los usuarios del match
				        $imagen = "match";
				        $titulo = "Felicitaciones, encontraste tu Match!";
				        $descripcion = "Tu publicación encontró el contrincante. Si tu equipo gana recibirás $".number_format($publicacion->valor_ganado); 
				        $labelButton = "Continua publicando!";
				        $url = url("publicar");
						$subject = 'Felicitaciones, Encontraste tu match en Parti2';

					    $this->usuarioRetador->notify(new EmailNotification($imagen, $titulo, $descripcion, $labelButton, $url, $subject));
					    $this->usuarioReceptor->notify(new EmailNotification($imagen, $titulo, $descripcion, $labelButton, $url, $subject));

					    //Notificar a los usuarios en espera de pago para hacer match
	    				Publicacion::hasIntencionesMatch($publicacion, $this->usuarioReceptor);
					}
					return redirect()->to("publicaciones/".$publicacion->id);
					break;

				//Transacción en espera
				case 3:
					if ($request->x_franchise == "BA" || $request->x_franchise == "EF" || $request->x_franchise == "GA" || $request->x_franchise == "PR" || $request->x_franchise == "RS" || $request->x_franchise == "PSE") {
						cookie('espera', true, 1);

						//Se crea al intencion si la pubicacion esta en espera del match
						$publicacion->intenciones()->attach($request->x_extra2);
					}
					return redirect()->to("publicaciones/".$publicacion->id);
					break;

				//Transacción Rechazada
				case 2:
				case 4:
					$publicacion->delete();
					return redirect()->to("publicar");
					break;
			}
		}		
	}
	
	// Los pagos vienen de metodos de pago por efectivo
	public function confirmacionPasarelaPublicacion(Request $request){
        //Validar firma
        $signature = hash('sha256', $request->x_cust_id_cliente.'^86c18a3ad068b30d14c99a47940ad176bb0c7721^'.$request->x_ref_payco.'^'.$request->x_transaction_id.'^'.$request->x_amount.'^'.$request->x_currency_code);
        
        if ($signature == $request->x_signature) {
        	$publicacion = Publicacion::findOrFail($request->x_id_invoice);

        	//Activar publicacion: estado 3 - Activar Match: estado 0
            if ($publicacion->estado == 3 || $publicacion->estado == 0) {
                switch ($request->x_cod_response) {
                    //Transacción Aceptada
                    case 1:
                        $tipoPublicacion = $request->x_extra1;
                        if ($tipoPublicacion == "publicacion") {
                            $publicacion->estado = 0;
                            $publicacion->save();

                            //Actualizamos el saldo del usuario a $0
                            $usuario = $publicacion->usuarioRetador;
                            $usuario->saldo = 0;
                            $usuario->save();

                            return "Publicación exitosa";
                        }else{
                            //Se ha creado el match    
                            $this->usuarioReceptor = User::findOrFail($request->x_extra2);                   
                            $this->usuarioRetador = $publicacion->usuarioRetador;

                            //Actualizamos el estado de la publicacion
                            $publicacion->id_usu_receptor = $this->usuarioReceptor->id;
                            $publicacion->estado = 1;
                            $publicacion->save();

                            //Actualizamos el estado del saldo
                            $this->usuarioReceptor->saldo = 0;
                            $this->usuarioReceptor->save();
                    
                            // Notificar a los usuarios del match
                            $imagen = "match";
                            $titulo = "Felicitaciones, encontraste tu Match!";
                            $descripcion = "Tu publicación encontró el contrincante. Si tu equipo gana recibirás $".number_format($publicacion->valor_ganado); 
                            $labelButton = "Continua publicando!";
                            $url = url("publicar");
                            $subject = 'Felicitaciones, Encontraste tu match en Parti2';

                            $this->usuarioRetador->notify(new EmailNotification($imagen, $titulo, $descripcion, $labelButton, $url, $subject));
                            $this->usuarioReceptor->notify(new EmailNotification($imagen, $titulo, $descripcion, $labelButton, $url, $subject));

                            //Notificar a los usuarios en espera de pago para hacer match
	    					Publicacion::hasIntencionesMatch($publicacion, $this->usuarioReceptor);

	    					return "Match exitoso";
                        }
                        break;
                    //Transaccion Rechazada
                    case 2:
                    case 4:
                        return "Transaccion rechazada o declinada";
                        break;
                }
            }elseif($publicacion->estado == 1){
            	$usuarioReceptor = User::findOrFail($request->x_extra2);
            	foreach ($publicacion->intenciones as $usuario) {
            		if ($usuario->id == $usuarioReceptor->id) {
            			$valor = $request->x_amount_base;

            			//Actualizar el saldo al usuario
            			$usuario->saldo = $usuario->saldo + $valor;
            			$usuario->save();

        				// Notificar al usuario pagador que ya habia perdido el match y que se acaba de recargar el saldo
                        $imagen = "empate";
                        $titulo = "Saldo recargado!";
                        $descripcion = "Se te han recargado $ ".number_format($valor)." a tu saldo, ya que tu publicación a favor de ".$publicacion->equipoReceptor->nombre." para hacer match habia perdido su oportunidad";
                        $labelButton = "Continua publicando!";
                        $url = url("publicar");
                        $subject = 'Haz recargado tu credito en Parti2';

                        $usuarioReceptor->notify(new EmailNotification($imagen, $titulo, $descripcion, $labelButton, $url, $subject));
            		}
            	}
            	return "Se ha recargado el saldo al usuario que habia perdido la oportunidad de hacer match";
            }else{
            	return "El estado de la publicacion no es 3 ni 1 ni 0";
            }
        }else{
        	return "No coincide la firma";
        }
    }
}




	