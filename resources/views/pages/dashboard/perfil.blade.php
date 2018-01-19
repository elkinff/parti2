@extends('layouts.dashboard')


@section('content')

	<div class="profile ">
		
		<form class="form " method="POST" action="{{ route('register') }}">
	        
	        {{ csrf_field() }}
			
			<div class="columns center">
				
			
			<div class="profile__image sm-12 md-5 center-xs">
				<a>
					<img src="http://lorempixel.com/150/150/people/" class="image-round">
				</a>
				<div class="form-element">
                    <div class="form-file-field">
                        <span class="file-btn">Selecciona tu archivo</span>
                        <span class="file-msg">o arrastralo aquí</span>
                        <input type="file" name="logoFile" >
                    </div>
                </div>
			</div>

	        <div class="profile__info sm-12 md-6 lg-offset-1">
		        <div class="form-element">
		            <label>Nombres</label>
		            <div>
		                <input type="text" class="form-field{{ $errors->has('nombre') ? ' error' : '' }}" name="nombre" value="{{ old('nombre') }}">
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
	        </div>

	        </div>

	        <div>
	            <button class="btn center">Actualizar Perfil</button>
	        </div>

	    </form>
	</div>

@endsection

