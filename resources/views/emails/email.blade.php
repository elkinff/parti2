@extends('emails.template-email')

@section('imagen')
	@if($imagen == 'recuperacion')
		<img src="{{ $message->embed('img/email/recuperar.png') }}" width="170"  alt="Partidos">
	@elseif($imagen == 'validacion') 
		<img src="{{ $message->embed('img/email/users.png') }}" width="170" alt="Partidos">
	@else
		<img src="{{ $message->embed('img/email/users.png') }}" width="170" alt="Partidos">
	@endif
	
@endsection

@section('titulo',$titulo)


@section('descripcion')
	{{ $descripcion }}
@endsection

@section('texto__boton', $labelButton)

@section('ruta__boton', $url)


