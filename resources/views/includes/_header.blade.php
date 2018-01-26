<header class="header">
	
	<div class="header__logo">
		<img src="{{ asset('img/logo.svg') }}">
	</div>

	<div class="header__menu">
		
		<a class="header__menu__item">
			<img src="{{ asset('img/ball.svg') }}">
			<span>Mis Publicaciones</span>
		</a>

		<a class="header__menu__item">
			<img src="{{ asset('img/credito.svg') }}">
			<span>Mi Crédito</span>
		</a>
		
		{{-- Boton para V escritorio --}}
		<a class="header__menu__item header__menu__item--accent btn">
			<span>Crear Apuesta</span>
		</a>
		
		{{-- Boton para V Movil --}}
		<a class="header__menu__item header__menu__item--mobile">
			<img src="{{ asset('img/plus.svg') }}">
		</a>
		
		{{-- Imagen usuario --}}
		<a class="header__menu__item header__menu__item--user">
			{{-- <img src="http://lorempixel.com/50/50/people/"> --}}
		</a>

	</div>
</header>