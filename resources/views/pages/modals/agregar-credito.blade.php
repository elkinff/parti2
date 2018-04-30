<div id="modalAgregarCredito" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header">
	      		<h3>Agregar Crédito</h3>
	      	</div>

	      	<div class="modal-body">
        
		        {{ csrf_field() }}
		        
		        <div class="columns">
		         	<div class="form-element xs-6">
		                <label class="radio fancy">
		                    <input type="radio" name="creditoAgregar" value="10000">
		                    <div></div>
		                    <span>$10.000</span>
		                </label>
		            </div>

		            <div class="form-element xs-6 ">
		                <label class="radio fancy">
		                    <input type="radio" name="creditoAgregar" value="20000">
		                    <div></div>
		                    <span>$20.000</span>
		                </label>
		            </div>
		        </div>

		        <div class="columns">
		         	<div class="form-element xs-6">
		                <label class="radio fancy">
		                    <input type="radio" name="creditoAgregar" value="30000">
		                    <div></div>
		                    <span>$30.000</span>
		                </label>
		            </div>

		            <div class="form-element xs-6">
		                <label class="radio fancy">
		                    <input type="radio" name="creditoAgregar" value="50000">
		                    <div></div>
		                    <span>$50.000</span>
		                </label>
		            </div>
		        </div>

		        <div class="columns">
		         	<div class="form-element xs-6">
		                <label class="radio fancy">
		                    <input type="radio" name="creditoAgregar" value="100000">
		                    <div></div>
		                    <span>$100.000</span>
		                </label>
		            </div>

		            <div class="form-element xs-6">
		                <label class="radio fancy">
		                    <input type="radio" name="creditoAgregar" value="200000">
		                    <div></div>
		                    <span>$200.000</span>
		                </label>
		            </div>

		            <div class="form-element xs-6">
		                <label class="radio fancy">
		                    <input type="radio" name="creditoAgregar" value="valor">
		                    <div></div>
		                    <span>Otro valor</span>
		                </label>
		            </div>

		        </div>
		        

		        <div class="form-element">
		            <label>Otro Valor</label>
		            <div>
		                <input type="text" disabled :value="creditoAgregar" id="agregarOtroValor" name="valor" class="form-field"
		                	v-validate="'prueba'"
		                	@input="creditoAgregar = $options.filters.currency($event.target.value)"
		                	:class="{'error': errors.has('valor') }"
		                	>
						<span v-show="errors.has('valor')">
							@{{ errors.first('valor') }}
						</span>
						
		            </div>
		        </div>

		        <span v-show="errorCredito" class="equipos__error">
					@{{ errorCredito }}
				</span>
		        
				<br>

		        <div>

		        	<div class="container__loader" v-if="loadingPago">
						<img src="{{ secure_asset('img/loader__parti2.gif') }}" alt="Loader Parti2">	
						<span>Cargando...</span>
					</div>
					
					<div v-else>
	            		<button class="btn block center" :disabled="errors.has('valor')" @click="agregarCredito()">Agregar</button>
					</div>
		        </div>
	      	</div>

			{{-- <div class="modal-footer">
			
			</div> --}}
	    </div>
	</div>
</div>