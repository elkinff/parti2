<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovimientoBancario extends Model{
    
    protected $table = "movimiento_bancario";
    public $timestamps = false;
    
    protected $fillable = ['id_usu', 'valor', 'tipo', 'fecha', 'estado'];
}
