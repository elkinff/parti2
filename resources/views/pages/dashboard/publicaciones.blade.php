@extends('layouts.dashboard', ['nav__visible' => false])


@section('content')
	

	<div class="publicacion-user">
		<table class="table stripe hover responsive">
			<thead>
				<tr>
					<th>Partido</th>
					<th>Tipo</th>
					<th>Fecha</th>
					<th>Valor</th>
					<th>Estado</th>
					<th></th>
				</tr>
			</thead>
			
			<tbody>
				@foreach($publicacion as $publicacionesUsuario )
					<tr>
						<td data-th="Partido">
							{{ $publicacion->equipo_local }}
						</td>
						<td data-th="Tipo">Match</td>
						<td data-th="Fecha">01/01/2018</td>
						<td data-th="Monto">$100.000</td>
						<td data-th="Estado">Publicado</td>
						<td data-th="Acción"><button class="btn sm secondary">Ver</button></td>
					</tr>
				@endforeach
				
				<tr>
					<td data-th="Partido"><strong>Millonarios</strong> - Nacional</td>
					<td data-th="Tipo">Match</td>
					<td data-th="Fecha">01/01/2018</td>
					<td data-th="Monto">$100.000</td>
					<td data-th="Estado">Publicado</td>
					<td data-th="Acción"><button class="btn sm secondary">Ver</button></td>
				</tr>


			</tbody>
		</table>
	</div>
@endsection

