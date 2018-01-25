@extends('layouts.dashboard')


@section('nav_bar')
	@include('includes._nav')
@endsection


@section('content')
	
	<a href="#" id="buttonFiltros">
		Ver todos los filtros
	</a>

	<div class="form-element busqueda busqueda__equipo">
		<div class="form-group">
			<span>
				<img src="{{ asset('img/search.svg') }}" alt="Busqueda Parti2" class="icon">	
			</span>
			<input class="form-field" type="text" placeholder="¿Por cual equipo deseas apostar?">
		</div>
	</div>

	<div class="container__matchs">
		
		<a class="match match--publicar" data-toggle="modal" data-target="#modalApostar"
			v-for="match in matchs"
			> 

			<div class="match__header">
				@{{ match.date }}
			</div>
			<div class="match__content">
				<div class="match__equipo">

					<div class="match__equipo__escudo">
						<img :src="match.imageHomeTeam" width="50">
					</div>

					<div class="match__equipo__nombre">
						@{{ match.homeTeamName }}
					</div>

				</div>


				<div class="match__equipo">
					<div class="match__equipo__escudo">
						<img :src="match.imageAwayTeam" width="50">
					</div>

					<div class="match__equipo__nombre">
						@{{ match.awayTeamName }}
					</div>

				</div>
			</div>
			<div class="match__vs">
				VS
			</div>

		</a>
	</div>

	@include('pages.modals.apostar')

	<div id="overlay"></div>

@endsection


