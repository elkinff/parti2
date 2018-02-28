<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreditoRetiroRequest extends FormRequest{
    
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            "metodo" => "required",
            "celular" => "required|digits:10",
            "valor" => "required|digits_between:5,8|menor_saldo"
        ];
    }
}
