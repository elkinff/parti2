<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UsuarioRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        $emailRule = "";
        $passwordRule = "";
        
        if ($this->request->all()["email"] <> Auth::user()->email) {
            $emailRule = 'required|string|email|max:191|unique:users';
        }

        if ($this->request->all()["password"] <> "") {
            $passwordRule = 'required|string|min:6|confirmed';
        }   
        
        return [
            'nombre' => 'required|string|max:90',
            'email' => $emailRule,
            'password' => $passwordRule,
            'celular' => 'nullable|digits:10'
        ];      
    }
}
