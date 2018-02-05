<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Publicacion extends Model{

	use Searchable;
    
    protected $table = "publicacion";
    
    protected $fillable = [
        'id_partido', 'id_usu_retador', 'id_usu_receptor', 'id_equipo_retador', 'id_equipo_receptor', 'valor', 'valor_ganado', 'link', 'id_ganador', 'id_perdedor', 'empate', 'estado'
    ];

    //Mapping algolia
    public function toSearchableArray(){
        $record = $this->toArray();

        $partido = Partido::findOrFail($record['id_partido']);
        $publicacion = Publicacion::findOrFail($record['id']);
        $partido->equipoLocal;
        $partido->equipoVisitante;
        $partido->liga;

        $record['usuario'] = $publicacion->usuarioRetador;
        $record['partido'] = $partido;
        return $record;
    }


    public function equipoRetador(){
    	return $this->belongsTo(Equipo::class, 'id_equipo_retador');
    }

    public function equipoReceptor(){
    	return $this->belongsTo(Equipo::class, 'id_equipo_receptor');
    }

    public function usuarioRetador(){
        return $this->belongsTo(User::class, 'id_usu_retador');   
    }
}
