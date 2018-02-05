<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Publicacion extends Model{

	use Searchable;
    
    protected $table = "publicacion";
    
    protected $fillable = [
        'id_partido', 'id_usu_retador', 'id_usu_receptor', 'id_equipo_retador', 'id_equipo_receptor', 'valor', 'valor_ganado', 'link', 'id_ganador', 'id_perdedor', 'empate'
    ];

    public function toSearchableArray(){
        $record = $this->toArray();
        $record['liga'] = Partido::findOrFail($record['id_partido'])->liga->id;

   

        return $record;
    }

    public function equipoRetador(){
    	return $this->belongsTo(Equipo::class, 'id_equipo_retador');
    }

    public function equipoReceptor(){
    	return $this->belongsTo(Equipo::class, 'id_equipo_receptor');
    }
}
