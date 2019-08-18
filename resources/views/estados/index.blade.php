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
					<b>Estados Financieros</b>
				</div>

				<div class="card-body table-responsive">
					<table id="estados" class="table table-bordered table-hover" style="width:100%">
						<thead>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Alias</th>
							<th>Cuotas pagas</th>
							<th>Cuotas pendientes</th>
							<th>Monto Total</th>
							<th class="text-center">Estado</th>
						</thead>
						
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="row justify-content-md-center mt-3">
		{{-- ################ Estados Financieros ################ --}}
		<div class="col-lg-8">
			<div class="card" style="width: 100%;">
				<div class="card-header">
					<b>Estados financieros</b>
				</div>
				<div class="card-body">
					<canvas id="estadosPie"></canvas>
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
		$('#estados').DataTable({
			"lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "Todo"] ],
			"language": {
				"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
			},
			processing: true,
			serverSide: true,
			ajax: '{{ url('estadosDatatable') }}',
			columns: [
			{data: 'nombre', name: 'nombre'},
			{data: 'apellido', name: 'apellido'},
			{data: 'alias', name: 'alias'},
			{data: 'cuotas_pagas', name: 'cuotas_pagas'},
			{data: 'cuotas_pendientes', name: 'cuotas_pendientes'},
			{data: 'monto_total', name: 'monto_total'},
			{data: 'estado', name: 'estado'},
			]
		});
	} );
</script>

{{-- ##### Cantidades ##### --}}
<script>
	let myChart1 = document.getElementById('estadosPie').getContext('2d');

	let myPieChart1 = new Chart(myChart1, {
		type: 'pie',
		data: {
			labels: [
			'Regular',
			'Atrasado',
			'Moroso',
			],
			datasets: [{
				label: 'Activas y no activas',
				data: [
				{{cantidadEstadoRegular($estados, 'cantidad_cuotas', $padrinos )}},
				{{cantidadEstadoAtrasado($estados, 'cantidad_cuotas', $padrinos )}},
				{{cantidadEstadoMoroso($estados, 'cantidad_cuotas', $padrinos )}}
				],

				backgroundColor: [
				'rgba(92, 184, 92, 1)',
				'rgba(240, 173, 78, 1)',
				'rgba(217, 83, 79, 1)',
				],
				borderWidth: 2
			}]
		},

	});
</script>
@endsection