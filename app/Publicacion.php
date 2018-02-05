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
        // $partido = Partido::findOrFail($record['id_partido']);
        // $equipoLocal = $partido->equipoLocal;
        // $equipoVisitante = $partido->equipoVisitante;

        $record = $this->toArray();
        // $record['liga'] = $partido->liga->id;
        // $record['idEquipoLocal'] = $equipoLocal;
        // $record['idEquipoVisitante'] = $equipoVisitante;
        // $record['nombreEquipoLocal'] = ;
        // $record['nombreEquipoVisitante'] = $partido->equipoVisitante;
        // $record['equipoLocalEscudo'] = $partido->equipoLocal;
        // $record['equipoVisitanteEscudo'] = $partido->equipoLocal;
        return $record;
    }


    public function equipoRetador(){
    	return $this->belongsTo(Equipo::class, 'id_equipo_retador');
    }

    public function equipoReceptor(){
    	return $this->belongsTo(Equipo::class, 'id_equipo_receptor');
    }
}
