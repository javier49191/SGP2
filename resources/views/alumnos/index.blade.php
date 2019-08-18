@extends('layouts.app')

@section('loader')
{{-- @include('partials.loader') --}}
@endsection

@section('content')
<div class="container">

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<b>Alumnos</b>
					<a href="{{ route('alumnos.create') }}" class="btn btn-success float-right">
						Registrar alumno
					</a>
				</div>

				<div class="card-body table-responsive">
					<table id="alumnos" class="table table-bordered table-hover" style="width:100%">
						<thead>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Alias</th>
							<th>DNI</th>
							<th class="text-center">Vinculado</th>
						</thead>
					</table>
				</div>
			</div>
		</div>
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
		$('#alumnos').DataTable({
			"lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "Todo"] ],
			"language": {
				"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
			},
			processing: true,
			serverSide: true,
			ajax: '{{ url('alumnosDatatable') }}',
			columns: [
			{data: 'nombre', name: 'nombre'},
			{data: 'apellido', name: 'apellido'},
			{data: 'alias', name: 'alias'},
			{data: 'dni', name: 'dni'},
			{data: 'vinculado', name: 'vinculado'},
			]
		});
	} );
</script>
@endsection