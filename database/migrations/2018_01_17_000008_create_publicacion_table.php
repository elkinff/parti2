<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicacionTable extends Migration{

    public $set_schema_table = 'publicacion';

    public function up(){
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('id_partido')->unsigned();
            $table->index(["id_partido"], 'fk_Publicacion_Partido1_idx');
             $table->foreign('id_partido', 'fk_Publicacion_Partido1_idx')
                ->references('id')->on('partido')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->integer('id_usu_retador')->unsigned();
            $table->index(["id_usu_retador"], 'fk_Publicacion_Usuario_idx');
            $table->foreign('id_usu_retador', 'fk_Publicacion_Usuario_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->integer('id_usu_receptor')->nullable()->unsigned();
            $table->index(["id_usu_receptor"], 'fk_Publicacion_users1_idx');
            $table->foreign('id_usu_receptor', 'fk_Publicacion_users1_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->integer('id_equipo_retador')->unsigned();
            $table->index(["id_equipo_retador"], 'fk_Publicacion_Equipo1_idx');
            $table->foreign('id_equipo_retador', 'fk_Publicacion_Equipo1_idx')
                ->references('id')->on('equipo')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->integer('id_equipo_receptor')->nullable()->unsigned();
            $table->index(["id_equipo_receptor"], 'fk_Publicacion_Equipo2_idx');
            $table->foreign('id_equipo_receptor', 'fk_Publicacion_Equipo2_idx')
                ->references('id')->on('equipo')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->bigInteger('valor');
            $table->bigInteger('valor_ganado');
            $table->string('link', 90)->nullable();

            $table->integer('id_ganador')->nullable()->unsigned();
            $table->index(["id_ganador"], 'fk_Publicacion_users2_idx');
            $table->foreign('id_ganador', 'fk_Publicacion_users2_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->integer('id_perdedor')->nullable()->unsigned();
            $table->index(["id_perdedor"], 'fk_Publicacion_users3_idx');
            $table->foreign('id_perdedor', 'fk_Publicacion_users3_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->tinyInteger('empate')->default('0');
            $table->tinyInteger('estado')->default('0');
            $table->timestamps();
            
            $table->unique(["id"], 'id_UNIQUE');
        });
    }

    public function down(){
        Schema::dropIfExists($this->set_schema_table);
    }
}
