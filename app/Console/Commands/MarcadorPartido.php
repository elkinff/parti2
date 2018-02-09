<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Publicacion;

class MarcadorPartido extends Command{
    
    protected $signature = 'mpa:marcador';

    protected $description = 'Consultar los marcadores de los partidas y generar un resultado del match';

    public function __construct(){
        parent::__construct();
    }

    public function handle(){
        $fechaHoraActual = date("Y-m-d H:i");
        $publicacionesHoy = Publicacion::getPublicacionesActivas(1);
        $this->info($publicacionesHoy);
        foreach ($publicacionesHoy as $publicacion) {
            // if (date("Y-m-d H:i", strtotime($publicacion->partido->fecha_final)) == $fechaHoraActual) {
                $partido = $publicacion->partido;

                $urlApi = "http://api.football-data.org/v1/fixtures/".$partido->id;    
                $reqPrefs['http']['method'] = 'GET';
                $reqPrefs['http']['header'] = 'X-Auth-Token: bc763b6f15d546928ac8ce3efbb42544';
                $stream_context = stream_context_create($reqPrefs);
                $response = file_get_contents($urlApi, false, $stream_context);
                $fixture = json_decode($response)->fixture;
                if ($fixture->status == "FINISHED") {
                    $goalsHomeTeam = $fixture->result->goalsHomeTeam;
                    $goalsAwayTeam = $fixture->result->goalsAwayTeam;

                    if ($goalsHomeTeam > $goalsAwayTeam) {
                        // $equipoGanador = $publicacion
                    }
                }
                // $this->info();
            // }
        }
    }
}
