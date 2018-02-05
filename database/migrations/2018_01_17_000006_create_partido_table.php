<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartidoTable extends Migration{

    public $set_schema_table = 'partido';

    public function up(){
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('id_liga')->unsigned();
            $table->index(["id_liga"], 'fk_Partido_Liga1_idx');
            $table->foreign('id_liga', 'fk_Partido_Liga1_idx')
                ->references('id')->on('liga')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->integer('id_local')->unsigned();
            $table->index(["id_local"], 'fk_Partido_Equipo1_idx');
            $table->foreign('id_local', 'fk_Partido_Equipo1_idx')
                ->references('id')->on('equipo')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->integer('id_visitante')->unsigned();
            $table->index(["id_visitante"], 'fk_Partido_Equipo2_idx');
            $table->foreign('id_visitante', 'fk_Partido_Equipo2_idx')
                ->references('id')->on('equipo')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_final');

            $table->unique(["id"], 'id_UNIQUE');           
        });
    }


    public function down(){
       Schema::dropIfExists($this->set_schema_table);
    }
}
