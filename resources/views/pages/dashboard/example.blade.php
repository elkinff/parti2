@extends('layouts.dashboard')


@section('nav_bar')
	@include('includes._nav')
@endsection


@section('content')

	<a href="#" id="buttonFiltros">Todos los filtros</a>

	<div class="form-element busqueda">
		<div class="form-group">
			<span>
				<img src="{{ asset('img/search.svg') }}" alt="Busqueda Parti2" class="icon">	
			</span>
			<input class="form-field" type="text" placeholder="¿Por cual equipo deseas apostar?">
		</div>
	</div>
	
	<h1>Hola mundos</h1>
	<h2>Hola mundos</h2>
	<h3>Hola mundos</h3>
	<h4>Hola mundos</h4>

	<div class="div tarjeta">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		lorem
		<br>
		<div class="btn md" data-toggle="modal" data-target="#modalProducto">Abrir Modal</div>
	</div>		

	<br>

	<div class="container__matchs">
		{{-- @for($i=0; $i < 20; $i++) --}}
			
			<div class="match">
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
							{{-- Oscar Soler  --}}
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
			</div>

		{{-- @endfor --}}
		
	</div>


	<div class="container__matchs">
		{{-- @for($i=0; $i < 20; $i++) --}}
			
			<div class="match match--publicar">
				<div class="match__header">
					24 de Febrero 2018
				</div>
				<div class="match__content">
					<div class="match__equipo ">

						<div class="match__equipo__escudo">
							<img src="{{ asset('img/medellin.svg') }}">
						</div>

						<div class="match__equipo__nombre">
							Ind Medellín
						</div>

						<div class="match__equipo__usuario">
							{{-- Oscar Soler  --}}
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
						</div>	

					</div>
				</div>
				<div class="match__vs">
					VS
				</div>

				{{-- <div class="match__price">$50.000</div> --}}
			</div>

		{{-- @endfor --}}
		
	</div>


		<div class="container__matchs">
		{{-- @for($i=0; $i < 20; $i++) --}}
			
			<div class="match">
				<div class="match__header">
					24 de Febrero 2018
				</div>
				<div class="match__content">
					<div class="match__equipo match__equipo--selected">

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
							{{-- Oscar Soler  --}}
						</div>	

					</div>
				</div>
				<div class="match__vs">
					VS
				</div>

				<div class="match__price match__price--visitante">$50.000</div>

			</div>

		{{-- @endfor --}}
		
	</div>





	<br>

	<table class="table stripe hover responsive">
		<thead>
			<tr>
				<th>Fecha</th>
				<th>Tipo</th>
				<th>Partido</th>
				<th>Monto</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td data-th="Fecha">01/01/2018</td>
				<td data-th="Retiro">Retiro</td>
				<td data-th="Partido">Millonarios - Nacional</td>
				<td data-th="Monto">$100.000</td>
			</tr>

			<tr>
				<td data-th="Fecha">01/01/2018</td>
				<td data-th="Retiro">Retiro</td>
				<td data-th="Partido">Millonarios - Nacional</td>
				<td data-th="Monto">$100.000</td>
			</tr>
		</tbody>
	</table>

	
	{{-- Modal Porducto --}}
<div id="modalProducto" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header">
	      		<h3>Compartir</h3>
	      	</div>

	      	<div class="modal-body">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	      	</div>
			<div class="modal-footer">
				<button class="btn">compartir</button>
			</div>
	    </div>
	</div>
</div>


<div id="overlay"></div>
@endsection

