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
    	$equipo = Equipo::find($idEquipo);
    	
		if(is_null($equipo)){
			// $reqPrefs['http']['method'] = 'GET';
	  //   	$reqPrefs['http']['header'] = 'X-Auth-Token: bc763b6f15d546928ac8ce3efbb42544';
		 //    $stream_context = stream_context_create($reqPrefs);
		 //    $response = file_get_contents($urlImage, false, $stream_context);
		 //    $detailTeam = json_decode($response);
			$escudo = "img/teams/".$liga."/".$idEquipo."/".$idEquipo."_60.png";
		    $equipo = Equipo::create(["id" => $idEquipo, "nombre" => $nombreEquipo, "escudo" => $escudo]);
		    $equipo->ligas()->attach($liga);

		    //Retornamos el escudo del equipo, despues de guardar el registro
		    return $escudo;
		}else{
			return $equipo->escudo;
		}
    }
}
