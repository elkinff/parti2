@extends('layouts.dashboard', ['nav__visible' => true])


@section('nav__content')
	
	{{-- Id para enviarlo en el match --}}
	@if(Auth::user())
		<input type="hidden" id="idUsuario" value="{{ Auth::user()->id }}">
	@endif

	<div v-if="filteredPublicaciones.length">
		<h4 class="nav__title__divider">Valor</h4>
		<br>
		<center>
			<vue-slider  v-bind="precio_apuesta" v-model="precio_apuesta.value"></vue-slider>
			<input type="hidden" value="{{ $valor_minimo }}" id="valor_minimo">
			<input type="hidden" value="{{ $valor_maximo }}" id="valor_maximo">
		</center>
	</div>


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
	            <input type="date" class="form-field small dark" placeholder="dd/mm/aaaa" v-model="searchDate">
	            <span><img src="{{ secure_asset('img/calendar.svg') }}" width="20px"></span>
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
	
	<div class="nav__cerrar__mobile">
		<a class="btn block" href="#" id="cerrarModal">Cerrar</a>	
	</div>
	

	<a class="nav__ayuda" target="_blank" href="{{ url('ayuda') }}">
		¿Necesitas ayuda?
	</a>

@endsection


@section('content')
	
	<a href="#" id="buttonFiltros">
		Ver todos los filtros
	</a>

	<div class="form-element busqueda busqueda__equipo">
		<div class="form-group">
			<span>
				<img src="{{ secure_asset('img/search.svg') }}" alt="Busqueda Parti2" class="icon">	
			</span>
			<input class="form-field" type="text" placeholder="¿Por cual equipo deseas apostar?"
				v-model="search">
		</div>
	</div>

	<div class="container__matchs">

		<div class="container__matchs__loader" v-if="loading">
			<img src="{{ secure_asset('img/loader__parti2.gif') }}" alt="Loader Parti2">	
			<span>Cargando...</span>
		</div>
		

		<a class="match match--publicar" data-toggle="modal" data-target="#modalApostar"
			v-for="match in filteredPublicaciones"
			v-cloak
			@click="detailPublicacion(match)"
		>

			<div class="match__header">
				@{{ match.partido.date_show }} 
			</div>
			<div class="match__content">
				<div class="match__equipo" :class="{ 'match__equipo--selected' : match.equipo_local.usuario }">

					<div class="match__equipo__escudo">
						<div class="image__team" 
							:style="{ 'background-image': imageUrl(match.equipo_local.escudo) }">
						</div>
					</div>

					<div class="match__equipo__nombre">
						@{{ match.equipo_local.nombre }}
					</div>

					<div class="match__equipo__usuario" v-if="match.equipo_local.usuario">
						@{{ match.equipo_local.usuario.nombre }}
					</div>	

				</div>


				<div class="match__equipo" :class="{ 'match__equipo--selected' : match.equipo_visitante.usuario }">
					<div class="match__equipo__escudo">
						<div class="image__team" 
							:style="{ 'background-image': imageUrl(match.equipo_visitante.escudo) }">
						</div>	
					</div>

					<div class="match__equipo__nombre">
						@{{ match.equipo_visitante.nombre }}
					</div>

					<div class="match__equipo__usuario" v-if="match.equipo_visitante.usuario">
						@{{ match.equipo_visitante.usuario.nombre }}
					</div>	

				</div>
			</div>
			<div class="match__vs">
				VS
			</div>
	
			<div class="match__price" v-if="match.equipo_visitante.usuario">
				@{{ match.valor | currency }}
			</div>

			<div class="match__price match__price--visitante" v-else>
				@{{ match.valor | currency }}
			</div>

		</a>

		

		<span class="container__matchs__empty"
			:class="{hide: loading}"
			v-cloak
			v-if="!filteredPublicaciones.length"
			>
			<img src="{{ secure_asset('img/empty_search.png') }}">
			Lo sentimos no hay resultados para tu búsqueda <br> Inténtalo con otro torneo o fecha ! 
			<br><br>
			<a class="header__menu__item header__menu__item--accent btn btn" href="{{ url('publicar') }}">
				<span>Crea tu Apuesta</span>
			</a>
		</span>
		
	</div>
	
	@include('pages.modals.match')

	<div id="overlay"></div>

@endsection








