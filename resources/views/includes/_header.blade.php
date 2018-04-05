<header class="header">
	
	<a class="header__logo" href="{{ secure_url('/') }}">
		<img src="{{ secure_asset('img/logo.svg') }}">
	</a>

	<div class="header__menu">
		
		<a class="header__menu__item" href="{{ secure_url('usuario/publicaciones') }}">
			<img src="{{ secure_asset('img/ball.svg') }}">
			<span>Mis Publicaciones</span>
		</a>

		<a class="header__menu__item" href="{{ secure_url('credito') }}">
			<img src="{{ secure_asset('img/credito.svg') }}">
			<span>Mi Crédito</span>
		</a>
		
		{{-- Boton para V escritorio --}}
		<a class="header__menu__item header__menu__item--accent btn" href="{{ secure_url('publicar') }}">
			<span>Crear Apuesta</span>
		</a>
		
		{{-- Boton para V Movil --}}
		<a class="header__menu__item header__menu__item--mobile" href="{{ secure_url('publicar') }}">
			<img src="{{ secure_asset('img/plus.svg') }}">
		</a>
		
		{{-- Imagen usuario --}}
		
		@if(Auth::user())

			<div class="dropdown">
				
				<a id="dropdownUser" class="dropbtn header__menu__item header__menu__item--user">
					@if(Auth::user()->foto)
						<img src="{{Auth::user()->foto}}" >
					@else
						<img src="{{ secure_asset('img/email/users.png') }}" >
					@endif
				</a>
					<div id="myDropdown" class="dropdown-content">
						<div class="dropdown-option">
							<div class="title">Mi cuenta</div>
							<a href="{{ secure_url('perfil') }}">{{ Auth::user()->nombre }}</a>
						</div>

						<div class="dropdown-option">
							<a href="{{ secure_url('logout') }}">Cerrar Sesión</a>
						</div>
						
					</div>
			</div>
		@else 

			<a class="header__menu__item header__menu__item--accent btn secondary" href="{{ secure_url('login') }}">
				<span>Iniciar Sesión</span>
			</a>

			{{-- Boton para V Movil --}}
			<a class="header__menu__item header__menu__item--mobile" href="{{ secure_url('login') }}">
				<img src="{{ secure_asset('img/users.svg') }}">
			</a>
		@endif

	</div>
</header>