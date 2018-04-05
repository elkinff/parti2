@extends('layouts.auth')

@section('image__auth')
    <img src="{{secure_asset('img/users.svg')}}" alt="Login Parti2">
@endsection

@section('form__auth')
    
    <img src="{{ secure_asset('img/forma__footer_alt.svg') }}" alt="Parti2 Login" class="forma__auth forma__auth--footeralt">

    <form class="form" method="POST" action="{{ route('password.request') }}">
        {{ csrf_field() }}

        <div class="form__title">
            <h2>Cambiar Contraseña</h2>    
        </div>

        <input type="hidden" name="token" value="{{ $token }}">

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
            <div class="columns">
                <div class="sm-6">
                    <label>Contraseña</label>
                    <div>
                        <input type="password" class="form-field{{ $errors->has('password') ? ' error' : '' }}" name="password">
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
                        <input id="password-confirm" type="password" class="form-field" name="password_confirmation">
                    </div>
                </div>
            </div>
        </div>

        <div>
            <button class="btn block center">Cambiar Contraseña</button>
        </div>

    </form>
@endsection