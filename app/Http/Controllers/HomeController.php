<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Publicacion;

class HomeController extends Controller{

    public function index(){
    	$publicaciones = Publicacion::whereEstado(0)->get();
    	$valor_maximo = $publicaciones->max("valor");
    	$valor_minimo = $publicaciones->min("valor");

    	if (!isset($_COOKIE["galleta"])) {
    		setcookie('primera_vez', true, time() + 365 * 24 * 60 * 60); 
    		alert()->info('Disfruta ganando dinero con tu equipo, empieza a apostar ya.','Bienvenido!');
    	}
    	
        return view('pages.dashboard.muro', compact("valor_maximo", "valor_minimo"));

    }
}
