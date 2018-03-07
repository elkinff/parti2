@extends('layouts.dashboard', ['nav__visible' => false])

@section('content')	
		
	{{-- 
		0: Publicado - espera de match - Pagado
		1: Match
		2: Publicación terminada - Terminé partido
		3: Pendiente por pagar
		4: Cancelado
	--}}

	@if(Auth::user())
		<input type="hidden" id="idUsuario" value="{{ Auth::user()->id }}">
	@endif

	<div class="message-detail">
		<div class="message-detail__icon">
			<img src="{{ asset('img/users.svg') }}">
		</div>

		<div class="message-detail__info">
			@if( $publicacion->estado == 0 )
				<h3>Estado: Publicado en espera de match</h3>
			@elseif( $publicacion->estado == 1 )	
				<h3>Estado : Match</h3>
			@elseif( $publicacion->estado == 2 )	
				<h3>Estado : Match terminado</h3>	
			@elseif( $publicacion->estado == 3 )	
				<h3>Estado : Pendiente por pagar</h3>	
				<p>
					@isset($tipoPago)	
						@if($tipoPago == 'BA')
							Puedes acercarte a un punto Baloto para terminar de realizar el pago
						@elseif($tipoPago == 'EF')	
							Puedes acercarte a un punto Efecty para terminar de realizar el pago
						@elseif($tipoPago == 'GA')	
							Puedes acercarte a un punto Gana para terminar de realizar el pago
						@elseif($tipoPago == 'PR')	
							Puedes acercarte a un punto Punto Red para terminar de realizar el pago
						@elseif($tipoPago == 'RS')	
							Puedes acercarte a un punto Red Servi para terminar de realizar el pago	
						@else 
							La trasacción se esta confirmando, esto puede tardar unos minutos	
						@endif
						
					@endisset
				</p>
			@else	
				<h3>Estado : Cancelado</h3>
			@endif
			
		</div>

	</div>

	<div class="container-detail">

		@if( $publicacion->estado == 0 ) 
			<div class="match" data-toggle="modal" data-target="#modalApostar" @click="detailPublicacion({{$publicacion}}, 'detalle')">
		@else 
			<div class="match">
		@endif
		
			<div class="match__header">
				{{ $publicacion->partido->date_show }}
			</div>
			<div class="match__content">
				<div class="match__equipo ">

					<div class="match__equipo__escudo">
						<div class="image__team image__team--large" 
							style="background-image:  url(../{{ $publicacion->equipo_local->escudo }}) ">
						</div>
					</div>

					<div class="match__equipo__nombre">
						{{ $publicacion->equipo_local->nombre }}
					</div>
					@if($publicacion->equipo_local->usuario)
						<div class="match__equipo__usuario  match__equipo__usuario--large">
							{{ $publicacion->equipo_local->usuario->nombre }}
						</div>
					@endif

				</div>
				
				<div class="match__equipo match__equipo--selected">
					
					<div class="match__equipo__escudo">
						<div class="image__team image__team--large" 
							style="background-image: url(../{{ $publicacion->equipo_visitante->escudo }}) ">
						</div>
					</div>

					<div class="match__equipo__nombre">
						{{ $publicacion->equipo_visitante->nombre }}
					</div>
					@if( $publicacion->equipo_visitante->usuario )
						<div class="match__equipo__usuario match__equipo__usuario--large">
							{{ $publicacion->equipo_visitante->usuario->nombre }}
						</div>
					@endif

				</div>
			</div>
			<div class="match__vs">
				VS
			</div>

			<div class="match__price">${{ number_format($publicacion->valor) }}</div>
		</div>
	
		@if( $publicacion->estado == 0 )
			<div class="form-element">
	        	
	        	<label>
	        		Copia el siguiente link y compártelo, así tendrás mas posibilidades de encontrar tu match
	        	</label>

	            <div class="form-group">
	                <input class="form-field" type="url" id="inputLinkCompartir" value="{{ url($publicacion->link) }}">
	                 <button class="btn sm" id="buttonCompartir">
	                    <i class="icon-layers"></i>
	                    Copiar
	                </button>
	            </div>
	        </div>
		@endif
	</div>



	@include('pages.modals.match')

	<div id="overlay"></div>

@endsection








