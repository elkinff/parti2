<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'nombre' => 'required|string|max:90',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'celular' => 'nullable|digits:10'
        ];
    }
}
