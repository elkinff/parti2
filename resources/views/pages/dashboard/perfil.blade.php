@extends('layouts.dashboard', ['nav__visible' => false])


@section('content')
	
	
	{{-- {{ $usuario }} --}}
	<div class="profile ">
		
		<form class="form" method="POST" action="{{ route('perfil.update') }}" enctype="multipart/form-data">
	        
	        {{ csrf_field() }}
			
			<div class="columns center">

				<div class="profile__image sm-12 md-5 center-xs">
					<div>
						@if($usuario->foto)
							<img src="/img/usuario/{{$usuario->foto}}" class="profile__image--preview">
						@else 
							<img src="{{ asset('img/email/users.png') }}"  class="profile__image--preview">
						@endif
					</div>

					<div class="form-element">
	                    <div class="form-file-field">
	                        <span class="file-btn">Selecciona tu archivo</span>
	                        <span class="file-msg">o arrastralo aquí</span>
	                        <input type="file" name="fotoUsuario" id="inputImageProfile" accept="image/*" >
	                    </div>
	                </div>

				</div>

		        <div class="profile__info sm-12 md-6 lg-offset-1">
		        	<div class="form-element">
			            <label>Correo Electrónico</label>
			            <div>
			                <input disabled type="email" class="form-field{{ $errors->has('email') ? ' error' : '' }}" value="{{ old('email', $usuario->email) }}" name="email" required>
			                @if ($errors->has('email'))
			                    <span class="">
			                        {{ $errors->first('email') }}
			                    </span>
			                @endif
			            </div>
			        </div>

			        <div class="form-element">
			            <label>Nombres</label>
			            <div>
			                <input type="text" class="form-field{{ $errors->has('nombre') ? ' error' : '' }}" name="nombre" value="{{ old('nombre', $usuario->nombre) }}">
			                @if ($errors->has('nombre'))
			                    <span class="">
			                        {{ $errors->first('nombre') }}
			                    </span>
			                @endif
			            </div>
			        </div>

			        <div class="form-element">
			            <label>Celular</label>
			            <div>
			                <input type="number" class="form-field{{ $errors->has('celular') ? ' error' : '' }}" name="celular" value="{{ old('celular', $usuario->celular) }}">
			                @if ($errors->has('celular'))
			                    <span class="">
			                        {{ $errors->first('celular') }}
			                    </span>
			                @endif
			            </div>
			        </div>
					
					@if(Auth::user()->id_google || Auth::user()->id_facebook )
				        <div class="form-element">
				            <div class="columns">
				                <div class="sm-6">
				                    <label>Nueva Contraseña</label>
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
					@endif
					
		        </div>

	        </div>

	        <div>
	            <button class="btn center">Actualizar Perfil</button>
	        </div>

	    </form>
	</div>

@endsection

