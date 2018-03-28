@extends('layouts.dashboard', ['nav__visible' => false])

@section('content')

	<table class="table stripe hover responsive">
		<thead>
			<tr>
				<th>ID</th>
				<th>Fecha de solicitud</th>
				<th>Estado</th>
				<th>Fecha de pago</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td data-th="ID">12123</td>
				<td data-th="Fecha solicitud">01/01/2018</td>
				<td data-th="Estado">En espera de pago</td>
				<td data-th="Fecha de pago">$100.000</td>
				<td data-th="">
					<a href="#" class="btn sm">Pagar</a>
					<a href="#" class="btn secondary sm">Seguimiento</a>
				</td>
			</tr>

		</tbody>
	</table>

</div>

@endsection

