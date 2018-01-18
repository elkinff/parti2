<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration{

    public function up(){
        Schema::create('users', function (Blueprint $table) {
           $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('correo', 45);
            $table->string('contraseña', 45)->nullable();
            $table->string('nombre', 90);
            $table->bigInteger('celular')->nullable();
            $table->string('foto', 60)->nullable();
            $table->string('id_google', 45)->nullable();
            $table->string('id_facebook', 45)->nullable();
            $table->bigInteger('saldo')->default('0');

            $table->integer('id_configuracion_retiro')->nullable()->unsigned();
            $table->index(["id_configuracion_retiro"], 'fk_Usuario_Configuracion_Retiro1_idx');
            $table->foreign('id_configuracion_retiro', 'fk_Usuario_Configuracion_Retiro1_idx')
                ->references('id')->on('configuracion_retiro')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->rememberToken();
            $table->timestamps();

            $table->unique(["correo"], 'correo_usu_UNIQUE');
            $table->unique(["id"], 'id_UNIQUE');
            $table->unique(["id_google"], 'id_google_UNIQUE');
            $table->unique(["id_facebook"], 'id_facebook_UNIQUE');
        });
    }

    public function down(){
        Schema::dropIfExists('users');
    }
}
