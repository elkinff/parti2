<div id="modalRetirarCredito" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header">
	      		<h3>Retirar</h3>
	      	</div>

	      	<div class="modal-body">
				
				<form class="" method="POST" action="{{ route('credito.retirar') }}">
        
			        {{ csrf_field() }}
			        
			        <div class="form-element ">
		                <label class="radio fancy">
		                    <input type="radio" name="metodo" value="nequi" required>
		                    <div></div>
		                    <span>Nequi</span>
		                </label>
		            </div>

		            <div class="form-element ">
		                <label class="radio fancy">
		                    <input type="radio" name="metodo" value="daviplata" required>
		                    <div></div>
		                    <span>Daviplata</span>
		                </label>
		            </div>

			        <div class="form-element">
			            <label>Celular</label>
			            <div>
			                <input type="number" class="form-field{{ $errors->has('celular') ? ' error' : '' }}" name="celular" required>
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
			                	v-validate="'prueba'"
			                	:value="creditoRetirar"
			                	@input="creditoRetirar = $options.filters.currency($event.target.value)"
			                	:class="{'error': errors.has('valor') }"
			                	>
							<span v-show="errors.has('valor')">
								@{{ errors.first('valor') }}
							</span>
							
			            </div>
			        </div>

			        <center>@{{validateRetiroCredito}}</center>
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