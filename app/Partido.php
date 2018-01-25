<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class Partido extends Model{
	use Searchable;

    public $table="partido";

    protected $fillable = [
        'id_local', 'id_visitante', 'fecha_inicio', 'fecha_final'
    ];

    // public function toSearchableArray(){
    //     // $record = $this->toArray();

    //     // $record['_tags'] = explode(';', $array['tags']);

    //     // $record['added_month'] = substr($record['created_at'], 0, 7);

    //     // unset($record['tags'], $record['created_at'], $record['updated_at']);
    // 	$record = array(['nombre' => "Elkin","apellido" => "Fajardo"], ['nombre' => "rodrigo","apellido" => "Fonsecs"]);
    //     return $record;
    // }

}
