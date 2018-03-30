<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminMiddleware{
    
    public function handle($request, Closure $next){
        if (Auth::user()->tipo == 1) {
            return $next($request);    
        }else{
            return redirect()->to("https://parti2.com");
        }
    }
}
