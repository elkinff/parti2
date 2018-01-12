@extends('layouts.auth')

@section('image__auth')
	<img src="{{asset('img/users.svg')}}" alt="Login Parti2">
@endsection

@section('form__auth')
    
    <img src="{{ asset('img/forma__footer_alt.svg') }}" alt="Parti2 Login" class="forma__auth forma__auth--footeralt">

	<form class="form">
		
		<div class="form__title">
			<h2>Registrarse</h2>	
		</div>

		<div class="form-element">
            <label>Nombres</label>
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
            <label>Celular</label>
            <div>
                <input type="number" class="form-field">
            </div>
        </div>

        <div class="form-element">
            <div class="columns">
                <div class="sm-6">
                    <label>Contraseña</label>
                    <div>
                        <input type="password" class="form-field">
                    </div>
                </div>

                <div class="sm-6">
                    <label>Confirmar Contraseña</label>
                    <div>
                        <input type="password" class="form-field">
                    </div>
                </div>
            </div>
        </div>

        <div>
        	<button class="btn block center">Registrarse</button>
        </div>
		
		<div class="form__links">
            <a href="{{url('login')}}">¿Ya tienes una cuenta?</a>
		</div>

	</form>
@endsection




