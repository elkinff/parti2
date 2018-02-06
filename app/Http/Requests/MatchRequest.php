<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatchRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            "id_user" => "required",
            "id_publicacion" => "required"
        ];
    }
}
