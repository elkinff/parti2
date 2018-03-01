<div id="modalRetirarCredito" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header">
	      		<h3>Retirar</h3>
	      	</div>

	      	<div class="modal-body">
				
				<form id="formRetirarCredito" method="POST" action="{{ route('credito.retirar') }}"  
				@submit.prevent="validateBeforeSubmitRetirar()">
        
			        {{ csrf_field() }}
			        
			        <div class="form-element ">
		                <label class="radio fancy">
		                    <input type="radio" name="metodo" value="nequi" v-validate="'required'">
		                    <div></div>
		                    <span>Nequi</span>
		                </label>
		            </div>

		            <div class="form-element ">
		                <label class="radio fancy">
		                    <input type="radio" name="metodo" value="daviplata" v-validate="'required'">
		                    <div></div>
		                    <span>Daviplata</span>
		                </label>
		            </div>

		            <span v-show="errors.has('metodo')" class="equipos__error">
						Debes seleccionar un metodo
					</span>

			        <div class="form-element">
			            <label>Celular</label>
			            <div>
			                <input type="number" class="form-field{{ $errors->has('celular') ? ' error' : '' }}" :class="{'error': errors.has('celular') }"  name="celular" v-validate="'required|digits:10'">
			                
			                <span v-show="errors.has('celular')">
								@{{ errors.first('celular') }}
							</span>

			                @if ($errors->has('celular'))
			                    <span class="">
			                        {{ $errors->first('celular') }}
			                    </span>
			                @endif
			            </div>
			        </div>

			        <div class="form-element">
			            <label>Valor</label>
			            <div>
			                <input type="text" name="valor" class="form-field"
			                	v-validate="'prueba|required'"
			                	:value="creditoRetirar"
			                	@input="creditoRetirar = $options.filters.currency($event.target.value)"
			                	:class="{'error': errors.has('valor') }"
			                	>
							<span v-show="errors.has('valor')">
								@{{ errors.first('valor') }}
							</span>

							@if ($errors->has('valor'))
			                    <span class="">
			                        {{ $errors->first('valor') }}
			                    </span>
			                @endif
							
			            </div>
			        </div>

			        <center class="equipos__error">@{{ validateRetiroCredito }}</center>

			        <br>

			        <div>
			            <button class="btn block center">Retirar</button>
			        </div>

			    </form>
	      	</div>

			<div class="modal-footer">
				<button class="btn border" data-toggle="modal" data-target="#modalRetirarCredito">Cancelar</button>
				<span>Tu saldo actual es de <strong> @{{ saldo_user | currency }} </strong></span>
			</div>
	    </div>
	</div>
</div>