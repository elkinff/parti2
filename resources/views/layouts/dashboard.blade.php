<!doctype html>
<html lang="{{ app()->getLocale() }}">
    
    @include('includes._head')

    <body>
		
		@include('includes._header')
		
		<main class="container__main" id="app">
			{{-- Si hay nav  --}}

			@if($nav__visible)
				<nav class="nav" id="nav">
					<div class="nav__content">
						@yield('nav__content')
					</div>
				</nav>
			@endif
			
			<div class="content">
				@yield('content')
			</div>
			
		</main>

		<script src="{{ asset('js/app.js') }}"></script>

    </body>
</html>


