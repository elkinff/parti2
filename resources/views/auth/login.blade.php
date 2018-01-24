@extends('layouts.auth')

@section('image__auth')
    <img src="{{asset('img/copa.svg')}}" alt="Login Parti2">
@endsection

@section('form__auth')



    {{-- Forma Azul --}}
    <img src="{{ asset('img/forma__footer.svg') }}" alt="Parti2 Login" class="forma__auth forma__auth--footer">

    <form class="form" method="POST" action="{{ route('login') }}">
        
        {{ csrf_field() }}

        <div class="form__title">
            <h2>Iniciar Sesión</h2> 
        </div>
        
        <div class="form-element form__social">

            <a class="btn border icon-svg" href="{{ route('social.auth', 'google') }}">
                Iniciar con
                <img src="{{ asset('img/google.svg') }}" class="icon-image" width="30px" alt="Google Parti2">
            </a>

            <a class="btn border icon-svg" href="{{ route('social.auth', 'facebook') }}">
                Iniciar con
                <img src="{{ asset('img/facebook.svg') }}" class="icon-image" width="30px" alt="Facebook Parti2">
            </a>
        </div>

        
        <div class="form-element">
            <label>Correo Electrónico</label>
            <div>
                <input type="email" class="form-field{{ $errors->has('email') ? ' error' : '' }}" value="{{ old('email') }}" name="email" required autofocus>
                @if ($errors->has('email'))
                    <span class="">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="form-element">
            <label>Contraseña</label>
            <div>
                <input type="password" class="form-field{{ $errors->has('password') ? ' error' : '' }}" name="password" required>
                @if ($errors->has('password'))
                    <span class="">
                        {{ $errors->first('password') }}
                    </span>
                @endif
            </div>
        </div>

        <div>
            <button class="btn block center loaderLink">Ingresar</button>
        </div>
        
        <div class="form__links">
            <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a><br>
            <a href="{{ url('register') }}">¿No tienes una cuenta ? Créala aquí</a>
        </div>


    </form>
@endsection

