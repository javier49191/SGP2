@extends('layouts.app')

@section('loader')
@include('partials.loader')
@include('partials.ChartJS')
@endsection

@section('content')
<div class="container">

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<b>Aportes</b>
					<a href="{{ route('aportes.create') }}" class="btn btn-success float-right">
						Registrar aporte
					</a>
				</div>

				<div class="card-body table-responsive">
					<table id="pagos" class="table table-bordered table-hover" style="width:100%">
						<thead>
							<th>Padrino</th>
							<th>Monto</th>
							<th>Fecha de pago</th>
							<th>Pago ingresado</th>
							<th>Usuario</th>
							<th>Tipo Pago</th>
						</thead>
						{{-- <tbody>
							@forelse($pagos as $pago)
							<tr>
								<td>{{$pago->padrino->nombre}}</td>
								<td>{{$pago->monto_pago}}</td>
								<td>{{$pago->fecha_pago}}</td>
								<td>{{$pago->created_at}}</td>
								<td>{{$pago->user->name}}</td>
								<td>{{$pago->detallePago->tipoPago->descripcion}}</td>
							</tr>
							@empty
							@endforelse
						</tbody> --}}
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-primary text-white">
					<b>Aportes agrupados por año</b>
				</div>
				<div class="card-body">
					<canvas id="aportes"></canvas>
				</div>
			</div>
		</div>
	</div>

	<div class="row justify-content-md-center mt-3">
		{{-- ################ Estados Financieros ################ --}}
		<div class="col-lg-8">
			<div class="card" style="width: 100%;">
				<div class="card-header bg-primary text-white">
					<b>Tipo Pago</b>
				</div>
				<div class="card-body">
					<canvas id="tipoPagoPie"></canvas>
				</div>
			</div>
		</div>
		{{-- ################ Fin Estados Financieros ################ --}}
	</div>
	
</div>
@endsection

@section('scripts')
{{-- Toastr --}}
@include('partials.alert')

{{-- DataTable --}}
@include('partials.DataTable')
<script>
	$(document).ready( function () {
		$('#pagos').DataTable({
			"lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "Todo"] ],
			"language": {
				"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
			},
			processing: true,
			serverSide: true,
			deferRender: true,
			ajax:'{{ asset('aportesDatatable') }}',
			columns: [
			{data: 'nombre', name: 'nombre'},
			{data: 'monto_pago', name: 'monto_pago'},
			{data: 'fecha_pago', name: 'fecha_pago'},
			{data: 'created_at', name: 'created_at'},
			{data: 'name', name: 'name'},
			{data: 'descripcion', name: 'descripcion'},
			]
		});
	} );
</script>

{{-- ##### Aportes ##### --}}
<script>
	let myChart = document.getElementById('aportes').getContext('2d');
	function getRandomColor() {
		var letters = '0123456789ABCDEF'.split('');
		var color = '#';
		for (var i = 0; i < 6; i++ ) {
			color += letters[Math.floor(Math.random() * 16)];
		}
		return color;
	}

	let myBarChart = new Chart(myChart, {
		type: 'bar',
		data: {
			labels: [
			@forelse($agrupados as $ag)
			"{{$ag->year}}",
			@empty
			@endforelse
			],
			datasets: [{
				label: 'Aportes por año $',
				data: [
				@forelse($agrupados as $ag)
				"{{$ag->monto}}",
				@empty
				@endforelse
				],
				backgroundColor: 'rgba(62,149,205,0.5)',
				borderColor: 'rgba(62,149,205,1)',
				borderWidth: 2,
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			},
		},

	});

</script>
{{-- ##### TipoPago ##### --}}
<script>
	let myChart1 = document.getElementById('tipoPagoPie').getContext('2d');

	let myPieChart1 = new Chart(myChart1, {
		type: 'pie',
		data: {
			labels: [
			'Efectivo',
			'Tarjeta Naranja',
			'Visa',
			'Cheque',
			],
			datasets: [{
				label: 'Activas y no activas',
				data: [
				{{tipoPago($pagos, 'Efectivo')}},
				{{tipoPago($pagos, 'Tarjeta Naranja')}},
				{{tipoPago($pagos, 'Visa')}},
				{{tipoPago($pagos, 'Cheque')}},
				],

				backgroundColor: [
				'rgba(92, 184, 92, 1)',
				'rgba(240, 173, 78, 1)',
				'rgba(2, 117, 216, 1)',
				'rgba(217, 83, 79, 1)',				
				],
				borderWidth: 2
			}]
		},

	});
</script>
@endsection