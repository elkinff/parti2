<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableIntencionMatch extends Migration{
    
    public function up(){
        
        Schema::create('intencion_match', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id_publicacion')->unsigned();
            $table->integer('id_usuario')->unsigned();
            
            $table->index(["id_publicacion"], 'fk_publicacion_has_intencion_match1_idx');
            $table->foreign('id_publicacion', 'fk_publicacion_has_intencion_match1_idx')
                ->references('id')->on('publicacion')
                ->onDelete('no action')
                ->onUpdate('no action');
            
            $table->index(["id_usuario"], 'fk_users_has_intencion_match1_idx');
            $table->foreign('id_usuario', 'fk_users_has_intencion_match1_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    public function down(){
        Schema::dropIfExists('intencion_match');
    }
}
