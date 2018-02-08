<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache;
use DateTime;
use DateTimeZone;
use App\Equipo;
use App\Partido;

class PartidoController extends Controller{

	public function index(){
		return view("pages.dashboard.publicar");
	}

	public function getPartidos(){
		//Validar si ya se ha consultado a la api
		if (!Cache::get('fixtures')) {
	    	$fechaHoy = date("Y-m-d");
			$fechaFinal = date("Y-m-d",strtotime($fechaHoy."+ 7 days"));
			$ultimaHora = new DateTime(date('r', strtotime('tomorrow') - 1));

			//Liga Española PD, Premier league PL, Liga Italiana SA, Champions League CL
			$competiciones = array("PD", "PL", "SA", "CL");
			$fixturesFinal = collect();
			foreach ($competiciones as $competicion) {
				$urlApi = "http://api.football-data.org/v1/fixtures?timeFrameStart=".$fechaHoy."&timeFrameEnd=".$fechaFinal."&league=".$competicion;	
				$reqPrefs['http']['method'] = 'GET';
		    	$reqPrefs['http']['header'] = 'X-Auth-Token: bc763b6f15d546928ac8ce3efbb42544';
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
				$liga = str_replace("http://api.football-data.org/v1/competitions/", "", $fixture->_links->competition->href);
				$idPartido = str_replace("http://api.football-data.org/v1/fixtures/", "", $fixture->_links->self->href);
				
				$fixture->partido = $idPartido;
				$fixture->league = $liga;
				$fixture->idHomeTeam = $idHomeTeam;
				$fixture->idAwayTeam = $idAwayTeam;
				$fixture->imageHomeTeam = Equipo::getImagenEquipo($idHomeTeam, $fixture->_links->homeTeam->href, $liga, $fixture->homeTeamName);
				$fixture->imageAwayTeam = Equipo::getImagenEquipo($idAwayTeam, $fixture->_links->awayTeam->href, $liga, $fixture->awayTeamName);
				$fixture->date_show = Partido::setDateMatch($fixture->date);
				// $fixture->date_show = Partido::setDateMatch($fixture->date);

				$dateTime = new DateTime($fixture->date, new DateTimeZone('UTC'));
				$dateTime->setTimezone(new DateTimeZone("America/Bogota"));
				$fixture->date = $dateTime->format('Y-m-d H:i:s');
				return $fixture;
			});

		   	Cache::put('fixtures', $fixturesFinal->collapse(), $ultimaHora);	
	    }
	    //Ordenar json por hora del partido
	    $sortFixtures = Cache::get("fixtures")->toArray();
	   	usort($sortFixtures, function($a, $b) {
   			return (strtotime($a->date) < strtotime($b->date) ? -1 : 1);
 		});

 		// foreach ($sortFixtures as $key => $value) {
 			
			// dd();
 			
 		// }
 		return $sortFixtures;
	}   
}
