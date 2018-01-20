@extends('emails.template-email')

@section('imagen')
	@if($imagen == 'recuperacion')
		<img src="{{ asset('img/recuperar.svg') }}" width="216" height="270" alt="Partidos">
	@else 
		<img src="{{ asset('img/users.svg') }}" width="216" height="270" alt="Partidos">
	@endif
	
@endsection


@section('titulo',$titulo)


@section('descripcion')
	{{ $descripcion }}
@endsection

@section('texto__boton', $labelButton)

@section('ruta__boton', $url)


