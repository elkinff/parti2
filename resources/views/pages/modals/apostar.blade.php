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

				        		<input type="radio" name="equipo" v-validate="'required'" :value="auxMatch.idHomeTeam" v-model="id_retador">
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

				        		<input type="radio" name="equipo" v-validate="'required'" :value="auxMatch.idAwayTeam" v-model="id_retador">
				        	</label>
				        	<div class="equipos__name">
				        		@{{ auxMatch.awayTeamName }}
				        	</div>
			        	</div>

		        	  	<span v-show="errors.has('equipo')" class="equipos__error">
							Selecciona tu equipo
						</span>

			        </div>

			        <div class="form-element">
			            <label>Valor (COP)</label>
			            <div>
			                <input type="text" :value="apuesta" name="valor" class="form-field"
			                	v-validate="'required|prueba'"
			                	@input="apuesta = $options.filters.currency($event.target.value)"
			                	:class="{'error': errors.has('valor') }"
			                	>
							<span v-show="errors.has('valor')">
								@{{ errors.first('valor') }}
							</span>

			            </div>
			        </div>
					
					<div class="columns center">
			        	<h4>Ganarás @{{ totalGanancia | currency }}</h4>
					</div>

					<br>

			        <div>

			        	<div class="container__loader" v-if="loadingPago">
							<img src="{{ secure_asset('img/loader__parti2.gif') }}" alt="Loader Parti2">	
							<span>Cargando...</span>
						</div>

						<div v-else>
							@if(Auth::user())
				        		<center>@{{validateCreditoApuesta}}</center>
								<button class="btn block center" @click="validateBeforeSubmit()">Pagar</button>
				        	@else
								<a class="btn block center" href="{{ secure_url('login') }}">Pagar</a>
				        	@endif	
						</div>

			        </div>
			    </div>
	      	</div>

			<div class="modal-footer">
				<button class="btn border" data-toggle="modal" data-target="#modalApostar">Cancelar</button>
				
				@if(Auth::user())
					<input type="hidden" value="{{ Auth::user()->saldo }}" id="saldoUser">
					<span>Tu crédito es de <strong> @{{ saldo_user | currency }} </strong></span>
				@endif
				
			</div>
	    </div>
	</div>
</div>