<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Auth;
// use App\User;

class Publicacion extends Model{

	use Searchable;
    
    protected $table = "publicacion";
    
    protected $fillable = ['id_partido', 'id_usu_retador', 'id_usu_receptor', 'id_equipo_retador', 'id_equipo_receptor', 'valor', 'valor_ganado', 'link', 'id_ganador', 'id_perdedor', 'empate', 'estado'];

    public function equipoRetador(){
    	return $this->belongsTo(Equipo::class, 'id_equipo_retador');
    }

    public function equipoReceptor(){
    	return $this->belongsTo(Equipo::class, 'id_equipo_receptor');
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
        if ($publicacionTipo == "All") {
            $publicaciones = Publicacion::whereEstado(0)->get();
        }elseif ($publicacionTipo == "user") {
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

            //Asignar el usuario al equipo por el que aposto
            if ($publicacion->equipo_local->id == $publicacion->id_equipo_retador) {
                $publicacion->equipo_local->usuario = $publicacion->usuarioRetador;

                // Asignar usuario logeado a su respectivo equipo
                if ($publicacion->equipo_local->usuario->id == Auth::user()->id) {
                    $publicacion->equipo_local->seleccionado = true;    
                }else{
                    $publicacion->equipo_visitante->seleccionado = true; 
                }
                
            }else{
                $publicacion->equipo_visitante->usuario = $publicacion->usuarioRetador;

                //Asignar usuario logeado su respectivo equipo
                if ( $publicacion->equipo_visitante->usuario->id == Auth::user()->id) {
                    $publicacion->equipo_visitante->seleccionado = true; 
                     
                }else{
                   $publicacion->equipo_local->seleccionado = true;   
                }
            }  
        }
        return $publicaciones;
    }

    public static function getMatchsHoraActual(){
        return Publicacion::whereEstado(1)->join("partido", "partido.id", "publicacion.id_partido")->where("partido.fecha_final", "<=", date("Y-m-d H:i"))->get(["publicacion.*"]);
    }

    public static function getPublicacionesSinMacth(){
        return Publicacion::whereEstado(0)->join("partido", "partido.id", "publicacion.id_partido")->where("partido.fecha_inicio", "<=", date("Y-m-d H:i"))->get(["publicacion.*"]);
    }
}
