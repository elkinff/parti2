<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Publicacion extends Model{

	use Searchable;
    
    protected $table = "publicacion";
    
    protected $fillable = ['id_partido', 'id_usu_retador', 'id_usu_receptor', 'id_equipo_retador', 'id_equipo_receptor', 'valor', 'valor_ganado', 'link', 'id_ganador', 'id_perdedor', 'empate', 'estado'];

    //Mapping algolia
    public function toSearchableArray(){
        $record = $this->toArray();

        $partido = Partido::findOrFail($record['id_partido']);
        $publicacion = Publicacion::findOrFail($record['id']);
        
        $partido->liga;

        $record['partido'] = $partido;
        $record['partido']["equipo_local"] = $partido->equipoLocal;
        $record['partido']["equipo_visitante"] = $partido->equipoVisitante;

        //Asignar usuario al equipo por el que aposto
        if ($record['id_equipo_retador'] == $record["partido"]->equipoLocal->id) {
            $record["partido"]["equipo_local"]["usuario"] = $publicacion->usuarioRetador;
        }else{
            $record["partido"]["equipo_visitante"]["usuario"] = $publicacion->usuarioRetador;
        }
        return $record;
    }


    public function equipoRetador(){
    	return $this->belongsTo(Equipo::class, 'id_equipo_retador');
    }

    public function equipoReceptor(){
    	return $this->belongsTo(Equipo::class, 'id_equipo_receptor');
    }

    public function partido(){
        return $this->belongsTo(Partido::class, 'id_partido');   
    }

    public function usuarioRetador(){
        return $this->belongsTo(User::class, 'id_usu_retador');   
    }
}
