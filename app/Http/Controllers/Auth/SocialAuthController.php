<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;
use Mail;

class SocialAuthController extends Controller{
    
    // Metodo encargado de la redireccion a Facebook
    public function redirectToProvider($provider){
        return Socialite::driver($provider)->redirect();
    }
    
    // Metodo encargado de obtener la información del usuario
    public function handleProviderCallback($provider){
        // Obtenemos los datos del usuario
        $social_user = Socialite::driver($provider)->user(); 

        // Comprobamos si el usuario ya existe
        if ($user = User::where('email', $social_user->email)->first()) { 
            return $this->authAndRedirect($user); // Login y redirección
        } else {  
            // En caso de que no exista creamos un nuevo usuario con sus datos.
            $this->user = User::create([
                'nombre' => $social_user->name,
                'email' => $social_user->email,
                'foto' => $social_user->avatar_original,
                'id_'.$provider => $social_user->id,
                'validado' => 1
            ]);

            //Envio de correo de bienvenida
            $imagen = "bienvenida";
            $titulo = "Bienvenido!";
            $descripcion = "Parti2 es una aplicación donde podrás ganar dinero con tu equipo favorito en tres simples pasos"; 
            $labelButton = "Empieza ya!";

            $url = url("/");
            
            Mail::send('emails.email', ['imagen' => $imagen, 'titulo' => $titulo, 'descripcion' => $descripcion, "labelButton" => $labelButton, "url" => $url], function ($message){
                $message->subject('Bienvenido '.$this->user->nombre);
                $message->to($this->user->email);
            });

            // Login y redirección
            Auth::login($this->user);
            return redirect()->to('/');
        }
    }

    // Login y redirección
    public function authAndRedirect($user){
        Auth::login($user);
        return redirect()->to('/');
    }
}
