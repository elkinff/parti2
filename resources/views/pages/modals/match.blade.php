<div id="modalApostar" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header">
	      		<center>

	      			<h3>Tu apuesta es a favor de </h3>

		      		<div v-if="!auxMatch2.equipo_local.seleccionado">
		      			@{{ auxMatch2.equipo_local.nombre }}
		      		</div>

		      		<div v-else>
		      			<h4>@{{ auxMatch2.equipo_visitante.nombre }}</h4>
		      		</div>

	      		</center>

	      	</div>

	      	<div class="modal-body">
				
				<div class="" >
        
			        {{ csrf_field() }}

			        <div class="equipos">
			        	<div class="equipos__item">
				        	<label class="radio">

				        		<div class="equipos__escudo" 
				        			:class="{ check : !auxMatch2.equipo_local.seleccionado }">
				        			
				        			<div class="image__team" 
				        				:style="{'background-image' :'url(' + auxMatch2.equipo_local.escudo + ')'}">
				        				
				        			</div>
				        		</div>	

				        	</label>

				        	<div class="equipos__name">
				        		@{{ auxMatch2.equipo_local.nombre }}
				        	</div>

			        	</div>

			        	<div class="equipos__item"> 
				        	<label class="radio">

				        		<div class="equipos__escudo"
				        			:class="{ check : !auxMatch2.equipo_visitante.seleccionado }">

				        			<div class="image__team" 
				        				:style="{'background-image' :'url(' + auxMatch2.equipo_visitante.escudo + ')'}">
				        			</div>

				        		</div>	

				        	</label>

				        	<div class="equipos__name">
				        		@{{ auxMatch2.equipo_visitante.nombre }}
				        	</div>
			        	</div>

		        	  	<span v-show="errors.has('equipo')" class="equipos__error">
							Selecciona tu equipo
						</span>

			        </div>

			        {{-- <div class="form-element">
			            <label>Valor (COP)</label>
			            <center><h4>@{{ auxMatch2.valor | currency }}</h4></center>
			        </div> --}}
					
					<div class="columns center">
			        	<h4>Ganarás @{{ auxMatch2.ganancia_match | currency  }}</h4>
					</div>

					<br>

			        <div>

			        	<div class="container__loader" v-if="loadingPago">
							<img src="{{ asset('img/loader__parti2.gif') }}" alt="Loader Parti2">	
							<span>Cargando...</span>
						</div>

						<div v-else>
							@if(Auth::user())
				        		<center>@{{validateCreditoApuesta}}</center>
								
								<button class="btn block center" @click="savePublicacion()">
									Pagar @{{ auxMatch2.valor | currency }}
								</button>

				        	@else
								<a class="btn block center" href="{{ url('login') }}">
									Pagar @{{ auxMatch2.valor | currency }}
								</a>
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