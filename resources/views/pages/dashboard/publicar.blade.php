@extends('layouts.dashboard', ['nav__visible' => true])

@section('nav__content')
	
	{{-- <h2 class="nav__title">Filtros</h2> --}}

	<h4 class="nav__title__divider">Torneos</h4>
	
	<div class="form-element">
        <label class="checkbox fancy white">
            <input type="checkbox" v-model="checkedLigas" value="464">
            <div></div>
            <span class="nav__filter__label">Champions League</span>
        </label>
    </div>

	<div class="form-element">
        <label class="checkbox fancy white">
            <input type="checkbox" v-model="checkedLigas" value="455">
            <div></div>
            <span class="nav__filter__label">Liga Española</span>
        </label>
    </div>

    <div class="form-element">
        <label class="checkbox fancy white">
            <input type="checkbox" v-model="checkedLigas" value="445">
            <div></div>
            <span>Liga Inglesa</span>
        </label>
    </div>


	<div class="form-element">
        <label class="checkbox fancy white">
            <input type="checkbox" v-model="checkedLigas" value="456">
            <div></div>
            <span>Liga Italiana</span>
        </label>
    </div>

    <h4 class="nav__title__divider">Fecha</h4>
	
	<div class="form-element">
        <div>
            <div class="form-group">
	            <input type="date" class="form-field small" placeholder="dd/mm/aaaa" v-model="searchDate">
	            <span><img src="{{ asset('img/calendar.svg') }}" width="20px"></span>
	        </div>
        </div>
    </div>
	
	<div class="filter__tags">
		<label class="checkbox filter__tags__item filter__tags__item--large" id="filterSelectHoy" @click="filterDia('hoy')">
			<div class="">
				Hoy
			</div>
			<input type="checkbox" name="filterDia" id="filterHoy">
		</label>
	</div>

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
		
		<div class="container__matchs__loader" v-if="loading">
			<img src="{{ asset('img/loader__parti2.gif') }}" alt="Loader Parti2">	
			<span>Cargando...</span>
		</div>

		<a class="match match--publicar" data-toggle="modal" data-target="#modalApostar"
			v-cloak
			v-for="match in filteredMatch"
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

		<span class="container__matchs__empty"
			:class="{hide: loading}"
			v-cloak
			v-if="!filteredMatch.length"
			>
			<img src="{{ asset('img/empty_search.png') }}">
			Lo sentimos no hay resultados para tu busqueda <br> Inténtalo nuevamente! 
		</span>

	</div>

	@include('pages.modals.apostar')

	<div id="overlay"></div>

@endsection


