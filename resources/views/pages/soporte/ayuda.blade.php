@extends('layouts.auth')

@section('image__auth')
    <img src="{{asset('img/soporte.svg')}}" alt="Login Parti2">
@endsection

@section('form__auth')

	{{-- Forma Azul --}}
	<img src="{{ asset('img/forma__footer_alt.svg') }}" alt="Parti2 Login" class="forma__auth forma__auth--footeralt">
    
    {{-- Contenedor Preguntas Frecuentes --}}
    <div class="faq-container form">
        
        <div class="form__title">
            <h2>Preguntas Frecuentes</h2> 
           {{--  <p>Si no encuentras solución dentro de la siguiente documentación contáctate con asesor mediante el chat ubicado en la parte inferior de la pantalla </p> --}}
        </div>

        <p class="accordion">Qué es un match ?</p>
        <div class="panel">
            Es el momento en el que se efectúa una apuesta a un determinado partido entre dos personas.
        </div>

        <p class="accordion">Cuanto es la comisión por match ?</p>
        <div class="panel">
            La comisión que cobra parti2 es solamente del 5% sobre el valor total del match, debes tener en cuenta que toda transacción que se realice mediante la pasarela de pagos “epayco” tiene un valor adicional de impuestos establecido por la plataforma.
        </div>

        <p class="accordion">Cómo retiro mi crédito ?</p>
        <div class="panel">
            En el módulo de crédito dentro de la plataforma hay una opción de retiro, el cual te va a solicitar por que metodo lo deseas retirar ya sea por Nequi o Daviplata, el valor a retirar y la confirmación del número de celular.
        </div>

        <p class="accordion">Cuales son los métodos de retiro  ?</p>
        <div class="panel">
            Los métodos de retiro son Nequi o Daviplata.
        </div>

        <p class="accordion">Cuales son los horarios de retiro ?</p>
        <div class="panel">
            Los retiros se hacen efectivos todos los días de 8 de la mañana a 8 de la noche, dentro este periodo de tiempo tendrán una duración máxima de 10 minutos, si realizas la petición de retiro fuera de este horario quedarán en lista de espera para ser efectuado dentro del horario establecido.
        </div>

        <p class="accordion">Cuales son los métodos de pago ?</p>
        <div class="panel">
            Puedes realizar tus pagos con tarjeta de crédito, débito y efectivo. 
            Contamos con herramientas de pago cómo Baloto, Efecty, Gana, Punto Red  Red Servi, y PSE.
        </div>

        <p class="accordion">Como puedo agregar crédito ?</p>
        <div class="panel">
            El el módulo de crédito dentro de la plataforma hay una opción de agregar crédito, el cual te va a solicitar el monto que desear agregar, posteriormente te redirigirá a la pasarela de pagos en la cual puedes pagar con cualquier método de pago.
        </div>

    </div>

    {{--   Zoho Chat  --}}
    <script>
        var $zoho=$zoho || {};$zoho.salesiq = $zoho.salesiq || 
        {widgetcode:"6da7541283720f0505a0362b1fd982467722e7898c99e38ed8325608cdd18361", values:{},ready:function(){}};
        var d=document;s=d.createElement("script");s.type="text/javascript";s.id="zsiqscript";s.defer=true;
        s.src="https://salesiq.zoho.com/widget";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);d.write("<div id='zsiqwidget'></div>");
    </script>

@endsection

