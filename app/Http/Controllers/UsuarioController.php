<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\UsuarioRequest;
use File;

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

    public function actualizarUsuario(UsuarioRequest $request){
        if (bcrypt($request->password) <> $this->usuario->password) {
            $request["password"] = bcrypt($request->password);
            alert()->info('Tu contraseña ha sido actualizada!');
        }

        //Subir foto de perfil
        if(!is_null($request->file('fotoUsuario'))){
            $file = $request->file('fotoUsuario'); 
            $path = public_path().'/img/usuario';
            $nombreArchivo = md5($file->getClientOriginalName().$this->usuario->id).".".$file->extension();
            $file->move($path, $nombreArchivo);
            $request["foto"] = $nombreArchivo;
        }

        $this->usuario->fill($request->all());
        $this->usuario->save();

        return redirect()->to("perfil");

    }
}
