@extends('layouts.auth')

@section('image__auth')
	<img src="{{asset('img/recuperar.svg')}}" alt="Login Parti2">
@endsection

@section('form__auth')
    {{-- Forma Azul --}}
    <img src="{{ asset('img/forma__footer.svg') }}" alt="Parti2 Login" class="forma__auth forma__auth--footer">

	<form class="form">
		
		<div class="form__title">
			<h2>Recuperar Contraseña</h2>	
		</div>
		
		<div class="form-element">
            <label>Correo Electrónico</label>
            <div>
                <input type="email" class="form-field">
            </div>
        </div>

        <div>
        	<button class="btn block center">Recuperar</button>
        </div>

		<div class="form__links">
            <a href="{{ secure_url('login') }}">Iniciar Sesión</a>
		</div>

	</form>

@endsection

