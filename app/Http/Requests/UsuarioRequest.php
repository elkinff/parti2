<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UsuarioRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        $passwordRule = "";

        if (isset($this->request->all()["password"])) {   
            if ($this->request->all()["password"] <> "") {
                $passwordRule = 'required|string|min:6|confirmed';
            }   
        }
        
        return [
            'nombre' => 'required|string|max:90',
            'password' => $passwordRule,
            'celular' => 'nullable|digits:10'
        ];      
    }
}
