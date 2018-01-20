@extends('layouts.auth')

@section('image__auth')
    <img src="{{asset('img/recuperar.svg')}}" alt="Login Parti2">
@endsection

@section('form__auth')
    {{-- Forma Azul --}}
    <img src="{{ asset('img/forma__footer.svg') }}" alt="Parti2 Login" class="forma__auth forma__auth--footer">
    

    <form class="form" method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}
        
        <div class="form__title">
            <h2>Recuperar Contraseña</h2>   
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

        <div>
            <button class="btn block center loaderLink">Recuperar</button>
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="form__links">
            <a href="{{ url('login') }}">Iniciar Sesión</a>
        </div>

    </form>

@endsection

