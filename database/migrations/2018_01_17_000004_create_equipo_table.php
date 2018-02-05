<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipoTable extends Migration{
    
    public $set_schema_table = 'equipo';

    public function up(){
        if (Schema::hasTable($this->set_schema_table)) return;
            Schema::create($this->set_schema_table, function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('nombre', 45);
                $table->string('escudo', 512)->nullable();

                $table->unique(["id"], 'id_UNIQUE');
            });
    }

    public function down(){
        Schema::dropIfExists($this->set_schema_table);
    }
}
