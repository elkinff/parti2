<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partido;
use App\Liga; 
use App\Equipo; 
use Auth; 

class PublicacionController extends Controller{
    
    public function __construct(){
        // $this->middleware('auth');
    }

	public function store(Request $request){
		dd(Auth::user());
		// dd("ss");
		$liga = Liga::findOrFail($request->league);
		dd($liga);
		$equipoRetador = Equipo::findOrFail($request->id_retador);

		//Calcular fecha de final del partido
		$fechaPartido = $request->date;
		$fechaFinalPartido = strtotime($fechaPartido);

		// crear publicacion de nuevo partido
		// $partido = Partido::create(["id_local" => $request->idHomeTeam, "id_visitante" => $request->idAwayTeam, "fecha_inicio" => $fechaPartido, "fecha_final" => ]);
	}
}
