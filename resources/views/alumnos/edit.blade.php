@extends('layouts.app')

@section('links')
@include('partials.DateCKEditor')
<link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
@endsection

@section('content')
<div class="container">

	<div class="card">
		<h5 class="card-header">Editar alumno: {{$alumno->nombre}}</h5>
		<div class="card-body">
			<form action="{{ route('alumnos.update', $alumno->id) }}" method="POST" data-parsley-validate="">
				@csrf
				@method('PUT')
				<div class="row">
					<div class="col-md-6 form-group">
						<label for="nombre">Nombre</label>
						<input type="text" class="form-control {{$errors->has('nombre') ? 'is-invalid' : ''}}" name="nombre" value="{{ old('nombre', $alumno->nombre) }}" data-parsley-required>

						@error('nombre')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="col-md-6 form-group">
						<label for="alias">Alias</label>
						<input type="text" class="form-control {{$errors->has('alias') ? 'is-invalid' : ''}}" name="alias" value="{{ old('alias', $alumno->alias) }}">
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
						<input type="text" class="form-control {{$errors->has('apellido') ? 'is-invalid' : ''}}" name="apellido" value="{{ old('apellido', $alumno->apellido) }}" data-parsley-required>
						@error('apellido')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="col-md-6 form-group">
						<label for="dni">DNI</label>
						<input type="text" class="form-control {{$errors->has('dni') ? 'is-invalid' : ''}}" name="dni" value="{{ old('dni', $alumno->dni) }}" data-parsley-required data-parsley-type="number" data-parsley-min="30000000">
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
							<option value="1" {{($alumno->grado == 1) ? 'selected' : ''}}>1</option>
							<option value="2" {{($alumno->grado == 2) ? 'selected' : ''}}>2</option>
							<option value="3" {{($alumno->grado == 3) ? 'selected' : ''}}>3</option>
							<option value="4" {{($alumno->grado == 4) ? 'selected' : ''}}>4</option>
							<option value="5" {{($alumno->grado == 5) ? 'selected' : ''}}>5</option>
							<option value="6" {{($alumno->grado == 6) ? 'selected' : ''}}>6</option>
						</select>
						@error('grado')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="col-md-6 form-group">
						<label for="fecha_nacimiento">Fecha de nacimiento</label>
						<input type="text" class="form-control {{$errors->has('fecha_nacimiento') ? 'is-invalid' : ''}}" name="fecha_nacimiento" id='datetimepicker1' value="{{ old('fecha_nacimiento', $alumno->fecha_nacimiento->format('d-m-Y')) }}">

						@error('fecha_nacimiento')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>

				</div>

				<div class="row">
					<div class="form-check">
						<input type="checkbox" class="switch_1 radio-inline" value="1" name="es_alumno[0]" {{($alumno->es_alumno == 1) ? 'checked' : ''}} id="es_alumno">
						<label for="es_alumno" class="label-check">
							Es alumno
						</label>
					</div>
				</div>

				<div class="row mt-3">
					<div class="col-md-12 form-group">
						<label for="observaciones">Observaciones</label>
						<textarea id="observaciones" name="observaciones" class="form-control {{$errors->has('observaciones') ? 'is-invalid' : ''}}">{{ old('observaciones', $alumno->observaciones) }}</textarea>
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

<script src="{{ asset('js/parsley.min.js') }}"></script>
<script src="{{ asset('js/parsleyes.js') }}"></script>
@endsection
