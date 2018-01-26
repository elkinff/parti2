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
            
        ];
    }
}
