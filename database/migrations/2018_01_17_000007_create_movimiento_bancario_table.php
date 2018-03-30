<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientoBancarioTable extends Migration{

    public $set_schema_table = 'movimiento_bancario';

    public function up(){
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('id_usu')->unsigned();
            $table->index(["id_usu"], 'fk_Movimientos_Bancarios_Usuario1_idx');
            $table->foreign('id_usu', 'fk_Movimientos_Bancarios_Usuario1_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->bigInteger('valor');
            $table->string('tipo', 20);
            $table->dateTime('fecha');
            $table->boolean('estado');
            $table->boolean('estado_pago_admin');
        });
    }

    public function down(){
        Schema::dropIfExists($this->set_schema_table);
    }
}
