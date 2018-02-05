<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable{
    use Notifiable;

    protected $fillable = [
        'nombre', 'email', 'password', 'celular', 'foto', 'id_google', 'id_facebook', 'saldo', 'id_configuracion_retiro', 'token', 'validado'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function publicaciones(){
    	return $this->hasMany(Publicacion::class, $id_usu_retador);
    }
}
