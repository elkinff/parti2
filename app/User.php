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

    public function historialCrediticio(){
        return $this->hasMany(MovimientoBancario::class, "id_usu");
    }

    public function publicaciones(){
    	return $this->hasMany(Publicacion::class, "id_usu_retador");
    }

    public function matchs(){
        return $this->hasMany(Publicacion::class, "id_usu_receptor");
    }    

    public static function matchsUsuarios($idUsuario){
        return Publicacion::whereIdUsuRetador($idUsuario)->orWhere('id_usu_receptor', $idUsuario)->whereEstado(2)->get();
    }
}
