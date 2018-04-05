<div id="modalCompartir" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header">
	      		<h3>Comparte esta publicación</h3>
				<span>Se ha creado la publicación satisfactoriamente</span>
	      	</div>

	      	<div class="modal-body">
		        
                <div class="form-element">
                	<label>Copia el siguiente link y compártelo, así tendrás mas posibilidades de encontrar tu match</label>
                    <div class="form-group">
                        <input class="form-field" type="text" id="inputLinkCompartir" v-model="link_compartir">
                         <button class="btn sm" id="buttonCompartir">
	                        <i class="icon-layers"></i>
	                        Copiar
	                    </button>
                    </div>
                </div>

				<a class="compartir__redes" :href=" 'whatsapp://send?text=' + link_compartir" data-action="share/whatsapp/share">
					<img src="{{ secure_asset('img/whatsapp.svg') }}">
				</a>
				
				<button class="btn block border" data-toggle="modal" data-target="#modalCompartir">Cerrar</button>

	      	</div>

			{{-- <div class="modal-footer">

			</div> --}}
	    </div>
	</div>
</div>