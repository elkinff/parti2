@extends('layouts.dashboard', ['nav__visible' => false])


@section('content')	
	
	<div class="container-detail">
		<div class="match">
			<div class="match__header">
				24 de Febrero 2018
			</div>
			<div class="match__content">
				<div class="match__equipo ">

					<div class="match__equipo__escudo">
						<img src="{{ asset('img/medellin.svg') }}">
					</div>

					<div class="match__equipo__nombre">
						Real Cartegena
					</div>

					<div class="match__equipo__usuario">
						{{-- Oscar Soler  --}}
					</div>	

				</div>


				<div class="match__equipo match__equipo--selected">
					<div class="match__equipo__escudo">
						<img src="{{ asset('img/millonarios.svg') }}">
					</div>

					<div class="match__equipo__nombre">
						Millonarios FC
					</div>

					<div class="match__equipo__usuario">
						Oscar Soler 
					</div>	

				</div>
			</div>
			<div class="match__vs">
				VS
			</div>

			<div class="match__price">$50.000</div>
		</div>

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
	</div>	




@endsection

