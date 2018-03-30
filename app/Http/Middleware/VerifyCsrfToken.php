<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware{
  
    protected $except = [
    	// "perfil*",
    	// "credito/agregar*"
    	// "api/item*"
    	// "api/publicar/confirmacion*"
    ];
}
