@extends('layouts.app')

@section('links')
@include('partials.DateCKEditor')
<link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
@endsection

@section('content')
<div class="container">

	<div class="card">
		<h5 class="card-header">Registrar Alumno</h5>
		<div class="card-body">
			<form action="{{ route('alumnos.store') }}" method="POST" data-parsley-validate="">
				@csrf
				<div class="row">
					<div class="col-md-6 form-group">
						<label for="nombre">Nombre</label>
						<input type="text" class="form-control {{$errors->has('nombre') ? 'is-invalid' : ''}}" name="nombre" value="{{ old('nombre') }}" data-parsley-required>

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
						<input type="text" class="form-control {{$errors->has('apellido') ? 'is-invalid' : ''}}" name="apellido" value="{{ old('apellido') }}" data-parsley-required>
						@error('apellido')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="col-md-6 form-group">
						<label for="dni">DNI</label>
						<input type="text" class="form-control {{$errors->has('dni') ? 'is-invalid' : ''}}" name="dni" value="{{ old('dni') }}" data-parsley-required data-parsley-type="number" data-parsley-min="30000000">
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
						<select name="grado" id="grado" class="custom-select {{$errors->has('grado') ? 'is-invalid' : ''}}" required>
							<option selected disabled>Seleccionar...</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
						</select>
						@error('grado')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="col-md-6 form-group">
						<label for="fecha_nacimiento">Fecha de nacimiento</label>
						<input type="text" class="form-control {{$errors->has('fecha_nacimiento') ? 'is-invalid' : ''}}" name="fecha_nacimiento" id='datetimepicker1' value="{{ old('fecha_nacimiento') }}" placeholder="DD-MM-YYYY">

						@error('fecha_nacimiento')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>

				</div>

				<div class="row">
					<div class="form-check">
						<input type="checkbox" class="switch_1 radio-inline" value="1" name="es_alumno[0]" id="es_alumno">
						<label for="es_alumno" class="label-check">
							Es alumno
						</label>
					</div>
				</div>

				<div class="row mt-3">
					<div class="col-md-12 form-group">
						<label for="observaciones">Observaciones</label>
						<textarea id="observaciones" name="observaciones" class="form-control {{$errors->has('observaciones') ? 'is-invalid' : ''}}">{{ old('observaciones') }}</textarea>
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

@section('scripts')
<script type="text/javascript">
	$(function () {
		$('#datetimepicker1').datetimepicker({
			locale: 'es',
			viewMode: 'days',
			format: 'DD-MM-YYYY'
		});
	});
</script>
<script>
	CKEDITOR.replace( 'observaciones' );
</script>

@include('partials.parsley')

@endsection