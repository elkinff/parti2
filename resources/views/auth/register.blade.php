@extends('layouts.auth')

@section('image__auth')
    <img src="{{asset('img/users.svg')}}" alt="Login Parti2">
@endsection

@section('form__auth')
    
    <img src="{{ asset('img/forma__footer_alt.svg') }}" alt="Parti2 Login" class="forma__auth forma__auth--footeralt">

    <form class="form" method="POST" action="{{ route('register') }}">
        
        {{ csrf_field() }}

        <div class="form__title">
            <h2>Registrarse</h2>    
        </div>

        <div class="form-element">
            <label>Nombres</label>
            <div>
                <input type="text" class="form-field{{ $errors->has('nombre') ? ' error' : '' }}" name="nombre" value="{{ old('nombre') }}" required autofocus>
                @if ($errors->has('nombre'))
                    <span class="">
                        {{ $errors->first('nombre') }}
                    </span>
                @endif
            </div>
        </div>

       <div class="form-element">
            <label>Correo Electrónico</label>
            <div>
                <input type="email" class="form-field{{ $errors->has('email') ? ' error' : '' }}" value="{{ old('email') }}" name="email" required>
                @if ($errors->has('email'))
                    <span class="">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="form-element">
            <label>Celular</label>
            <div>
                <input type="number" class="form-field{{ $errors->has('celular') ? ' error' : '' }}" name="celular" value="{{ old('celular') }}">
                @if ($errors->has('celular'))
                    <span class="">
                        {{ $errors->first('celular') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="form-element">
            <div class="columns">
                <div class="sm-6">
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

                <div class="sm-6">
                    <label>Confirmar Contraseña</label>
                    <div>
                        <input id="password-confirm" type="password" class="form-field" name="password_confirmation" required>
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