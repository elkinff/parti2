@extends('layouts.dashboard', ['nav__visible' => false])


@section('content')

	{{-- 
		Id para enviarlo en las opraciones de credito--}}
	
	@if(Auth::user())
		<input type="hidden" id="idUsuario" value="{{ Auth::user()->id }}">
		<input type="hidden" value="{{ Auth::user()->saldo }}" id="saldoUser">
	@endif
	
	<div class="credito__header">
		<div class="credito__user">
			
			<img src="{{ secure_asset('img/credito.svg') }}">
			
			<div>
				<label>Saldo Actual</label>
				<h3>${{ number_format(Auth::user()->saldo) }}</h3>
			</div>
		</div>

		<div class="credito__options">
			<button class="btn sm" data-toggle="modal" data-target="#modalAgregarCredito">Agregar Crédito</button>
			
			<button class="btn sm secondary" data-toggle="modal" data-target="#modalRetirarCredito">Retirar</button>

		</div>
	</div>
	

	@if(Session::has('message'))
		{{Session('message')}}
	@endif


	<table class="table stripe hover responsive">
		<thead>
			<tr>
				<th>Fecha</th>
				<th>Tipo</th>
				<th>Estado</th>
				<th>Monto</th>
			</tr>
		</thead>
		<tbody>

			@foreach($historial as $transaccion)
				<tr>
					<td data-th="Fecha">{{ $transaccion->fecha }}</td>
					<td data-th="Retiro">{{ $transaccion->tipo }}</td>
					<td data-th="Estado">{{ $transaccion->estado == 0 ? "En espera" : "Realizado" }}</td>
					<td data-th="Monto">${{ number_format($transaccion->valor) }}</td>
				</tr>
			@endforeach

		</tbody>
	</table>
	
	<div class="pagination">
		{{ $historial->links() }}
	</div>
	
	@include('pages.modals.retirar-credito')
	
	@include('pages.modals.agregar-credito')


@endsection


