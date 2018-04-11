<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovimientoBancario extends Model{
    
    protected $table = "movimiento_bancario";
    public $timestamps = false;
    
    protected $fillable = ['id_usu', 'valor', 'tipo', 'fecha', 'estado', 'estado_pago_admin', 'metodo'];

    public function usuario(){
    	return $this->belongsTo(User::class, "id_usu");
    }
}
