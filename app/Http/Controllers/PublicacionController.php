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

class PublicacionController extends Controller{

    public function __construct(){
        $this->middleware('auth', ["only" => ["store", "match", "show", "publicacionesUsuario"]]);
    }

    //Envio de publicaciones activas al muro
	public function getPublicaciones(){
    	return Publicacion::getPublicacionesActivas("All");
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

		return response()->json(["success" => "Se ha creado el match con tu contrincante!", "saldo" => $this->usuarioReceptor->saldo]);		
	}

	public function show($idPublicacion){
		$publicacion = Publicacion::getPublicacionesActivas($idPublicacion)->first();
		if (is_null($publicacion->equipo_local->usuario)) {
			$publicacion->equipo_local->usuario = $publicacion->usuarioReceptor;
		}else{
			$publicacion->equipo_visitante->usuario = $publicacion->usuarioReceptor;
		}

		return view("pages.dashboard.detalle-publicacion", compact("publicacion"));
	}

	public function publicacionesUsuario(){
		$publicaciones = Publicacion::getPublicacionesActivas("user");
		$publicacionesUsuario = $publicaciones->sortByDesc(function ($publicacion, $key) {
   			return $publicacion->partido->fecha_inicio;
		});	
		// dd($publicacionesUsuario);
		return view('pages.dashboard.publicaciones', compact("publicacionesUsuario"));
	}

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
					}
					return redirect()->to("publicaciones/".$publicacion->id);
					break;

				//Transaccion en espera
				case 3:
					return redirect()->to("publicaciones/".$publicacion->id);
					break;

				//Transaccion Rechazada
				case 2:
				case 4:
					$publicacion->delete();
					return redirect()->to("publicar");
					break;
			}
		}		
	}
	
	public function confirmacionPasarelaPublicacion(Request $request){
        //Validar firma
        $signature = hash('sha256', $request->x_cust_id_cliente.'^86c18a3ad068b30d14c99a47940ad176bb0c7721^'.$request->x_ref_payco.'^'.$request->x_transaction_id.'^'.$request->x_amount.'^'.$request->x_currency_code);
        
        if ($signature == $request->x_signature) {
            $publicacion = Publicacion::findOrFail($request->x_id_invoice);
            if ($publicacion->estado == 3) {
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
                        }
                        break;

                    //Transaccion Rechazada
                    case 2:
                    case 4:
                        $publicacion->delete();
                        break;
                }
            }
        }
    }
}




	