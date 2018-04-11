@extends('layouts.dashboard', ['nav__visible' => false])

@section('content')

	<table class="table stripe hover responsive">
		<thead>
			<tr>
				<th>ID</th>
				<th>Fecha de solicitud</th>
				<th>Estado</th>
				<th>Monto</th>
				<th>Método</th>
				<th>Celular</th>
				<th></th>
			</tr>
		</thead>
		
		<tbody>
			@foreach ($retiros as $retiro)
				<tr>
					<td data-th="ID"> {{ $retiro->id }}</td>
					<td data-th="Fecha solicitud">{{ $retiro->fecha }}</td>
					<td data-th="Estado">
						@if($retiro->estado_pago_admin == 1)
							Pagado
						@elseif($retiro->estado_pago_admin == 2) 
							Seguimiento
						@else 
							----			
						@endif
						
					</td>
					<td data-th="Monto">$ {{ number_format($retiro->valor) }}</td>
					<td data-th="Método"> {{ $retiro->metodo }}</td>
					<td data-th="Celular">{{ $retiro->usuario->celular }}</td>
					<td data-th="">
						<a href={{ secure_url("admin/solicitudes/estado/1/".$retiro->id) }} class="btn sm">Pagar</a>
						<a href={{ secure_url("admin/solicitudes/estado/2/".$retiro->id) }} class="btn secondary sm">Seguimiento</a>
					</td>
				</tr>
			@endforeach
		</tbody>
		
	</table>

</div>

@endsection



