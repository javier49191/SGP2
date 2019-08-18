@extends('layouts.app')

@section('loader')
@include('partials.loader')
@endsection

@section('content')
<div class="container">

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<b>Usuarios</b>
					<a href="{{ route('usuarios.create') }}" class="btn btn-success float-right">
						Registrar usuario
					</a>
				</div>

				<div class="card-body table-responsive">
					<table id="users" class="table table-bordered table-hover" style="width:100%">
						<thead>
							<th>Avatar</th>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Email</th>

							<th class="text-center">Rol</th>
						</thead>
						<tbody>
							@forelse($users as $user)
							<tr>
								<td width="5%">
									<img src="{{ asset('images/avatar/') }}/{{$user->avatar}}" title="avatar de {{$user->name}}" alt="" class="thumbnail">
								</td>
								<td style="vertical-align: middle;">
									<a href="{{ route('usuarios.show', $user->id) }}">{{$user->name}}</a>
									<span class="muted">{{(Auth::user()->id == $user->id) ? ' - (Actual)':''}}</span>
								</td>
								<td style="vertical-align: middle;">{{$user->last_name}}</td>
								<td style="vertical-align: middle;">{{$user->email}}</td>

								<td class="text-center" style="vertical-align: middle;">
									<span class="badge badge-pill badge-success">
										{{$user->role->nombre}}
									</span>
								</td>
							</tr>
							@empty
							<tr>
								<td class="alert alert-danger">No hay registros</td>
								<td class="alert alert-danger">No hay registros</td>
								<td class="alert alert-danger">No hay registros</td>
								<td class="alert alert-danger">No hay registros</td>
							</tr>
							@endforelse
						</tbody>
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
		$('#users').DataTable({
			"lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "Todo"] ],

			"language": {
				"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
			},
		});
	} );
</script>
@endsection