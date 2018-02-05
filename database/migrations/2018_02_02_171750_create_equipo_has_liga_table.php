<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipoHasLigaTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipo_has_liga', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id_equipo')->unsigned();
            $table->integer('id_liga')->unsigned();
            
            $table->index(["id_equipo"], 'fk_equipo_has_liga_equipo1_idx');
            $table->foreign('id_equipo', 'fk_equipo_has_liga_equipo1_idx')
                ->references('id')->on('equipo')
                ->onDelete('no action')
                ->onUpdate('no action');

            
            $table->index(["id_liga"], 'fk_equipo_has_liga_liga1_idx');
            $table->foreign('id_liga', 'fk_equipo_has_liga_liga1_idx')
                ->references('id')->on('liga')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipo_has_liga');
    }
}
