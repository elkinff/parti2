<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller{

    use SendsPasswordResetEmails{
        sendResetLinkResponse as performSendResetLinkResponse;
    }
    
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function sendResetLinkResponse($response){
        alert()->info('Revisa tu bandeja de entrada para cambiar tu contraseña','Correo electrónico enviado');
        return back()->with('status', trans($response));
    }
}
