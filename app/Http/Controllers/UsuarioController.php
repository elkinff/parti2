<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\UsuarioRequest;
use File;
use App\User;

class UsuarioController extends Controller{
    
    public function __construct(){
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->usuario = Auth::user();
            // $this->usuario = User::find(1);
            return $next($request);
        });
    }

    public function index(){
    	return view("pages.dashboard.perfil")->with("usuario", $this->usuario);
    }

    public function actualizarUsuario(UsuarioRequest $request){
    // public function actualizarUsuario(Request $request){
        $request["email"] = $this->usuario->email;

        if(isset($request->password)){
            if (bcrypt($request->password) <> $this->usuario->password) {
                $request["password"] = bcrypt($request->password);
            }else{
                $request["password"] = $this->usuario->password;
            }
        }else{
            $request["password"] = $this->usuario->password;
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

        alert()->success('Tus datos se han actualizado satisfactoriamente');
        return redirect()->to("perfil");
    }
}
