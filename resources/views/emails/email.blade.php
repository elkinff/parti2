@extends('emails.template-email')

@section('imagen')
	@if($imagen == 'recuperacion')
		<img src="{{ $message->embed(public_path().'/img/email/recuperar.png') }}" width="170"  alt="Partidos">
	@elseif($imagen == 'validacion') 
		<img src="{{ $message->embed(public_path().'/img/email/validacion.png') }}" width="170" alt="Partidos">
	@elseif($imagen == 'no_match') 
		<img src="{{ $message->embed(public_path().'/img/email/no_match.png') }}" width="170" alt="Partidos">	
	@elseif($imagen == 'ganador')
		<img src="{{ $message->embed(public_path().'/img/email/ganador.png') }}" width="170" alt="Partidos">		
	@elseif($imagen == 'empate')
		<img src="{{ $message->embed(public_path().'/img/email/empate.png') }}" width="170" alt="Partidos">
	@elseif($imagen == 'match')
		<img src="{{ $message->embed(public_path().'/img/email/match.png') }}" width="170" alt="Partidos">
	@elseif($imagen == 'perdedor')
		<img src="{{ $message->embed(public_path().'/img/email/perdedor.png') }}" width="170" alt="Partidos">	
	@else
		<img src="{{ $message->embed(public_path().'/img/email/users.png') }}" width="170" alt="Partidos">
	@endif
@endsection

@section('titulo',$titulo)

@section('descripcion')
	{{ $descripcion }}
@endsection

@section('texto__boton', $labelButton)

@section('ruta__boton', $url)