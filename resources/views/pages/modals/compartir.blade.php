<div id="modalCompartir" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header">
	      		<h3>Compartir</h3>

	      	</div>

	      	<div class="modal-body">
				<div class="compartir__image">
					<div class="compartir__item compartir__item--large">
						<img src="{{ asset('img/millonarios.svg') }}">
					</div>	

					<div class="compartir__item">
						<img src="{{ asset('img/medellin.svg') }}">
					</div>	

					<div class="compartir__mensaje">
						<span>Acabo de apostar</span>
						<h3>$50.0000</h3>
						<div>Reta a tus amigos</div>
					</div>

				</div>

				<div class="compartir__redes">
					<img src="{{ asset('img/whatsapp.svg') }}">
				</div>
				
				<button class="btn block border" data-toggle="modal" data-target="#modalCompartir">Cerrar</button>

	      	</div>

			{{-- <div class="modal-footer">

			</div> --}}
	    </div>
	</div>
</div>