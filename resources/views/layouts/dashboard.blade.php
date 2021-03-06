<!doctype html>
<html lang="{{ app()->getLocale() }}">
    
    @include('includes._head')

    <body>
		
		@include('includes._header')
		
		<main class="container__main" id="app" style="touch-action: pan-x pan-y !important;">
			{{-- Si hay nav  --}}

			<input type="hidden" value="{{ url('/') }}" v-model="baseUrl" />

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


		
		<script type="text/javascript" src="https://checkout.epayco.co/checkout.js">   </script>

		<script src="{{ secure_asset('js/app.js') }}"></script>

		@include('sweet::alert')
		
		{{-- <script type="text/javascript">
		var $zoho=$zoho || {};$zoho.salesiq = $zoho.salesiq || {widgetcode:"965eebfbbee4d5f22f1bfe7598e78891ee66a3cbae50d11170e3779277c570cc", values:{},ready:function(){}};var d=document;s=d.createElement("script");s.type="text/javascript";s.id="zsiqscript";s.defer=true;s.src="https://salesiq.zoho.com/widget";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);d.write("<div id='zsiqwidget'></div>");
		</script> --}}
    </body>
</html>








