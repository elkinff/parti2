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
        $fechaHoraActual = date("Y-m-d H:i:s");
        $publicacionesHoy = Publicacion::whereEstado(1)->get();
        foreach ($publicacionesHoy as $publicacion) {
            $this->info($fechaHoraActual);
            if ($publicacion->partido->fecha_final == $fechaHoraActual) {
                $this->info($publicacion);
            }
        }
    }
}
