<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Auth;
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Notification;

class Publicacion extends Model{

	use Searchable;
    
    protected $table = "publicacion";
    protected $primaryKey = "id";

    protected $fillable = ['id_partido', 'id_usu_retador', 'id_usu_receptor', 'id_equipo_retador', 'id_equipo_receptor', 'valor', 'valor_ganado', 'link', 'id_ganador', 'id_perdedor', 'empate', 'estado'];

    public function equipoRetador(){
    	return $this->belongsTo(Equipo::class, 'id_equipo_retador');
    }

    public function equipoReceptor(){
    	return $this->belongsTo(Equipo::class, 'id_equipo_receptor');
    }

    public function intenciones(){
        return $this->belongsToMany(User::class, "intencion_match", "id_publicacion", "id_usuario");
    }

    public function partido(){
        return $this->belongsTo(Partido::class, 'id_partido');   
    }

    public function usuarioReceptor(){
        return $this->belongsTo(User::class, 'id_usu_receptor');   
    }

    public function usuarioRetador(){
        return $this->belongsTo(User::class, 'id_usu_retador');   
    }

    public static function getPublicacionesActivas($publicacionTipo){
        //Validar si se retonan todas las publicaciones activas o solo una publicacion
        if($publicacionTipo == "user") {
            $usuario = Auth::user();
            $publicaciones = $usuario->publicaciones;
            $publicaciones = $publicaciones->merge($usuario->matchs);
        }else{
            $publicacion = Publicacion::findOrFail($publicacionTipo);
            $publicaciones = collect();
            $publicaciones->push($publicacion);
        }

        foreach ($publicaciones as $publicacion) {
            $partido = $publicacion->partido;
            $partido->date_show = Partido::setDateMatch($partido->fecha_inicio);

            $publicacion->equipo_local = $partido->equipoLocal;
            $publicacion->equipo_visitante = $partido->equipoVisitante;

            $publicacion->equipo_local->seleccionado = false;
            $publicacion->equipo_visitante->seleccionado = false;

            //Asignar el usuario al equipo por el que aposto - En mis publicaciones
            if ($publicacion->equipo_local->id == $publicacion->id_equipo_retador) {
                $publicacion->equipo_local->usuario = $publicacion->usuarioRetador;

                if (Auth::user()) {
                    // Asignar usuario logeado a su respectivo equipo
                    if ($publicacion->equipo_local->usuario->id == Auth::user()->id) {
                        $publicacion->equipo_local->seleccionado = true;    
                    }else{
                        $publicacion->equipo_visitante->seleccionado = true; 
                    }
                }
            }else{
                $publicacion->equipo_visitante->usuario = $publicacion->usuarioRetador;

                if (Auth::user()) {
                    //Asignar usuario logeado su respectivo equipo
                    if ( $publicacion->equipo_visitante->usuario->id == Auth::user()->id) {
                        $publicacion->equipo_visitante->seleccionado = true; 
                         
                    }else{
                       $publicacion->equipo_local->seleccionado = true;   
                    }
                }
            }  
        }
        return $publicaciones;
    }

    public static function getPublicacionesActivasMuro(){
        $publicaciones = Publicacion::whereEstado(0)->get();   

        foreach ($publicaciones as $publicacion) {
            $partido = $publicacion->partido;
            $partido->date_show = Partido::setDateMatch($partido->fecha_inicio);

            $publicacion->equipo_local = $partido->equipoLocal;
            $publicacion->equipo_visitante = $partido->equipoVisitante;

            $publicacion->equipo_local->seleccionado = false;
            $publicacion->equipo_visitante->seleccionado = false;

            //Asignar el equipo que ya fue seleccionado para apostar
            if ($publicacion->equipo_local->id == $publicacion->id_equipo_retador) {
                $publicacion->equipo_local->usuario = $publicacion->usuarioRetador;
                $publicacion->equipo_local->seleccionado = true;    
            }else{
                $publicacion->equipo_visitante->usuario = $publicacion->usuarioRetador;
                $publicacion->equipo_visitante->seleccionado = true; 
            }  
        }
        return $publicaciones;
    }

    public static function getMatchsHoraActual(){
        return Publicacion::whereEstado(1)->join("partido", "partido.id", "publicacion.id_partido")->where("partido.fecha_final", "<=", date("Y-m-d H:i"))->get(["publicacion.*"]);
    }

    public static function getPublicacionesSinMatch(){
        return Publicacion::whereEstado(0)->join("partido", "partido.id", "publicacion.id_partido")->where("partido.fecha_inicio", "<=", date("Y-m-d H:i"))->get(["publicacion.*"]);
    }

    public static function getPublicacionesTerminadasSinPagar(){
        return Publicacion::whereEstado(3)->join("partido", "partido.id", "publicacion.id_partido")->where("partido.fecha_inicio", "<=", date("Y-m-d H:i"))->get(["publicacion.*"]);   
    }

    public static function hasIntencionesMatch($publicacion, $usuarioReceptor){
        if(!$publicacion->intenciones->isEmpty()){
            foreach ($publicacion->intenciones as $usuario) {
                if ($usuario->id <> $usuarioReceptor->id) {
                    $imagenIntencion = "perdedor";
                    $tituloIntencion = "Lo sentimos, se adelantaron en tu intención de match!";
                    $descripcionIntencion = "La publicación a favor del equipo ".$publicacion->equipoReceptor->nombre." encontró otro contrincante mientras hacías efectivo tu pago. Pero no te preocupes, si ya realizaste el pago se te agregará a tu credito."; 
                    $labelButtonIntencion = "Continua publicando!";
                    $urlIntencion = url("publicar");
                    $subjectIntencion = 'Lo sentimos, tu intención de match se perdió en Parti2';

                    $usuario->notify(new EmailNotification($imagenIntencion, $tituloIntencion, $descripcionIntencion, $labelButtonIntencion, $urlIntencion, $subjectIntencion));
                }
            }
        }
    }

    public function getGanadorPublicacion(){
        if ($this->estado == 2) {
            if ($this->empate == 0) {
                return $this->id_ganador == $this->id_usu_retador ? $this->equipoRetador : $this->equipoReceptor;    
            }
        }
    }
}






