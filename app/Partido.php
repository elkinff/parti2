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

    public static function setDateMatch($date){
        $hoy = date("Y-m-d");
        $mañana = date("Y-m-d",strtotime($hoy."+1 days"));
        $dateFixture = date('Y-m-d',strtotime($date));
        $horaFixture = date('H:i',strtotime($date));
        //Validar la fecha y retonar el nombre en español del dia
        if ($dateFixture == $hoy) {
            return "Hoy ".$horaFixture;
        }elseif ($dateFixture == $mañana){
           return "Mañana ".$horaFixture;
        }else{
            $days_dias = array(
                'Monday' =>'Lunes',
                'Tuesday' =>'Martes',
                'Wednesday' =>'Miércoles',
                'Thursday' =>'Jueves',
                'Friday' =>'Viernes',
                'Saturday' =>'Sábado',
                'Sunday' => 'Domingo'
            );
            return $days_dias[date('l', strtotime($date))]." ".date("d/m", strtotime($date))." - ".$horaFixture;
        }
    }
}
