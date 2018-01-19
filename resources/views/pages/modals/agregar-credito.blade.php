<div id="modalAgregarCredito" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header">
	      		<h3>Agregar Crédito</h3>
	      	</div>

	      	<div class="modal-body">
				
				<form class="" method="POST" action="{{ route('login') }}">
        
			        {{ csrf_field() }}
			        
			        <div class="columns">
			         	<div class="form-element xs-6">
			                <label class="radio fancy">
			                    <input type="radio" name="radio" value="2">
			                    <div></div>
			                    <span>$10.000</span>
			                </label>
			            </div>

			            <div class="form-element xs-6 ">
			                <label class="radio fancy">
			                    <input type="radio" name="radio" value="2">
			                    <div></div>
			                    <span>$20.000</span>
			                </label>
			            </div>
			        </div>

			        <div class="columns">
			         	<div class="form-element xs-6">
			                <label class="radio fancy">
			                    <input type="radio" name="radio" value="2">
			                    <div></div>
			                    <span>$30.000</span>
			                </label>
			            </div>

			            <div class="form-element xs-6">
			                <label class="radio fancy">
			                    <input type="radio" name="radio" value="2">
			                    <div></div>
			                    <span>$50.000</span>
			                </label>
			            </div>
			        </div>

			        <div class="columns">
			         	<div class="form-element xs-6">
			                <label class="radio fancy">
			                    <input type="radio" name="radio" value="2">
			                    <div></div>
			                    <span>$100.000</span>
			                </label>
			            </div>

			            <div class="form-element xs-6">
			                <label class="radio fancy">
			                    <input type="radio" name="radio" value="2">
			                    <div></div>
			                    <span>$200.000</span>
			                </label>
			            </div>
			        </div>
			        

			        <div class="form-element">
			            <label>Otro Valor</label>
			            <div>
			                <input type="number" class="form-field{{ $errors->has('celular') ? ' error' : '' }}" name="celular" required>
			                @if ($errors->has('celular'))
			                    <span class="">
			                        {{ $errors->first('celular') }}
			                    </span>
			                @endif
			            </div>
			        </div>

					<br>

			        <div>
			            <button class="btn block center">Agregar</button>
			        </div>

			    </form>
	      	</div>

			{{-- <div class="modal-footer">
			
			</div> --}}
	    </div>
	</div>
</div>