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
							@if($publicacion->equipo_local->seleccionado)
								<strong>{{ $publicacion->equipo_local->nombre }}</strong>
								Vs {{ $publicacion->equipo_visitante->nombre }}
							@else 
								{{ $publicacion->equipo_local->nombre }}
								Vs <strong>{{ $publicacion->equipo_visitante->nombre }}</strong>
							@endif
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
									<span style="color: #2ecc71">Publicado en espera de match</span>
								@elseif( $publicacion->estado == 1 )	
									 <span style="color: #F67280"> Match </span>
								@elseif( $publicacion->estado == 2 )	
								 	<span style="color: #355C7D"> Match terminado </span>	
								@elseif( $publicacion->estado == 3 )	
								 	<span style="color: #f39c12"> Publicado pendiente por pagar </span>	
								@else	
								 	<span style="color: #7f8c8d"> Cancelado </span>
								@endif
							</div>
						</td>
						<td data-th="Acción"><a class="btn sm secondary" href="{{ url('publicaciones', $publicacion->id) }}">Ver</a></td>
					</tr>
				@endforeach
				
			</tbody>
		</table>
	</div>
@endsection

