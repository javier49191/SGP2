@extends('layouts.app')

@section('content')
<div class="container">


	<div class="card">
		<h5 class="card-header">Registrar Alumno</h5>
		<div class="card-body">
			<form action="{{ route('alumnos.store') }}" method="POST">
				@csrf
				<div class="row">
					<div class="col-md-6 form-group">
						<label for="nombre">Nombre</label>
						<input type="text" class="form-control {{$errors->has('nombre') ? 'is-invalid' : ''}}" name="nombre" value="{{ old('nombre') }}">

						@error('nombre')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="col-md-6 form-group">
						<label for="alias">Alias</label>
						<input type="text" class="form-control {{$errors->has('alias') ? 'is-invalid' : ''}}" name="alias" value="{{ old('alias') }}">
						@error('alias')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="row">
					<div class="col-md-6 form-group">
						<label for="apellido">Apellido</label>
						<input type="text" class="form-control {{$errors->has('apellido') ? 'is-invalid' : ''}}" name="apellido" value="{{ old('apellido') }}">
						@error('apellido')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="col-md-6 form-group">
						<label for="dni">DNI</label>
						<input type="text" class="form-control {{$errors->has('dni') ? 'is-invalid' : ''}}" name="dni" value="{{ old('dni') }}">
						@error('dni')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="row">
					<div class="col-md-6 form-group">
						<label for="grado">Grado</label>
						<input type="text" class="form-control {{$errors->has('grado') ? 'is-invalid' : ''}}" name="grado" value="{{ old('grado') }}">
						@error('grado')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="col-md-6 form-group">
						<label for="fecha_nacimiento">Fecha de nacimiento</label>
						<input type="date" class="form-control {{$errors->has('fecha_nacimiento') ? 'is-invalid' : ''}}" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}">
						@error('fecha_nacimiento')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>

				</div>

				<div class="row">
					<div class="form-check ml-3">
						<input class="form-check-input" type="checkbox" value="1" name="es_alumno[0]">
						{{-- <input class="form-check-input" type="hidden" value="0" name="es_alumno[1]"> --}}
						<label class="form-check-label" for="es_alumno">
							Es alumno
						</label>
					</div>
				</div>

				<div class="row mt-3">
					<div class="col-md-12 form-group">
						<label for="observaciones">Observaciones</label>
						<textarea name="observaciones" class="form-control {{$errors->has('observaciones') ? 'is-invalid' : ''}}">{{ old('observaciones') }}</textarea>
						@error('observaciones')
						<span class="invalid-feedback" role="alert">
							<strong>{{ ucfirst($message) }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<button type="submit" class="btn btn-primary">Guardar</button>

			</form>
		</div>
	</div>

</div>

@endsection
