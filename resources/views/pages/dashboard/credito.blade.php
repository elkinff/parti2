@extends('layouts.dashboard')


@section('content')

	<div class="credito__header">
		<div class="credito__user">
			
			<img src="{{ asset('img/credito.svg') }}">
			<div>
				<label>Saldo Actual</label>
				<h3>$100.000</h3>
			</div>
		</div>

		<div class="credito__options">
			<button class="btn sm" data-toggle="modal" data-target="#modalApostar">Agregar Crédito</button>
			
			<button class="btn sm secondary" data-toggle="modal" data-target="#modalRetirarCredito">Retirar</button>

			<button class="btn sm" data-toggle="modal" data-target="#modalAgregarCredito">Agregar</button>
			
			<button class="btn sm" data-toggle="modal" data-target="#modalCompartir">Compartir</button>

		</div>
	</div>


	<table class="table stripe hover responsive">
		<thead>
			<tr>
				<th>Fecha</th>
				<th>Tipo</th>
				<th>Monto</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td data-th="Fecha">01/01/2018</td>
				<td data-th="Retiro">Retiro</td>
				<td data-th="Monto">$100.000</td>
			</tr>

			<tr>
				<td data-th="Fecha">01/01/2018</td>
				<td data-th="Retiro">Retiro</td>
				<td data-th="Monto">$100.000</td>
			</tr>
		</tbody>
	</table>

	@include('pages.modals.retirar-credito')
	
	@include('pages.modals.apostar')
	
	@include('pages.modals.agregar-credito')
	
	@include('pages.modals.compartir')
	


@endsection

