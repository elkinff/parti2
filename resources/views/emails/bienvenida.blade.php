@extends('emails.template-email')

@section('imagen')
	<img src="{{ asset('img/users.svg') }}" width="216" height="270" alt="Partidos">
@endsection


@section('titulo', 'Bienvenido')


@section('descripcion')
	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua.
@endsection

@section('texto__boton', 'Publica ya!')

@section('ruta__boton', 'http://')





