<div id="modalRetirarCredito" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header">
	      		<h3>Retirar</h3>
	      	</div>

	      	<div class="modal-body">
				
				<form class="" method="POST" action="{{ route('login') }}">
        
			        {{ csrf_field() }}
			        
			        <div class="form-element ">
		                <label class="radio fancy">
		                    <input type="radio" name="radio" value="2">
		                    <div></div>
		                    <span>Nequi</span>
		                </label>
		            </div>

		            <div class="form-element ">
		                <label class="radio fancy">
		                    <input type="radio" name="radio" value="2">
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
			                <input type="number" class="form-field{{ $errors->has('celular') ? ' error' : '' }}" name="celular" required>
			                @if ($errors->has('celular'))
			                    <span class="">
			                        {{ $errors->first('celular') }}
			                    </span>
			                @endif
			            </div>
			        </div>

			        <div>
			            <button class="btn block center">Retirar</button>
			        </div>

			    </form>
	      	</div>

			{{-- <div class="modal-footer">
				<button class="btn">compartir</button>
			</div> --}}
	    </div>
	</div>
</div>