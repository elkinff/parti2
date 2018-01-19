<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable{
    use Notifiable;

    protected $fillable = [
        'nombre', 'email', 'password', 'celular', 'foto', 'id_google', 'id_facebook', 'saldo', 'id_configuracion_retiro'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
