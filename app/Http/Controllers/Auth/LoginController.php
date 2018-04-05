<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller{
    use AuthenticatesUsers{
        authenticated as performAuthenticated;
    }

    protected $redirectTo = '/';

    public function __construct(){
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, $user){
        if ($user->tipo == 1) {
            return redirect()->to("admin/solicitudes");
        }
    }
}