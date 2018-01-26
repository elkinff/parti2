<div id="modalApostar" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header">
	      		<h3>Apostar a favor de </h3>
	      	</div>

	      	<div class="modal-body">
				
				<div class="" >
        
			        {{ csrf_field() }}
			        
			        <div class="equipos">
			        	<div class="equipos__item">
				        	<label class="radio">

				        		<div class="equipos__escudo img-check">
				        			<div class="image__team" :style="{'background-image' :'url(' + auxMatch.imageHomeTeam + ')'}"></div>
				        		</div>	

				        		<input type="radio" name="equipo">
				        	</label>
				        	<div class="equipos__name">
				        		@{{ auxMatch.homeTeamName }}
				        	</div>
			        	</div>

			        	<div class="equipos__item"> 
				        	<label class="radio">
				        		{{-- <img :src="auxMatch.imageAwayTeam" class="img-check"> --}}

				        		<div class="equipos__escudo img-check">
				        			<div class="image__team" :style="{'background-image' :'url(' + auxMatch.imageAwayTeam + ')'}"></div>
				        		</div>	

				        		<input type="radio" name="equipo">
				        	</label>
				        	<div class="equipos__name">
				        		@{{ auxMatch.awayTeamName }}
				        	</div>
			        	</div>

			        </div>

			        <div class="form-element">
			            <label>Valor</label>
			            <div>
			                <input type="number" class="form-field{{ $errors->has('celular') ? ' error' : '' }}" name="celular" required
								v-model='apuesta'
			                >

			                @if ($errors->has('celular'))
			                    <span class="">
			                        {{ $errors->first('celular') }}
			                    </span>
			                @endif
			            </div>
			        </div>
					
					<div class="columns center">
			        	<h4>Ganarás @{{ totalGanancia | currency }}</h4>
					</div>

					<br>

			        <div>
			            <button class="btn block center" @click="savaMatch()">Apostar</button>
			        </div>

			    </div>
	      	</div>

			<div class="modal-footer">
				<button class="btn border" data-toggle="modal" data-target="#modalApostar">Cancelar</button>
				@if(Auth::user())
					<span>Tu crédito es de {{ Auth::user()->saldo }} !</span>
				@endif
				
			</div>
	    </div>
	</div>
</div>