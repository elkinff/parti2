<!doctype html>
<html lang="{{ app()->getLocale() }}">
    
    @include('includes._head')

    <body>
		
		@include('includes._header')
		
		
		
		
		<main class="container__main">
			{{-- Si hay nav  --}}

			@yield('nav_bar')
			
			<div class="content">
				@yield('content')
			</div>
			
		</main>

		<script src="{{ asset('js/app.js') }}"></script>

    </body>
</html>


