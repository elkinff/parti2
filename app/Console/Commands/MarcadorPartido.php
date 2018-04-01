<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Publicacion;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EmailNotification;

class MarcadorPartido extends Command{
    
    protected $signature = 'mpa:marcador';

    protected $description = 'Consultar los marcadores de los partidas y generar un resultado del match';

    public function __construct(){
        parent::__construct();
    }

    public function handle(){
        // $fechaHoraActual = date("Y-m-d H:i");
        //Url que se envia al correo de notificacion
        $url = url("publicar");

        //Validar Matchs Realizados en Parti2
        $publicacionesHoy = Publicacion::getMatchsHoraActual();

        if (!$publicacionesHoy->isEmpty()) {
            foreach ($publicacionesHoy as $publicacion) {
                $partido = $publicacion->partido;

                //Consultar partido a la api
                $urlApi = "http://api.football-data.org/v1/fixtures/".$partido->id;    
                $reqPrefs['http']['method'] = 'GET';
                $reqPrefs['http']['header'] = 'X-Auth-Token: bc763b6f15d546928ac8ce3efbb42544';
                $stream_context = stream_context_create($reqPrefs);
                $response = file_get_contents($urlApi, false, $stream_context);
                $fixture = json_decode($response)->fixture;

                //Consultar estado y actualizar base de datos dependiendo del resultado
                if ($fixture->status == "FINISHED") {
                    $goalsHomeTeam = $fixture->result->goalsHomeTeam;
                    $goalsAwayTeam = $fixture->result->goalsAwayTeam;

                    //Obtener el equipo ganador
                    if ($goalsHomeTeam > $goalsAwayTeam) {
                        $equipoGanador = $partido->equipoLocal;
                        $equipoPerdedor = $partido->equipoVisitante;
                    }else if ($goalsHomeTeam < $goalsAwayTeam){
                        $equipoGanador = $partido->equipoVisitante;
                        $equipoPerdedor = $partido->equipoLocal;
                    }else{
                        //Hay un empate: Se actualiza la publicacion y se devuelven los saldos apostados
                        $publicacion->empate = 1;
                        $publicacion->estado = 2;
                        $publicacion->save();

                        $this->usuarioRetador = $publicacion->usuarioRetador;
                        $this->usuarioReceptor = $publicacion->usuarioReceptor;

                        $this->usuarioRetador->saldo = $this->usuarioRetador->saldo + $publicacion->valor;
                        $this->usuarioReceptor->saldo = $this->usuarioReceptor->saldo + $publicacion->valor; 
                        $this->usuarioRetador->save();
                        $this->usuarioReceptor->save();

                        $equipoLocal = $publicacion->partido->equipoLocal;
                        $equipoVisitante = $publicacion->partido->equipoVisitante;

                        $imagen = "empate";
                        $titulo = "El partido de tu match ha quedado empatado";
                        $descripcion = "El partido ha terminado con un marcador de: ".$equipoLocal->nombre." : ".$goalsHomeTeam." - ".$equipoVisitante->nombre." : ".$goalsAwayTeam.". Sigue publicando para que encuentres tu victoria.";
                        $labelButton = "Sigue Publicando!";
                        $subject = 'Tu partido ha quedado en empate';

                        $this->usuarioRetador->notify(new EmailNotification($imagen, $titulo, $descripcion, $labelButton, $url, $subject));
                        $this->usuarioReceptor->notify(new EmailNotification($imagen, $titulo, $descripcion, $labelButton, $url, $subject));
                        $this->info("Empate");
                    }
                    
                    //Obtener el usuario ganador y perdedor
                    if ($publicacion->empate <> 1) {
                        if ($equipoGanador->id == $publicacion->id_equipo_retador) {
                            $this->usuarioGanador = $publicacion->usuarioRetador;
                            $this->usuarioPerdedor = $publicacion->usuarioReceptor;

                            $publicacion->id_ganador = $this->usuarioGanador->id;
                            $publicacion->id_perdedor = $this->usuarioPerdedor->id;
                        }else{
                            $this->usuarioGanador = $publicacion->usuarioReceptor;
                            $this->usuarioPerdedor = $publicacion->usuarioRetador;
                            
                            $publicacion->id_ganador = $this->usuarioGanador->id;
                            $publicacion->id_perdedor = $this->usuarioPerdedor->id;
                        }
                        $publicacion->estado = 2;
                        $publicacion->save();
                        
                        //Transferir saldo a usuario ganador    
                        $this->usuarioGanador->saldo = $this->usuarioGanador->saldo + $publicacion->valor_ganado;
                        $this->usuarioGanador->save();

                        // Notificar al usuario de la victoria
                        $imagen = "ganador";
                        $titulo = "Felicitaciones, ganaste en tu Match!";
                        $descripcion = "Tu equipo ".$equipoGanador->nombre." ganó su partido y acabas de recibir $ ".number_format($publicacion->valor_ganado).". Felicitaciones!!! sigue publicando para que continues tu racha ganadora"; 
                        $labelButton = "Sigue Ganando!";
                        $subject = 'Ganaste en Parti2';

                        $this->usuarioGanador->notify(new EmailNotification($imagen, $titulo, $descripcion, $labelButton, $url, $subject));

                        // Notificar al usuario de la perdida
                        $imagenP = "perdedor";
                        $tituloP = "Lo sentimos, has perdido tu match";
                        $descripcionP = "Tu equipo ".$equipoPerdedor->nombre." perdió su partido. Pero no te desanimes!!! Sigue publicando para que empieces tu racha ganadora"; 
                        $labelButtonP = "Publica Ya!";
                        $subjectP = 'Perdiste en Parti2';

                        $this->usuarioPerdedor->notify(new EmailNotification($imagenP, $tituloP, $descripcionP, $labelButtonP, $url, $subjectP));
                         
                        $this->info("Hubo un ganador");
                    }   
                }else{
                    $this->info("El partido no ha terminado");
                }
            }
        }else{
            $this->info("No hay matchs programados");
        }

        //Validar Publicaciones que no encontraron Match
        $publicacionesSinMatch = Publicacion::getPublicacionesSinMatch();
        foreach ($publicacionesSinMatch as $publicacion) {
            $publicacion->estado = 5;
            $publicacion->save();

            //Retonar saldo al usuario retador
            $usuarioRetador = $publicacion->usuarioRetador;
            $usuarioRetador->saldo = $usuarioRetador->saldo + $publicacion->valor;
            $usuarioRetador->save();

            // Notificar al usuario que no encontró match
            $imagen = "no_match";
            $titulo = "Lo sentimos, no encontraste tu match";
            $descripcion = "Tu publicación a favor de ".$publicacion->equipoRetador->nombre." por un valor de $".number_format($publicacion->valor)." no encontró un usuario receptor para realizar el match. Pero no te desanimes!!! Sigue publicando para que empieces tu racha ganadora"; 
            $labelButton = "Publica Ya!";
            $subject = 'El partido de tu publicacion ha iniciado y no encontraste el match';

           $usuarioRetador->notify(new EmailNotification($imagen, $titulo, $descripcion, $labelButton, $url, $subject));

            $this->info("No se encontro match para la publicacion");
        }

        //Validar publicaciones que no fueron pagas
        $publicacionesSinPagar = Publicacion::getPublicacionesTerminadasSinPagar();
        foreach ($publicacionesSinPagar as $publicacion) {
            $publicacion->estado = 6;
            $publicacion->save();

            // Notificar al usuario que no encontró match
            $imagen = "no_match";
            $titulo = "Lo sentimos, no realizaste tu publicación";
            $descripcion = "Tu publicación a favor de ".$publicacion->equipoRetador->nombre." por un valor de $".number_format($publicacion->valor)." no se realizó ya que no hiciste el pago. Pero no te desanimes!!! Sigue publicando para que empieces tu racha ganadora"; 
            $labelButton = "Publica Ya!";
            $subject = 'El partido de tu publicacion ha iniciado y no realizaste el pago';

            $usuarioRetador = $publicacion->usuarioRetador;
            $usuarioRetador->notify(new EmailNotification($imagen, $titulo, $descripcion, $labelButton, $url, $subject));

            $this->info("No se realizó el pago para la publicacion");
        }
    }
}
