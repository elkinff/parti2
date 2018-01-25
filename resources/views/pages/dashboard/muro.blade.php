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
		@for($i=0; $i < 20; $i++)
			
			<a class="match" data-toggle="modal" data-target="#modalApostar"> 
				<div class="match__header">
					24 de Febrero 2018
				</div>
				<div class="match__content">
					<div class="match__equipo">

						<div class="match__equipo__escudo">
							<img src="{{ asset('img/medellin.svg') }}">
						</div>

						<div class="match__equipo__nombre">
							Real Cartegena
						</div>

						<div class="match__equipo__usuario">
							Oscar Soler 
						</div>

					</div>


					<div class="match__equipo">
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
			</a>

		@endfor
		
	</div>

	@include('pages.modals.apostar')

	<div id="overlay"></div>
@endsection


