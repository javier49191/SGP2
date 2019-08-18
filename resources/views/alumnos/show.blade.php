@extends('layouts.app')

@section('content')
<div class="container">

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<b>Detalles de alumno: {{$alumno->nombre}}</b>
				</div>

				<div class="card-body">
					<div class="row">
						<div class="col-md-6 form-group">
							<p class="form-control"><b>Nombre: </b>{{$alumno->nombre}}</p>
							<p class="form-control"><b>Alias: </b>{{$alumno->alias}}</p>

						</div>
						<div class="col-md-6 form-group">
							<p class="form-control"><b>Apellido: </b>{{$alumno->apellido}}</p>
							<p class="form-control"><b>DNI: </b>{{$alumno->dni}}</p>

						</div>
					</div>
					<div class="row">
						<div class="col-md-6 form-group">
							<p class="form-control"><b>Fecha de nacimiento: </b>{{$alumno->fecha_nacimiento->format('d-m-Y')}}
								<span class="badge badge-light">
								({{Carbon\Carbon::parse($alumno->fecha_nacimiento)->age}} años)
								</span>
							</p>
						</div>
						<div class="col-md-6 form-group">
							<p class="form-control"><b>Grado: </b>{{$alumno->grado}}</p>
						</div>

					</div>
					<hr>
					<div class="row">
						<div class="col-md-12 form-group">
							<p class=""><h6>Observaciones:</h6><br>{!!$alumno->observaciones!!}
							</p>
						</div>
					</div>
					<hr>
					<a href="{{ route('alumnos.edit', $alumno->id) }}" class="btn btn-primary">Editar</a>
				</div>

				{{-- vinculaciones --}}
				<div class="card-header text-center">
					<b class="">Padrinos vinculados</b>
				</div>
				<div class="table-responsive col-md-12">
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col" class="text-center">Nombre</th>
								<th scope="col" class="text-center">Apellido</th>
								<th scope="col" class="text-center">Fecha de vinculación</th>
								<th scope="col" class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody>
							@forelse($vinculaciones as $vinculacion)
							<tr>
								<td class="text-center">
									<a href="{{ route('padrinos.show', $vinculacion->padrino->id) }}">
										{{$vinculacion->padrino->nombre}}
									</a>
								</td>
								<td class="text-center">{{$vinculacion->padrino->apellido}}</td>
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