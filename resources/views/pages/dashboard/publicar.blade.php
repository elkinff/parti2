@extends('layouts.dashboard', ['nav__visible' => true])

@section('nav__content')
	<h1>Hola mundos</h1>
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
			<input class="form-field" type="text" placeholder="¿Por cual equipo deseas apostar?"
				v-model="search">
		</div>
	</div>
	

	<div class="container__matchs">
		
		<a class="match match--publicar" data-toggle="modal" data-target="#modalApostar"
			v-for="match in filteredMatch"
			v-if="validacionHora(match.date_show)"
			@click="detailMatch(match)"
			> 

			<div class="match__header">
				@{{ match.date_show }}
			</div>
			<div class="match__content">
				<div class="match__equipo">

					<div class="match__equipo__escudo">
						{{-- <img :src="match.imageHomeTeam" width="50"> --}}
						{{-- <div class="image__team" :style="{'background-image' :'url(' + match.imageHomeTeam + ')'}"></div> --}}

						<div class="image__team" 
							:style="{ 'background-image': imageUrl(match.imageHomeTeam) }">
						</div>	
					</div>

					<div class="match__equipo__nombre">
						@{{ match.homeTeamName }}
					</div>

				</div>


				<div class="match__equipo">
					<div class="match__equipo__escudo">
						{{-- <div class="image__team" 
							:style="{ 'background-image' : 'url(' + match.imageAwayTeam + ')'}"></div> --}}
						<div class="image__team" 
							:style="{ 'background-image': imageUrl(match.imageAwayTeam) }">
						</div>	

							
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


