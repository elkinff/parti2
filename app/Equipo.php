<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model{
    
    public $table="equipo";
    public $timestamps = false;
    protected $fillable = ['id', 'id_liga', 'nombre', 'escudo'];


    public static function getImagenEquipo($idEquipo, $urlImage, $liga, $nombreEquipo){
    	$equipo = Equipo::find($idEquipo);
    	
		if(is_null($equipo)){
			$reqPrefs['http']['method'] = 'GET';
	    	$reqPrefs['http']['header'] = 'X-Auth-Token: bc763b6f15d546928ac8ce3efbb42544';
		    $stream_context = stream_context_create($reqPrefs);
		    $response = file_get_contents($urlImage, false, $stream_context);
		    $detailTeam = json_decode($response);

		    Equipo::create(["id" => $idEquipo, "id_liga" => $liga, "nombre" => $nombreEquipo, "escudo" => $detailTeam->crestUrl]);
		    return $detailTeam->crestUrl;
		}else{
			return $equipo->escudo;
		}
    }
}
