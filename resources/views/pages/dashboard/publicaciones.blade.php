@extends('layouts.dashboard', ['nav__visible' => false])


@section('content')
	
	{{-- 
		0: Publicado - espera de match - Pagado
		1: Match
		2: Publicación terminada - Terminé partido
		3: Pendiente por pagar
		4: Cancelado 
	--}}

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
				@foreach($publicacionesUsuario as $publicacion  )
					<tr>
						<td data-th="Partido">
							{{ $publicacion->equipo_local->nombre }} vs  {{ $publicacion->equipo_visitante->nombre }} 
						</td>
						<td data-th="Tipo">
							@if($publicacion->id_usu_receptor)
								Publicación
							@else
								Match
							@endif
							
						</td>
						<td data-th="Fecha"> {{ $publicacion->partido->date_show }} </td>
						<td data-th="Monto">${{ number_format($publicacion->valor) }}</td>
						<td data-th="Estado">
							<div class="message-detail__info">
								@if( $publicacion->estado == 0 )
									Publicado en espera de match
								@elseif( $publicacion->estado == 1 )	
									 Match
								@elseif( $publicacion->estado == 2 )	
								 	Match terminado	
								@elseif( $publicacion->estado == 3 )	
								 	Pendiente por pagar	
								@else	
								 	Cancelado
								@endif
							</div>
						</td>
						<td data-th="Acción"><button class="btn sm secondary">Ver</button></td>
					</tr>
				@endforeach
				
			</tbody>
		</table>
	</div>
@endsection

