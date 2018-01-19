<div id="modalApostar" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header">
	      		<h3>Apostar a favor de </h3>
	      	</div>

	      	<div class="modal-body">
				
				<form class="" method="POST" action="{{ route('login') }}">
        
			        {{ csrf_field() }}
			        
			        <div class="equipos">
			        	<div class="equipos__item">
				        	<label class="radio">
				        		<img src="{{ asset('img/millonarios.svg') }}" class="img-check">
				        		<input type="radio" name="equipo">
				        	</label>
				        	Millonarios
			        	</div>

			        	<div class="equipos__item"> 
				        	<label class="radio">
				        		<img src="{{ asset('img/medellin.svg') }}" class="img-check">
				        		<input type="radio" name="equipo">
				        	</label>
				        	Medellín
			        	</div>

			        </div>

			        <div class="form-element">
			            <label>Valor</label>
			            <div>
			                <input type="number" class="form-field{{ $errors->has('celular') ? ' error' : '' }}" name="celular" required>
			                @if ($errors->has('celular'))
			                    <span class="">
			                        {{ $errors->first('celular') }}
			                    </span>
			                @endif
			            </div>
			        </div>
					
					<div class="columns center">
			        	<h4>Ganarás $94.000</h4>
					</div>

					<br>

			        <div>
			            <button class="btn block center">Apostar</button>
			        </div>

			    </form>
	      	</div>

			<div class="modal-footer">
				<button class="btn border" data-toggle="modal" data-target="#modalApostar">Cancelar</button>
				<span>Tu crédito es de $100.0000</span>
			</div>
	    </div>
	</div>
</div>