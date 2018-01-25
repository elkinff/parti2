<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model{
    
    public $table="equipo";

    protected $fillable = ['id_liga', 'nombre', 'escudo'];

    public static function getImagenEquipo($idEquipo, $urlImage){
    	$equipo = Equipo::find($idEquipo);
		if(is_null($equipo)){
			$reqPrefs['http']['method'] = 'GET';
	    	$reqPrefs['http']['header'] = 'X-Auth-Token: bc763b6f15d546928ac8ce3efbb42544';
		    $stream_context = stream_context_create($reqPrefs);
		    $response = file_get_contents($urlImage, false, $stream_context);
		    $detailTeam = json_decode($response);
		    return $detailTeam->crestUrl;
		}else{
			return $equipo->escudo;
		}
    }
}
