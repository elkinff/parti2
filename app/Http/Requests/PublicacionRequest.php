<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicacionRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
        	"league" => "required",
            "idHomeTeam" => "required",
            "idAwayTeam" => "required",
            "date" => "required",
            "valor" => "required|digits_between:5,9",
            "valor_ganado" => "required|digits_between:5,9"
        ];
    }
}
