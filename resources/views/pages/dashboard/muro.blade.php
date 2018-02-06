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
	


	@include('pages.modals.apostar')

	<div id="overlay"></div>    

    

@endsection


