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
			<h2>Iniciar Sesión</h2>	
		</div>
		
		<div class="form-element form__social">

            <button class="btn border icon-svg sm-4">
            	Iniciar con
            	<img src="{{ asset('img/google.svg') }}" class="icon-image" width="30px" alt="Google Parti2">
            </button>

            <button class="btn border icon-svg">
            	Iniciar con
            	<img src="{{ asset('img/facebook.svg') }}" class="icon-image" width="30px" alt="Google Parti2">
            </button>
            
        </div>

		
		<div class="form-element">
            <label>Correo Electrónico</label>
            <div>
                <input type="email" class="form-field">
                {{-- <span>Formato invalido</span> --}}
            </div>
        </div>

        <div class="form-element">
            <label>Contraseña</label>
            <div>
                <input type="password" class="form-field">
            </div>
        </div>

        <div>
        	<button class="btn block center">Ingresar</button>
        </div>
		
		<div class="form__links">
            <a href="{{ url('recuperar') }}">¿Olvidaste tu contraseña?</a><br>
            <a href="{{ url('register') }}">¿No tienes una cuenta ? Créala aquí</a>
		</div>
	</form>

    
@endsection

