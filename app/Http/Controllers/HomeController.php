<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Publicacion;
use Redirect;

class HomeController extends Controller{

    public function index(){
    	$publicaciones = Publicacion::whereEstado(0)->get();
    	$valor_maximo = $publicaciones->max("valor");
    	$valor_minimo = $publicaciones->min("valor");

        return view('pages.dashboard.muro', compact("valor_maximo", "valor_minimo"));

    }
}
