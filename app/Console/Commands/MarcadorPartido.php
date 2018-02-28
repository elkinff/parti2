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
        $fechaHoraActual = date("Y-m-d H:i");

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
                        $equipoGanador = $partido->equipoLocal->id;
                        $equipoPerdedor = $partido->equipoVisitante->id;
                    }else if ($goalsHomeTeam < $goalsAwayTeam){
                        $equipoGanador = $partido->equipoVisitante->id;
                        $equipoPerdedor = $partido->equipoLocal->id;
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
                        $descripcion = "El partido ha terminado con un marcador de ".$equipoLocal->nombre." : ".$goalsHomeTeam." - ".$equipoVisitante->nombre." : ".$goalsAwayTeam.". Pero sigue publicando para que encuentres tu victoria."; 
                        $labelButton = "Sigue Publicando!";
                        $url = url("publicar");
                        $subject = 'Tu partido ha quedado en empate';
                        $correos = [$this->usuarioRetador->email, $this->usuarioReceptor->email];

                        $this->usuarioRetador->notify(new EmailNotification($imagen, $titulo, $descripcion, $labelButton, $url, $subject));


                        // //Notificar a los usuarios del empate
                        // Mail::send('emails.email', ['imagen' => $imagen, 'titulo' => $titulo, 'descripcion' => $descripcion, "labelButton" => $labelButton, "url" => $url], function ($message){
                        //     $message->subject('Tu partido ha quedado en empate');
                        //     $message->to([$this->usuarioRetador->email, $this->usuarioReceptor->email]);
                        // });
                        $this->info("Empate");
                    }
                    
                    //Obtener el usuario ganador y perdedor
                    if ($publicacion->empate <> 1) {
                        if ($equipoGanador == $publicacion->id_equipo_retador) {
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
                        $descripcion = "Tu equipo ".$equipoGanador." ganó su partido y acabas de recibir $ ".number_format($publicacion->valor_ganado).". Felicitaciones!!! sigue publicando para que continues tu racha ganadora"; 
                        $labelButton = "Sigue Ganando!";
                        $url = url("publicar");

                        Mail::send('emails.email', ['imagen' => $imagen, 'titulo' => $titulo, 'descripcion' => $descripcion, "labelButton" => $labelButton, "url" => $url], function ($message){
                            $message->subject('Ganaste en Parti2');
                            $message->to($this->usuarioGanador->email);
                        });

                        // Notificar al usuario de la perdida
                        $imagen = "perdedor";
                        $titulo = "Lo sentimos, has perdido tu match";
                        $descripcion = "Tu equipo ".$equipoPerdedor." perdió su partido. Pero no importa!!! sigue publicando para que empieces tu racha ganadora"; 
                        $labelButton = "Publica Ya!";
                        $url = url("publicar");

                        Mail::send('emails.email', ['imagen' => $imagen, 'titulo' => $titulo, 'descripcion' => $descripcion, "labelButton" => $labelButton, "url" => $url], function ($message){
                            $message->subject('Perdiste en Parti2');
                            $message->to($this->usuarioPerdedor->email);
                        });
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
        $publicacionesSinMatch = Publicacion::getPublicacionesSinMacth();
        foreach ($publicacionesSinMatch as $publicacion) {
            $publicacion->estado = 5;
            $publicacion->save();

            //Retonar saldo al usuario retador
            $usuarioRetador = $publicacion->usuarioRetador;
            $usuarioRetador->saldo = $usuarioRetador->saldo + $publicacion->valor;
            $usuarioRetador->save();

             // Notificar al usuario que no encontró match
            $imagen = "no_match";
            $titulo = "Lo sentimos, no encontraste tu macth";
            $descripcion = "Tu publicacion a favor de ".$publicacion->equipoRetador." por un valor de $".number_format($publicacion->valor)." no encontró un usuario receptor para realizar el match. Pero no importa!!! sigue publicando para que empieces tu racha ganadora"; 
            $labelButton = "Publica Ya!";
            $url = url("publicar");
            Mail::send('emails.email', ['imagen' => $imagen, 'titulo' => $titulo, 'descripcion' => $descripcion, "labelButton" => $labelButton, "url" => $url], function ($message){
                $message->subject('El partido de tu publicacion ha iniciado y no encontraste el match');
                $message->to($usuarioRetador->email);
            });
        }
    }
}
