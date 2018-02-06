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
	

	<div class="container__matchs" id="container__matchs">
			
	{{-- 	<div class="match">
			<div class="match__header">
				24 de Febrero 2018
			</div>
			<div class="match__content">
				<div class="match__equipo ">

					<div class="match__equipo__escudo">
						<img src="{{ asset('img/medellin.svg') }}">
					</div>

					<div class="match__equipo__nombre">
						Real Cartegena
					</div>

					<div class="match__equipo__usuario">
						
					</div>	

				</div>

				<div class="match__equipo match__equipo--selected">
					<div class="match__equipo__escudo">
						<img src="{{ asset('img/millonarios.svg') }}">
					</div>

					<div class="match__equipo__nombre">
						Millonarios FC
					</div>

					<div class="match__equipo__usuario">
						Oscar Soler 
					</div>	

				</div>
			</div>
			<div class="match__vs">
				VS
			</div>

			<div class="match__price">$50.000</div>
		</div> --}}
	
	</div>
	

	@include('pages.modals.apostar')

	<div id="overlay"></div>    

    

@endsection


