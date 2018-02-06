<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Publicacion;

class HomeController extends Controller{

    public function index(){
    	$publicaciones = Publicacion::whereEstado(0)->get();
    	foreach ($publicaciones as $publicacion) {
    		$partido = $publicacion->partido;
	      
	        $publicacion->equipo_local = $partido->equipoLocal;
	        $publicacion->equipo_visitante = $partido->equipoVisitante;

	        //Asignar usuario al equipo por el que aposto
	        if ($publicacion->id_equipo_retador == $publicacion->equipo_local->id) {
	            $publicacion->equipo_local->usuario = $publicacion->usuarioRetador;
	        }else{
	            $publicacion->equipo_visitante->usuario  = $publicacion->usuarioRetador;
	        }
    	}
    
        return view('pages.dashboard.muro', compact("publicaciones"));

    }
}
