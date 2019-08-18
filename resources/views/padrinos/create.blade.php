@extends('layouts.app')

@section('links')
@include('partials.DateCKEditor')
<link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
@endsection

@section('content')
<div class="container">


	<div class="card">
		<h5 class="card-header">Registrar Padrino</h5>
		<div class="card-body">
			<form action="{{ route('padrinos.store') }}" method="POST" data-parsley-validate="">
				@csrf
				{{-- ################################################################# --}}
				<div class="row">
					<div class="col-md-4 form-group">
						<label for="nombre">Nombre</label>
						<input type="text" class="form-control {{$errors->has('nombre') ? 'is-invalid' : ''}}" name="nombre" value="{{ old('nombre') }}" data-parsley-required>

						@error('nombre')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="col-md-4 form-group">
						<label for="apellido">Apellido</label>
						<input type="text" class="form-control {{$errors->has('apellido') ? 'is-invalid' : ''}}" name="apellido" value="{{ old('apellido') }}" data-parsley-required>
						@error('apellido')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="col-md-4 form-group">
						<label for="alias">Alias</label>
						<input type="text" class="form-control {{$errors->has('alias') ? 'is-invalid' : ''}}" name="alias" value="{{ old('alias') }}">
						@error('alias')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>
				{{-- ################################################################# --}}
				<div class="row">

					<div class="col-md-6 form-group">
						<label for="dni">DNI</label>
						<input type="text" class="form-control {{$errors->has('dni') ? 'is-invalid' : ''}}" name="dni" value="{{ old('dni') }}" data-parsley-required data-parsley-type="number" data-parsley-min="10000000">
						@error('dni')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="col-md-6 form-group">
						<label for="cuil">Cuil</label>
						<input type="text" class="form-control {{$errors->has('cuil') ? 'is-invalid' : ''}}" name="cuil" value="{{ old('cuil') }}" data-parsley-required data-parsley-type="number" ata-parsley-min="10000000">
						@error('cuil')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				{{-- ################################################################# --}}
				<div class="row">
					<div class="col-md-6 form-group">
						<label for="email">Email</label>
						<input type="text" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" name="email" value="{{ old('email') }}" data-parsley-required data-parsley-type="email">
						@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="col-md-6 form-group">
						<label for="segundo_email">Segundo Email</label>
						<input type="text" class="form-control {{$errors->has('segundo_email') ? 'is-invalid' : ''}}" name="segundo_email" value="{{ old('segundo_email') }}">
						@error('segundo_email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>
				{{-- ################################################################# --}}
				<div class="row">
					<div class="col-md-4 form-group">
						<label for="telefono">Teléfono</label>
						<input type="text" class="form-control {{$errors->has('telefono') ? 'is-invalid' : ''}}" name="telefono" value="{{ old('telefono') }}" data-parsley-required data-parsley-type="number">

						@error('telefono')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="col-md-4 form-group">
						<label for="segundo_telefono">Segundo Teléfono</label>
						<input type="text" class="form-control {{$errors->has('segundo_telefono') ? 'is-invalid' : ''}}" name="segundo_telefono" value="{{ old('segundo_telefono') }}" data-parsley-type="number">
						@error('segundo_telefono')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="col-md-4 form-group">
						<label for="contacto">Contacto</label>
						<input type="text" class="form-control {{$errors->has('contacto') ? 'is-invalid' : ''}}" name="contacto" value="{{ old('contacto') }}" data-parsley-required>
						@error('contacto')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="form-check">
						<input type="checkbox" class="switch_1" value="1" name="checklist[0]" id="checklist">
						<label for="checklist" class="label-check">
							Ficha física
						</label>
					</div>
				</div>
				{{-- ################################################################# --}}
				<hr>
				<h5 class="bg-light p-3">Domicilo</h5>
				<div class="row">
					<div class="col-md-6 form-group">

						<label for="provincia">Provincia</label>
						<select class="custom-select {{$errors->has('provincia') ? 'invalid' : ''}}" id="provincia" name="provincia" data-parsley-required>
							<option selected disabled>Seleccionar...</option>
							<option value="Buenos Aires">Buenos Aires</option>
							<option value="Catamarca">Catamarca</option>
							<option value="Chaco">Chaco</option>
							<option value="Chubut">Chubut</option>
							<option value="Córdoba">Córdoba</option>
							<option value="Corrientes">Corrientes</option>
							<option value="Entre Ríos">Entre Ríos</option>
							<option value="Formosa">Formosa</option>
							<option value="Jujuy">Jujuy</option>
							<option value="La Pampa">La Pampa</option>
							<option value="La Rioja">La Rioja</option>
							<option value="Mendoza">Mendoza</option>
							<option value="Misiones">Misiones</option>
							<option value="Neuquén">Neuquén</option>
							<option value="Río Negro">Río Negro</option>
							<option value="Salta">Salta</option>
							<option value="San Juan">San Juan</option>
							<option value="Santa Cruz">Santa Cruz</option>
							<option value="Santa Fe">Santa Fe</option>
							<option value="Santiago del Estero">Santiago del Estero</option>
							<option value="Tierra del Fuego">Tierra del Fuego</option>
							<option value="Tucumán">Tucumán</option>
						</select>
						@error('provincia')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror

					</div>

					<div class="col-md-6 form-group">
						<label for="ciudad">Ciudad</label>
						<input type="text" class="form-control {{$errors->has('ciudad') ? 'is-invalid' : ''}}" name="ciudad" value="{{ old('ciudad') }}" data-parsley-required>
						@error('ciudad')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>

				</div>

				{{-- ################################################################# --}}
				<div class="row">
					<div class="col-md-3 form-group">
						<label for="calle">Calle</label>
						<input type="text" class="form-control {{$errors->has('calle') ? 'is-invalid' : ''}}" name="calle" value="{{ old('calle') }}" data-parsley-required>

						@error('calle')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>

					<div class="col-md-3 form-group">
						<label for="numero">Número</label>
						<input type="text" class="form-control {{$errors->has('numero') ? 'is-invalid' : ''}}" name="numero" value="{{ old('numero') }}" data-parsley-required data-parsley-type="number">
						@error('numero')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>

					<div class="col-md-3 form-group">
						<label for="dpto">Departamento</label>
						<input type="text" class="form-control {{$errors->has('dpto') ? 'is-invalid' : ''}}" name="dpto" value="{{ old('dpto') }}" >
						@error('dpto')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>

					<div class="col-md-3 form-group">
						<label for="piso">Piso</label>
						<input type="text" class="form-control {{$errors->has('piso') ? 'is-invalid' : ''}}" name="piso" value="{{ old('piso') }}"  data-parsley-type="number">
						@error('piso')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>
				{{-- ################################################################# --}}
				<hr>
				<h5 class="bg-light p-3">Vinculación</h5>
				<div class="row">
					<div class="col-md-12">
						<label for="alumno_id">Alumnos sin vinculación</label>
						<select class="custom-select" name="alumno_id">
							<option selected value>Seleccionar...</option>
							@forelse($alumnos as $alumno)
								<option value="{{$alumno->id}}">{{$alumno->nombre}}</option>
							@empty
								<option disabled>No existen registros</option>
							@endforelse
						</select>
					</div>
					<div class="form-check mt-2">
						<input type="checkbox" class="switch_1 radio-inline" value="1" name="se_conocen[0]" id="se_conocen">
						<label for="se_conocen" class="label-check">
							Se conocen
						</label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
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
					</div>
				</div>

				{{-- ################################################################# --}}

				<button type="submit" class="btn btn-primary mt-3">Guardar</button>


			</form>
		</div>
	</div>

</div>

@endsection

@section('scripts')
<script>
	CKEDITOR.replace( 'observaciones' );
</script>
<script src="{{ asset('js/parsley.min.js') }}"></script>
<script src="{{ asset('js/parsleyes.js') }}"></script>
@endsection
