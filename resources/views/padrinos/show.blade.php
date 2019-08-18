@extends('layouts.app')

@section('content')
<div class="container">

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<b>Detalles de padrino: {{$padrino->nombre}}</b>
				</div>

				<div class="card-body">
					<div class="row">
						<div class="col-md-6 form-group">
							<p class="form-control"><b>Nombre: </b>{{$padrino->nombre}}</p>
							<p class="form-control"><b>Alias: </b>{{$padrino->alias}}</p>

						</div>
						<div class="col-md-6 form-group">
							<p class="form-control"><b>Apellido: </b>{{$padrino->apellido}}</p>
							<p class="form-control"><b>Contacto: </b>{{$padrino->contacto}}</p>

						</div>
					</div>
					<div class="row">
						<div class="col-md-6 form-group">
							<p class="form-control"><b>Email: </b>{{$padrino->email}}</p>
							<p class="form-control"><b>Teléfono: </b>{{$padrino->telefono}}</p>
						</div>
						<div class="col-md-6 form-group">
							<p class="form-control"><b>Segundo email: </b>{{$padrino->segundo_email}}</p>
							<p class="form-control"><b>Segundo teléfono: </b>{{$padrino->segundo_telefono}}</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 form-group">
							<p class="form-control"><b>Contacto: </b>{{$padrino->contacto}}</p>
						</div>
					</div>
					<hr>
					<a href="{{ route('padrinos.edit', $padrino->id) }}" class="btn btn-primary">Editar</a>
				</div>

					{{-- vinculaciones --}}
					<div class="card-header text-center">
						<b class="">Alumnos vinculados</b>
					</div>
					<div class="table-responsive col-md-12">
						<table class="table table-hover">
							<thead>
								<tr>
									<th scope="col" class="text-center">Nombre</th>
									<th scope="col" class="text-center">Apellido</th>
									<th scope="col" class="text-center">Grado</th>
									<th scope="col" class="text-center">Fecha de vinculación</th>
									<th scope="col" class="text-center">Acciones</th>
								</tr>
							</thead>
							<tbody>
								@forelse($vinculaciones as $vinculacion)
								<tr>
									<td class="text-center">
										<a href="{{ route('alumnos.show', $vinculacion->alumno->id) }}">
											{{$vinculacion->alumno->nombre}}
										</a>
									</td>
									<td class="text-center">{{$vinculacion->alumno->apellido}}</td>
									<td class="text-center">{{$vinculacion->alumno->grado}}</td>
									<td class="text-center">{{$vinculacion->created_at->format('d-m-Y')}}</td>
									<td class="text-center">
									<form action="{{ route('vinculaciones.destroy', $vinculacion->id) }}" method="POST">
										@csrf
										@method('DELETE')
										<button class="btn-delete btn btn-sm btn-danger" type="button">
											<i class="icon-cancel_circle icon1x"></i>
										</button>
									</form>
								</td>
								</tr>
								@empty

								@endforelse
							</tbody>
						</table>
					</div>
					{{-- vinculaciones --}}
			</div>
		</div>
	</div>

</div>
@endsection

@section('scripts')
{{-- Toastr --}}
@include('partials.alert')

{{-- Sweet Alert --}}
@include('partials.SweetAlert')

@endsection