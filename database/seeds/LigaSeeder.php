<?php

use Illuminate\Database\Seeder;

class LigaSeeder extends Seeder{
 
    public function run(){ 
        DB::table("liga")->insert([
    		["id" => 455, "nombre" => "Liga Española"],
    		["id" => 445, "nombre" => "Premier League"],
    		["id" => 456, "nombre" => "Liga Italiana"],
    		["id" => 464, "nombre" => "Champions League"],
    		["id" => 467, "nombre" => "Mundial Rusia 2018"]
    	]);
    }
}
