<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UsuarioController extends Controller{
    
    public function __construct(){
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->usuario = Auth::user();
            return $next($request);
        });
    }

    public function index(){
    	return view("pages.dashboard.perfil")->with("usuario", $this->usuario);
    }
}
