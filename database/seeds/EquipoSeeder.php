<?php

use Illuminate\Database\Seeder;

class EquipoSeeder extends Seeder{
    
    public function run(){
    	//Premier League
    	// DB::table("equipo")->insert([
    	// 	["id" => 57, "nombre" => "Arsenal FC", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 61, "nombre" => "Chelsea FC", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 61, "nombre" => "Everton FC", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 64, "nombre" => "Liverpool FC", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 65, "nombre" => "Manchester City FC", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 66, "nombre" => "Manchester United FC", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 67, "nombre" => "Newcastle United FC", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 70, "nombre" => "Stoke City FC", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 72, "nombre" => "Swansea City FC", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 73, "nombre" => "Tottenham Hotspur FC", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 74, "nombre" => "West Bromwich Albion FC", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 328, "nombre" => "Burnley FC", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 338, "nombre" => "Leicester City FC", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 340, "nombre" => "Southampton FC", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 346, "nombre" => "Watford FC", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 354, "nombre" => "Crystal Palace FC", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 394, "nombre" => "Huddersfield Town", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 397, "nombre" => "Brighton & Hove Albion", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 563, "nombre" => "West Ham United FC", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 1044, "nombre" => "AFC Bournemouth", "escudo" => public_path("img/teams/PL/")],
    	// ]);

    	// //La Liga
     //    DB::table("equipo")->insert([
    	// 	["id" => 77, "nombre" => "Athletic Club", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 78, "nombre" => "Club Atlético de Madrid", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 80, "nombre" => "RCD Espanyol", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 81, "nombre" => "FC Barcelona", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 82, "nombre" => "Getafe CF", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 84, "nombre" => "Málaga CF", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 86, "nombre" => "Real Madrid CF", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 88, "nombre" => "Levante UD", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 90, "nombre" => "Real Betis", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 92, "nombre" => "Real Sociedad de Fútbol", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 94, "nombre" => "Villarreal CF", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 95, "nombre" => "Valencia CF", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 263, "nombre" => "Deportivo Alavés", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 275, "nombre" => "UD Las Palmas", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 278, "nombre" => "SD Eibar", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 298, "nombre" => "Girona FC", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 558, "nombre" => "RC Celta de Vigo", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 559, "nombre" => "Sevilla FC", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 560, "nombre" => "RC Deportivo La Coruna", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 745, "nombre" => "CD Leganes", "escudo" => public_path("img/teams/PL/")],
    	// ]);

    	// //Calcio Italiano
     //    DB::table("equipo")->insert([
    	// 	["id" => 98, "nombre" => "AC Milan", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 99, "nombre" => "ACF Fiorentina", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 100, "nombre" => "AS Roma", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 102, "nombre" => "Atalanta BC", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 103, "nombre" => "Bologna FC", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 84, "nombre" => "Málaga CF", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 86, "nombre" => "Real Madrid CF", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 88, "nombre" => "Levante UD", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 90, "nombre" => "Real Betis", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 92, "nombre" => "Real Sociedad de Fútbol", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 94, "nombre" => "Villarreal CF", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 95, "nombre" => "Valencia CF", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 263, "nombre" => "Deportivo Alavés", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 275, "nombre" => "UD Las Palmas", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 278, "nombre" => "SD Eibar", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 298, "nombre" => "Girona FC", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 558, "nombre" => "RC Celta de Vigo", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 559, "nombre" => "Sevilla FC", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 560, "nombre" => "RC Deportivo La Coruna", "escudo" => public_path("img/teams/PL/")],
    	// 	["id" => 745, "nombre" => "CD Leganes", "escudo" => public_path("img/teams/PL/")],
    	// ]);
    }
}
