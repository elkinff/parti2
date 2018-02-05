<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partido;
use App\Liga; 
use App\Equipo; 
use App\Publicacion; 
use Auth; 
use App\Http\Requests\PublicacionRequest;
use App\Http\Requests\ItemRequest;

class PublicacionController extends Controller{
    
    // public function __construct(){
    //     $this->middleware('auth');
    // }

	public function store(PublicacionRequest $request){
		// dd($request->all());
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

				//Validar si el partido ya esta guardado en BD
				$partido = Partido::getPartidoByEquiposAndFecha($request->idHomeTeam, $request->idAwayTeam, $fechaPartido);
				if (is_null($partido)) {
					// Crear publicacion de nuevo partido
					$partido = Partido::create(["id_liga" => $liga->id, "id_local" => $request->idHomeTeam, "id_visitante" => $request->idAwayTeam, "fecha_inicio" => $fechaPartido, "fecha_final" => $fechaFinalPartido]);
				}

				//Crear la publicacion y retonar el mensaje de respuesta satisfactorio con las variables necesarias
				$publicacion = Publicacion::create(['id_partido' => $partido->id, 'id_usu_retador' => $user->id, 'id_equipo_retador' => $equipoRetador->id, 'id_equipo_receptor' => $equipoReceptor->id, 'valor' => str_replace([",","$"], "", $request->valor), 'valor_ganado' => $request->valor_ganado, "estado" => $request->estado_pago]);

				return response()->json(["success" => "Se ha creado la publicación satisfactoriamente", "link" => url("publicaciones/".$publicacion->id), "publicacion" => $publicacion->id]);		

			}catch (Exception $e) {
				return response()->json(["success" => $e]);		
			}
		}else{
			return response()->json(["error" => "El usuario no se encuentra autenticado"]);
		}
	}

	public function show($idPublicacion){
		dd(Publicacion::findOrFail($idPublicacion)->equipoRetador);
	}
}
