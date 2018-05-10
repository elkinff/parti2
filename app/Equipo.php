<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model{
    
    public $table="equipo";
    public $timestamps = false;
    protected $fillable = ['id', 'nombre', 'escudo'];

    public function ligas(){
    	return $this->belongsToMany(Liga::class, "equipo_has_liga", "id_equipo", "id_liga");
    }

    public static function getImagenEquipo($idEquipo, $urlImage, $liga, $nombreEquipo){
    	//Validamos si el equipo ya se encuentra en base de datos o si no creamos el registro
    	$equipo = Equipo::find($idEquipo);
    	
		if(is_null($equipo)){
			$escudo = "img/teams/".$liga."/".$idEquipo."/".$idEquipo."_100.png";
		    $equipo = Equipo::create(["id" => $idEquipo, "nombre" => $nombreEquipo, "escudo" => $escudo]);
		    $equipo->ligas()->attach($liga);

		    //Retornamos el escudo del equipo, despues de guardar el registro knsksnksnksnk
		    return $escudo;
		}else{   
			return $equipo->escudo;
		}
    }
}
