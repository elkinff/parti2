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
use App\Http\Requests\ItemRequest;
use Cookie;

class PublicacionController extends Controller{

    public function __construct(){
        $this->middleware('auth', ["only" => ["store", "match", "show"]]);
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

				//Validar si hay que restar el credito del usuario
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
		$this->usuarioReceptor = Auth::user();
		$publicacion = Publicacion::findOrFail($request->id);
		$publicacion->id_usu_receptor = $this->usuarioReceptor->id;
		$publicacion->estado = 1;
		$publicacion->save();
		$this->usuarioRetador = $publicacion->usuarioRetador;
		$valorPublicacion = $request->valor;

		//Validar si hay que restar el credito del usuario
		$estadoPublicacion = $request->estado_pago;
		if ($estadoPublicacion == 0) {
			$this->usuarioReceptor->saldo = $this->usuarioReceptor->saldo - $valorPublicacion;
			$this->usuarioReceptor->save();
		}

		//Enviar notificaciones de match realizado
		// Mail::send('', [], function ($message){
	 //        $message->subject('Has encontrado tu match en parti2');
	 //        $message->to([$this->usuarioRetador->email, $this->usuarioReceptor->email]);
  //       });

		return response()->json(["success" => "Se ha creado el match con tu contrincante!"]);		
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

	public function respuestaPaserela(Request $request){
		$idPublicacion = $request->x_id_invoice;

		$publicacion = Publicacion::getPublicacionesActivas($idPublicacion);

		return view("pages.dashboard.detalle-publicacion", compact("publicacion"));
	}

	public function confirmacionPasarela(Request $request){
		//Validar firma
		$signature = hash('sha256', $request->x_cust_id_cliente.'^86c18a3ad068b30d14c99a47940ad176bb0c7721^'.$request->x_ref_payco.'^'.$request->x_transaction_id.'^'.$request->x_amount.'^'.$request->x_currency_code);

		if ($signature == $request->signature) {
			$codigoRespuesta = $request->x_cod_response;
			if ($codigoRespuesta == 1) {
				$idPublicacion = $request->x_id_invoice;
				$publicacion = Publicacion::findOrFail($idPublicacion);
				// dd($publicacion);

				$publicacion->estado = 0;
				$publicacion->save();

				//Actualizamos el saldo del usuario a $0
				$usuario = $publicacion->usuarioRetador;
				$usuario->saldo = 0;
				$usuario->save();
				$mensaje ="Realizada publicacion";
			}else{
				$mensaje ="No Realizada, estado = ".$codigoRespuesta;
			}
		}else{
			$mensaje = "No coincide la firma";
		}

		$nombre_archivo = public_path("confirmacion/response-".$request->x_id_invoice.".txt"); 
		$archivo = fopen($nombre_archivo, "w+");
		fwrite($archivo,$mensaje);
		fclose($archivo);
		return $mensaje;
	}

}






