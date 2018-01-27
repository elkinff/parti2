<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicacionController extends Controller{
    
    public function __construct(){
        $this->middleware('auth');
    }

	public function store(PublicacionRequest $request){
		//Calcular fecha de final del partido
		$fechaFixture = $request->date;
		

		
		//crear partido
		$partido = Partido::create(["id_local" => $request->idHomeTeam, "id_visitante" => $request->idAwayTeam, "fecha_inicio" => , "fecha_final" => ])
	}
}
