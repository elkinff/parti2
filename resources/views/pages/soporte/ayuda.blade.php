@extends('layouts.auth')

@section('image__auth')
    <img src="{{asset('img/soporte.svg')}}" alt="Login Parti2">
@endsection

@section('form__auth')
	
     <!-- Include this after the sweet alert js file -->
    @include('sweet::alert')

	{{-- Forma Azul --}}
	<img src="{{ asset('img/forma__footer_alt.svg') }}" alt="Parti2 Login" class="forma__auth forma__auth--footeralt">

   <div class="faq-container form">
        
        <div class="form__title">
            <h2>Preguntas Frecuentes</h2> 
        </div>

        <p class="accordion">Q1. Cuanto es la comisión por Match ?</p>
        <div class="panel">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas fugiat velit voluptatem nemo porro, eligendi provident adipisci illo soluta similique ipsum obcaecati dolorem quia, ad dolores dignissimos delectus quasi placeat.</div>

        <p class="accordion">Q1. Cuanto es la comisión por Match ?</p>
        <div class="panel">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas fugiat velit voluptatem nemo porro, eligendi provident adipisci illo soluta similique ipsum obcaecati dolorem quia, ad dolores dignissimos delectus quasi placeat.</div>

        <p class="accordion">Q1. Cuanto es la comisión por Match ?</p>
        <div class="panel">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas fugiat velit voluptatem nemo porro, eligendi provident adipisci illo soluta similique ipsum obcaecati dolorem quia, ad dolores dignissimos delectus quasi placeat.</div>

        <p class="accordion">Q1. Cuanto es la comisión por Match ?</p>
        <div class="panel">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas fugiat velit voluptatem nemo porro, eligendi provident adipisci illo soluta similique ipsum obcaecati dolorem quia, ad dolores dignissimos delectus quasi placeat.</div>

        <p class="accordion">Q1. Cuanto es la comisión por Match ?</p>
        <div class="panel">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas fugiat velit voluptatem nemo porro, eligendi provident adipisci illo soluta similique ipsum obcaecati dolorem quia, ad dolores dignissimos delectus quasi placeat.</div>

        <p class="accordion">Q1. Cuanto es la comisión por Match ?</p>
        <div class="panel">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas fugiat velit voluptatem nemo porro, eligendi provident adipisci illo soluta similique ipsum obcaecati dolorem quia, ad dolores dignissimos delectus quasi placeat.</div>

    </div>


    <script>
        //  Zoho Chat 
        var $zoho=$zoho || {};$zoho.salesiq = $zoho.salesiq || 
        {widgetcode:"6da7541283720f0505a0362b1fd982467722e7898c99e38ed8325608cdd18361", values:{},ready:function(){}};
        var d=document;s=d.createElement("script");s.type="text/javascript";s.id="zsiqscript";s.defer=true;
        s.src="https://salesiq.zoho.com/widget";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);d.write("<div id='zsiqwidget'></div>");
        
    </script>
@endsection

