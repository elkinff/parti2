@extends('layouts.dashboard', ['nav__visible' => false])

@section('content')

	<table class="table stripe hover responsive">
		<thead>
			<tr>
				<th>ID</th>
				<th>Fecha de solicitud</th>
				<th>Estado</th>
				<th>Monto</th>
				<th>Celular</th>
				<th></th>
			</tr>
		</thead>
		
		<tbody>
			@foreach ($retiros as $retiro)
				<tr>
					<td data-th="ID"> {{ $retiro->id }}</td>
					<td data-th="Fecha solicitud">{{ $retiro->fecha }}</td>
					<td data-th="Estado">{{ $retiro->estado_pago_admin }}</td>
					<td data-th="Monto">$ {{ number_format($retiro->valor) }}</td>
					<td data-th="Celular">{{ $retiro->usuario->celular }}</td>
					<td data-th="">
						<a href={{ url("admin/solicitudes/pagar/".$retiro->id) }} class="btn sm">Pagar</a>
						<a href="#" class="btn secondary sm">Seguimiento</a>
					</td>
				</tr>
			@endforeach
		</tbody>
		
	</table>

</div>

@endsection



