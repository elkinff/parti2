@extends('layouts.dashboard', ['nav__visible' => true])


@section('nav__content')
	
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
	

	<ais-index app-id="{{ config('scout.algolia.id') }}"
           api-key="{{ env('ALGOLIA_SEARCH') }}"
           index-name="publicacion">

       <ais-input placeholder="Busqueda partidos"></ais-input>
       
       <ais-results class="container__matchs">
           	<template slot-scope="{ result }">
		   	
				<div class="match">
					<div class="match__header">
						@{{ result.partido.fecha_inicio }}
					</div>
					<div class="match__content">
						<div class="match__equipo" 
							:class="{  'match__equipo--selected' : result.partido.equipo_local.usuario }">

							<div class="match__equipo__escudo">
								<div class="image__team" 
									:style="{ 'background-image': imageUrl( result.partido.equipo_local.escudo ) }">
								</div>	
							</div>

							<div class="match__equipo__nombre">
								@{{ result.partido.equipo_local.nombre }}
							</div>

							<div class="match__equipo__usuario" v-if="result.partido.equipo_local.usuario">
								@{{ result.partido.equipo_local.usuario.nombre }}				
							</div>	

						</div>

						<div class="match__equipo"
							:class="{  'match__equipo--selected' :result.partido.equipo_visitante.usuario }">
							
							<div class="match__equipo__escudo">
								<div class="image__team" 
									:style="{ 'background-image': imageUrl( result.partido.equipo_visitante.escudo ) }">
								</div>
							</div>

							<div class="match__equipo__nombre">
								@{{ result.partido.equipo_visitante.nombre }}
							</div>

							<div class="match__equipo__usuario" v-if="result.partido.equipo_visitante.usuario">
								@{{ result.partido.equipo_visitante.usuario.nombre }}				
							</div>	

						</div>
					</div>
					<div class="match__vs">
						VS
					</div>
					
					<div v-if="result.partido.equipo_local.usuario">
						<div class="match__price match__price--visitante">@{{ result.valor }}</div>
					</div>
					<div v-else>
						<div class="match__price">@{{ result.valor }}</div>
					</div>

				</div>   		
			   	

			</template>
       	</ais-results>


       	<ais-range-input attribute-name="valor" />

		
	</ais-index>


	@include('pages.modals.apostar')

	<div id="overlay"></div>    

    

@endsection


