<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules tener multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted"       => "El campo :attribute debe ser aceptado.",
    "active_url"     => "El campo :attribute no es una URL válida.",
    "after"          => "El campo :attribute debe ser una fecha después de :date.",
    'after_or_equal' => 'El :attribute debe ser una fecha despues o igual a :date de inicio.',
    "alpha"          => "El campo :attribute sólo puede contener letras.",
    "alpha_dash"     => "El campo :attribute sólo puede contener letras, números y guiones.",
    "alpha_num"      => "El campo :attribute sólo puede contener letras y números.",
    "array"          => "El campo :attribute debe ser un arreglo.",
    "before"         => "El campo :attribute debe ser una fecha antes :date.",
    "between"        => array(
            "numeric" => "El campo :attribute debe estar entre :min - :max.",
            "file"    => "El campo :attribute debe estar entre :min - :max kilobytes.",
            "string"  => "El campo :attribute debe estar entre :min - :max caracteres.",
            "array"   => "El campo :attribute debe tener entre :min y :max elementos.",
    ),
    "boolean"        => "El campo :attribute debe ser verdadero o falso.",
    "confirmed"      => "El campo de confirmación de :attribute no coincide.",
    "date"           => "El campo :attribute no es una fecha válida.",
    "date_format"    => "El campo :attribute no corresponde con el formato :format.",
    "different"      => "Los campos :attribute y :other deben ser diferentes.",
    "digits"         => "El campo :attribute debe ser de :digits dígitos.",
    "digits_between" => "El campo :attribute debe tener entre :min y :max dígitos.",
    "email"          => "El formato del :attribute es inválido.",
    "exists"         => "El campo :attribute seleccionado es inválido.",
    "filled"         => 'El campo :attribute es requerido.',    
    "image"          => "El campo :attribute debe ser una imagen.",
    "in"             => "El campo :attribute seleccionado es inválido.",
    "integer"        => "El campo :attribute debe ser un entero.",
    "ip"             => "El campo :attribute debe ser una dirección IP válida.",
    "json"           => "El campo :attribute debe ser una cadena JSON válida.",
    "match"          => "El formato :attribute es inválido.",
    "max"            => array(
            "numeric" => "El campo :attribute debe ser menor que :max.",
            "file"    => "El campo :attribute debe ser menor que :max kilobytes.",
            "string"  => "El campo :attribute debe ser menor que :max caracteres.",
            "array"   => "El campo :attribute debe tener al menos :min elementos.",
        ),
    "mimes"         => "El campo :attribute debe ser un archivo de tipo :values.",
    "min"           => array(
            "numeric" => "El campo :attribute debe tener al menos :min.",
            "file"    => "El campo :attribute debe tener al menos :min kilobytes.",
            "string"  => "El campo :attribute debe tener al menos :min caracteres.",
    ),
    "not_in"                => "El campo :attribute seleccionado es invalido.",
    "numeric"               => "El campo :attribute debe ser un número.",
    "regex"                 => "El formato del campo :attribute es inválido.",
    "required"              => "El campo :attribute es requerido.",
    "required_if"           => "El campo :attribute es requerido cuando el campo :other es :value.",
    "required_unless"       => 'El campo :attribute es requerido a menos que :other esté presente en :values.', 
    "required_with"         => "El campo :attribute es requerido cuando :values está presente.",
    "required_with_all"     => "El campo :attribute es requerido cuando :values está presente.",
    "required_without"      => "El campo :attribute es requerido cuando :values no está presente.",
    "required_without_all"  => "El campo :attribute es requerido cuando ningún :values está presente.",
    "same"                  => "El campo :attribute y :other debe coincidir.",
    "size"                  => array(
                                "numeric" => "El campo :attribute debe ser :size.",
                                "file"    => "El campo :attribute debe tener :size kilobytes.",
                                "string"  => "El campo :attribute debe tener :size caracteres.",
                                "array"   => "El campo :attribute debe contener :size elementos.",
    ),
    "string"               => "El campo :attribute debe ser una cadena.",
    "unique"         => "El campo :attribute ya ha sido tomado.",
    "url"            => "El formato de :attribute es inválido.",
    "timezone"       => "El campo :attribute debe ser una zona válida.",
    'unique'         => 'El :attribute ya se encuentra registrado.',
    'url'            => 'El formato de :attribute es invalido.',

    'menor_saldo' => "El :attribute debe ser menor a tu saldo",
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Lunguage Lines
    |--------------------------------------------------------------------------
    |
    | Here you debe specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify un specific custom language line for un given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail direccion instead
    | of "email". This simply helps us make messages un little cleaner.
    |
    */

    'attributes' => [
        'password' => 'Contraseña',
        "email" => "Correo Electrónico",

    ],
];
