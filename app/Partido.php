<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partido extends Model{

    protected $table="partido";
    public $timestamps = false;
    
    protected $fillable = ['id', 'id_liga', 'id_local', 'id_visitante', 'fecha_inicio', 'fecha_final'];

    public function equipoLocal(){
        return $this->belongsTo(Equipo::class, 'id_local');
    }

    public function equipoVisitante(){
        return $this->belongsTo(Equipo::class, 'id_visitante');
    }

    public function liga(){
        return $this->belongsTo(Liga::class, 'id_liga');
    }  

    public static function getPartidoByEquiposAndFecha($idEquipoLocal, $idEqipoVisitante, $fecha){
        return Partido::whereIdLocal($idEquipoLocal)->whereIdVisitante($idEqipoVisitante)->whereFechaInicio($fecha)->first();
    }

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
