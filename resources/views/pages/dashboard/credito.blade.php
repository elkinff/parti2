@extends('layouts.dashboard', ['nav__visible' => false])


@section('content')

	<div class="credito__header">
		<div class="credito__user">
			
			<img src="{{ asset('img/credito.svg') }}">
			
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
	
	@include('pages.modals.agregar-credito')


@endsection

@section('scripts')

<!-- <script type="text/javascript" src="https://checkout.epayco.co/checkout.js"></script> -->
<script>
	console.log("var ap");

	// function sendDataEpay(){
	// 	var handler = ePayco.checkout.configure({ key: ' 86c18a3ad068b30d14c99a47940ad176bb0c7721', test: true });
	
	// 	var data={
	// 		//Parametros compra (obligatorio)
	// 		name: "Vestido Mujer Primavera",
	// 		description: "Vestido Mujer Primavera",
	// 		invoice: "1234",
	// 		currency: "cop",
	// 		amount: "12000",
	// 		tax_base: "0",
	// 		tax: "0",
	// 		country: "co",
	// 		lang: "en",

	// 		//Onpage="false" - Standard="true"
	// 		external: "true",


	// 		//Atributos opcionales
	// 		extra1: "extra1",
	// 		extra2: "extra2",
	// 		extra3: "extra3",
	// 		confirmation: "http://secure2.payco.co/prueba_curl.php",
	// 		response: "http://secure2.payco.co/prueba_curl.php",

	// 		//Atributos cliente
	// 		name_billing: "Andres Perez",
	// 		address_billing: "Carrera 19 numero 14 91",
	// 		type_doc_billing: "cc",
	// 		mobilephone_billing: "3050000000",
	// 		number_doc_billing: "100000000"
	// 	}

	// 	handler.open(data)
	// }
	


</script>
@endsection


