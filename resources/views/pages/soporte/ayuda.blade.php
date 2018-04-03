@extends('layouts.auth')

@section('image__auth')
	<img src="{{asset('img/copa.svg')}}" alt="Login Parti2">
@endsection

@section('form__auth')
	
     <!-- Include this after the sweet alert js file -->
    @include('sweet::alert')

	{{-- Forma Azul --}}
	<img src="{{ asset('img/forma__footer.svg') }}" alt="Parti2 Login" class="forma__auth forma__auth--footer">

	<form class="form">
		
		<div class="form__title">
			<h2>Contáctanos</h2>	
            <p>Si necesitas ayuda o tienes cualquier inquietud contáctanos</p>
		</div>
		
        <div class="form-element">
            <label>Nombre</label>
            <div>
                <input type="text" class="form-field">
            </div>
        </div>

		<div class="form-element">
            <label>Correo Electrónico</label>
            <div>
                <input type="email" class="form-field">
            </div>
        </div>

        <div class="form-element">
            <label>Mensaje</label>
            <div>
                <textarea name="" id="" cols="30" rows="3" class="form-field"></textarea>
            </div>
        </div>

        <div>
        	<button class="btn block center">Enviar</button>
        </div>
        
		{{-- <div class="form__links">
            <a href="{{ url('recuperar') }}">¿Olvidaste tu contraseña?</a><br>
		</div> --}}
	</form>
@endsection

