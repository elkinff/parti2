<!doctype html>
<html lang="{{ app()->getLocale() }}">
    
    @include('includes._head')

    <body>
		
		{{-- Formas svg --}}
		<img src="{{ asset('img/forma__header.svg') }}" alt="Parti2 Login" class="forma__auth forma__auth--header">

		<img src="{{ asset('img/logo__blanco.svg') }}" alt="Parti2" class="forma__auth--logo">

		<div class="container__auth">
			
			<div class="image__auth">
				@yield('image__auth')
			</div>

			<div class="form__auth">
				@yield('form__auth')	
			</div>

		</div>	
		
		<script src="{{ asset('js/app.js') }}"></script>
		
		@include('sweet::alert')
    </body>
</html>


