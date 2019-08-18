@extends('layouts.app')

@section('links')
<link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ route('vinculaciones.store') }}" method="POST" data-parsley-validate="">
				@csrf
				<div class="card">
					<div class="card-header bg-secondary text-white">
						<h6>Crear Vinculación</h6>
					</div>
					<div class="card-body">
						<div class="form-group">
							<div class="card-header bg-primary text-white rounded">
								<label for="padrino">
									<b>Seleccione un padrino</b>
								</label>								
							</div>
							<div class="card-body">							

								<select class="form-control {{$errors->has('padrino_id') ? 'is-invalid' : ''}}" id="padrino_id" name="padrino_id" data-parsley-required>
									<option value="" disabled selected>Select...</option>
									@forelse($padrinos as $padrino)
									<option value="{{$padrino->id}}" {{old('padrino_id')}}
										data-apellido="{{$padrino->apellido}}"
										data-alias="{{$padrino->alias}}"
										data-dni="{{$padrino->dni}}"
										data-cuil="{{$padrino->cuil}}"
										data-email="{{$padrino->email}}"
										data-segundo_email="{{$padrino->segundo_email}}"
										data-telefono="{{$padrino->telefono}}"
										data-segundo_telefono="{{$padrino->segundo_telefono}}"
										>{{$padrino->nombre}}</option>
										@empty
										@endforelse					
									</select>
									@error('padrino_id')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>
							<b>Infomación del padrino seleccionado</b>
							<div class="row mt-2">
								<div class="col-md-3">
									<div class="from-group">
										<label for="apellido">Apellido</label>
										<input type="text" disabled id="apellido" class="form-control">
									</div>
								</div>
								<div class="col-md-3">
									<label for="alias">Alias</label>
									<input type="text" disabled id="alias" class="form-control">
								</div>
								<div class="col-md-3">
									<label for="dni">DNI</label>
									<input type="text" disabled id="dni" class="form-control">
								</div>
								<div class="col-md-3">
									<label for="cuil">CUIL</label>
									<input type="text" disabled id="cuil" class="form-control">
								</div>
							</div>
							{{-- ############################ --}}
							<div class="row">
								<div class="col-md-3">
									<div class="from-group">
										<label for="email">Email</label>
										<input type="text" disabled id="email" class="form-control">
									</div>
								</div>
								<div class="col-md-3">
									<label for="segundo_email">Segundo Email</label>
									<input type="text" disabled id="segundo_email" class="form-control">
								</div>
								<div class="col-md-3">
									<label for="telefono">Teléfono</label>
									<input type="text" disabled id="telefono" class="form-control">
								</div>
								<div class="col-md-3">
									<label for="segundo_telefono">Segundo teléfono</label>
									<input type="text" disabled id="segundo_telefono" class="form-control">
								</div>
							</div>
							{{-- ######## Alumno ############# --}}
							<hr class="bg-dark">
							<div class="form-group">
								<div class="card-header bg-primary text-white rounded">
									<label for="alumno">
										<b>Seleccione un alumno</b>
									</label>									
								</div>
								<div class="card-body">
									
								
								<select class="form-control {{$errors->has('alumno_id') ? 'is-invalid' : ''}}" id="alumno_id" name="alumno_id" data-parsley-required>
									<option value="" disabled selected>Select...</option>
									@forelse($alumnos as $alumno)
									<option value="{{$alumno->id}}" 
										data-apellido="{{$alumno->apellido}}"
										data-alias="{{$alumno->alias}}"
										data-dni="{{$alumno->dni}}"
										data-grado="{{$alumno->grado}}"
										>{{$alumno->nombre}}</option>
										@empty
										@endforelse					
									</select>
									@error('alumno_id')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
								</div>
								<b>Infomación del alumno seleccionado</b>
								<div class="row mt-2">
									<div class="col-md-3">
										<div class="from-group">
											<label for="apellidoAlumno">Apellido</label>
											<input type="text" disabled id="apellidoAlumno" class="form-control">
										</div>
									</div>
									<div class="col-md-3">
										<label for="aliasAlumno">Alias</label>
										<input type="text" disabled id="aliasAlumno" class="form-control">
									</div>
									<div class="col-md-3">
										<label for="dniAlumno">DNI</label>
										<input type="text" disabled id="dniAlumno" class="form-control">
									</div>
									<div class="col-md-3">
										<label for="cuilAlumno">Grado</label>
										<input type="text" disabled id="gradoAlumno" class="form-control">
									</div>
								</div>
								<hr class="bg-dark">
								<div class="row mt-3">
									<div class="form-check">
										<input type="checkbox" class="switch_1 radio-inline" value="1" name="se_conocen[0]" id="se_conocen">
										<label for="se_conocen" class="label-check">
											Se cononen
										</label>
									</div>
								</div>
								{{-- ############################ --}}
								<div class="row mt-3">
									<div class="col-md-12">
										<button type="submit" class="btn btn-primary">
											Guardar
										</button>									
									</div>
								</div>
							</div>
							{{-- Card Body --}}
						</div>
					</form>			
				</div>
			</div>
		</div>
		@endsection

		@section('scripts')
		<script src="{{ asset('js/parsley.min.js') }}"></script>
		<script src="{{ asset('js/parsleyes.js') }}"></script>
		<script>
			$('select[name="padrino_id"]').on('change',function(e){
				$('#apellido').val($(this).children('option:selected').data('apellido'));
				$('#alias').val($(this).children('option:selected').data('alias'));
				$('#dni').val($(this).children('option:selected').data('dni'));
				$('#cuil').val($(this).children('option:selected').data('cuil'));
				$('#email').val($(this).children('option:selected').data('email'));
				$('#segundo_email').val($(this).children('option:selected').data('segundo_email'));
				$('#telefono').val($(this).children('option:selected').data('telefono'));
				$('#segundo_telefono').val($(this).children('option:selected').data('segundo_telefono'));
			});
		</script>
		<script>
			$('select[name="alumno_id"]').on('change',function(e){
				$('#apellidoAlumno').val($(this).children('option:selected').data('apellido'));
				$('#aliasAlumno').val($(this).children('option:selected').data('alias'));
				$('#dniAlumno').val($(this).children('option:selected').data('dni'));
				$('#gradoAlumno').val($(this).children('option:selected').data('grado'));
			});
		</script>
		@endsection