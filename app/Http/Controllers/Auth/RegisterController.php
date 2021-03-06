<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Softon\SweetAlert\Facades\SWAL;  
use Auth;

class RegisterController extends Controller{

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => 'required|string|max:90',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'celular' => 'digits:10'
        ]);
    }

    public function createUser(UserRequest $request){
        
        $this->user = User::create([
            'nombre' => $request['nombre'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'celular' => $request['celular'],
            'token' => substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 50)
        ]);

        $imagen = "validacion";
        $titulo = "Activa tu cuenta de Parti2!";
        $descripcion = "Para activar tu cuenta sigue el enlace del siguiente botón"; 
        $labelButton = "Empieza ya!";
            
        $url = url("activar/".$this->user->id."/".$this->user->token);
        Mail::send('emails.email', ['imagen' => $imagen, 'titulo' => $titulo, 'descripcion' => $descripcion, "labelButton" => $labelButton, "url" => $url], function ($message){
            $message->subject('Activa tu cuenta '.$this->user->nombre);
            $message->to($this->user->email);
        });

        alert()->info('Revisa tu bandeja de entrada para activar la cuenta de Parti2. No olvides consultar la carpeta de SPAM.','Registro exitoso !');

        return redirect()->to("login");

    }

    public function activarUser($id, $token){
        $this->user = User::whereId($id)->whereToken($token)->first();
        if ($this->user) {
            $this->user->validado = 1;
            $this->user->save();

            $imagen = "bienvenida";
            $titulo = "Bienvenido!";
            $descripcion = "Parti2 es una aplicación donde podrás ganar dinero con tu equipo favorito en tres simples pasos"; 
            $labelButton = "Empieza ya!";

            $url = url("/");
            
            Mail::send('emails.email', ['imagen' => $imagen, 'titulo' => $titulo, 'descripcion' => $descripcion, "labelButton" => $labelButton, "url" => $url], function ($message){
                $message->subject('Bienvenido '.$this->user->nombre);
                $message->to($this->user->email);
            });

            Auth::login($this->user);
        }
        return redirect()->to('/');
    }
}
