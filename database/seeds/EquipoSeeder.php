<?php

use Illuminate\Database\Seeder;

class EquipoSeeder extends Seeder{
    
    public function run(){
        DB::table("equipo")->insert([
    		["id" => 1107, "nombre" => "SPAL Ferrara", "escudo" => "https://upload.wikimedia.org/wikipedia/de/e/e7/SPAL_Ferrara.svg"],
    		["id" => 1106, "nombre" => "Benevento Calcio", "escudo" => "https://upload.wikimedia.org/wikipedia/de/4/48/Benevento_Calcio_Logo.svg"],
    		["id" => 1106, "nombre" => "Benevento Calcio", "escudo" => "https://upload.wikimedia.org/wikipedia/de/4/48/Benevento_Calcio_Logo.svg"],
    	]);
    }
}
