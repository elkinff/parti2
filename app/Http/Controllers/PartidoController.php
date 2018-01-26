<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache;
use DateTime;
use App\Equipo;
use App\Partido;

class PartidoController extends Controller{
	
    public function __construct(){
        $this->middleware('auth', ["only" => ["create", "store"]]);
    }

	public function index(){
		return view("pages.dashboard.publicar");
	}

	public function getPartidos(){
		//Validar si ya se ha consultado a la api
		if (!Cache::get('fixtures')) {
	    	$fechaHoy = date("Y-m-d");
			$fechaFinal = date("Y-m-d",strtotime($fechaHoy."+ 7 days"));
			$ultimaHora = new DateTime(date('r', strtotime('tomorrow') - 1));

			//Premier league PL, Liga Española PD, Champions League CL, Europa League EL
			$competiciones = array("PL", "PD", "EL", "CL");
			$fixturesFinal = collect();
			foreach ($competiciones as $competicion) {
				$urlApi = "http://api.football-data.org/v1/fixtures?timeFrameStart=".$fechaHoy."&timeFrameEnd=".$fechaFinal."&league=".$competicion;	
				$reqPrefs['http']['method'] = 'GET';
		    	// $reqPrefs['http']['header'] = 'X-Auth-Token: bc763b6f15d546928ac8ce3efbb42544';
			    $stream_context = stream_context_create($reqPrefs);
			    $response = file_get_contents($urlApi, false, $stream_context);
			    $fixturesCompetition = json_decode($response);
			    $fixturesCompetitionFinal = $fixturesCompetition->fixtures;
			    if (!empty($fixturesCompetitionFinal)){
			    	$fixturesFinal->push($fixturesCompetitionFinal);	
			    }
			}

			//Obtener datos de cada equipo
			$fixturesFinal->collapse()->each(function($fixture){
				$idHomeTeam = str_replace("http://api.football-data.org/v1/teams/", "", $fixture->_links->homeTeam->href);
				$idAwayTeam = str_replace("http://api.football-data.org/v1/teams/", "", $fixture->_links->awayTeam->href);
				$fixture->league = str_replace("http://api.football-data.org/v1/competitions/", "", $fixture->_links->competition->href);
				$fixture->idHomeTeam = $idHomeTeam;
				$fixture->idAwayTeam = $idAwayTeam;
				$fixture->imageHomeTeam = Equipo::getImagenEquipo($idHomeTeam, $fixture->_links->homeTeam->href);
				$fixture->imageAwayTeam = Equipo::getImagenEquipo($idAwayTeam, $fixture->_links->awayTeam->href);
				$fixture->date_show = Partido::setDateMatch($fixture->date);
				return $fixture;
			});
		   	Cache::put('fixtures', $fixturesFinal->collapse(), $ultimaHora);	
	    }
	    $sortFixtures = Cache::get("fixtures")->toArray();
	   	usort($sortFixtures, function($a, $b) {
   			return (strtotime($a->date) < strtotime($b->date) ? -1 : 1);
 		});
 		return $sortFixtures;
	}   
}
