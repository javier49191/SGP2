@extends('layouts.app')

@section('links')
@include('partials.DateCKEditor')
<link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
@endsection

@section('content')
<div class="container">


	<div class="card">
		<h5 class="card-header">Editar Padrino</h5>
		<div class="card-body">
			<form action="{{ route('padrinos.update', $padrino->id) }}" method="POST" data-parsley-validate="">
				@csrf
				@method('PUT')
				{{-- ################################################################# --}}
				<div class="row">
					<div class="col-md-4 form-group">
						<label for="nombre">Nombre</label>
						<input type="text" class="form-control {{$errors->has('nombre') ? 'is-invalid' : ''}}" name="nombre" value="{{ old('nombre', $padrino->nombre) }}" data-parsley-required>

						@error('nombre')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="col-md-4 form-group">
						<label for="apellido">Apellido</label>
						<input type="text" class="form-control {{$errors->has('apellido') ? 'is-invalid' : ''}}" name="apellido" value="{{ old('apellido', $padrino->apellido) }}" data-parsley-required>
						@error('apellido')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="col-md-4 form-group">
						<label for="alias">Alias</label>
						<input type="text" class="form-control {{$errors->has('alias') ? 'is-invalid' : ''}}" name="alias" value="{{ old('alias', $padrino->alias) }}">
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
						<input type="text" class="form-control {{$errors->has('dni') ? 'is-invalid' : ''}}" name="dni" value="{{ old('dni', $padrino->dni) }}" data-parsley-required data-parsley-type="number" data-parsley-min="10000000">
						@error('dni')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="col-md-6 form-group">
						<label for="cuil">Cuil</label>
						<input type="text" class="form-control {{$errors->has('cuil') ? 'is-invalid' : ''}}" name="cuil" value="{{ old('cuil', $padrino->cuil) }}" data-parsley-required data-parsley-type="number" ata-parsley-min="10000000">
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
						<input type="text" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" name="email" value="{{ old('email', $padrino->email) }}" data-parsley-required data-parsley-type="email">
						@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="col-md-6 form-group">
						<label for="segundo_email">Segundo Email</label>
						<input type="text" class="form-control {{$errors->has('segundo_email') ? 'is-invalid' : ''}}" name="segundo_email" value="{{ old('segundo_email', $padrino->segundo_email) }}">
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
						<input type="text" class="form-control {{$errors->has('telefono') ? 'is-invalid' : ''}}" name="telefono" value="{{ old('telefono', $padrino->telefono) }}" data-parsley-required data-parsley-type="number">

						@error('telefono')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="col-md-4 form-group">
						<label for="segundo_telefono">Segundo Teléfono</label>
						<input type="text" class="form-control {{$errors->has('segundo_telefono') ? 'is-invalid' : ''}}" name="segundo_telefono" value="{{ old('segundo_telefono', $padrino->segundo_telefono) }}" data-parsley-type="number">
						@error('segundo_telefono')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="col-md-4 form-group">
						<label for="contacto">Contacto</label>
						<input type="text" class="form-control {{$errors->has('contacto') ? 'is-invalid' : ''}}" name="contacto" value="{{ old('contacto', $padrino->contacto) }}" data-parsley-required>
						@error('contacto')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="ml-3">
						<input type="checkbox" class="switch_1 radio-inline" value="1" name="checklist[0]" {{($padrino->checklist == 1) ? 'checked' : ''}} id="checklist">
						<label for="checklist" class="form-check-label">
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
							<option value="Buenos Aires" {{($domicilio->provincia == "Buenos Aires") ? 'selected' : ''}}>Buenos Aires</option>
							<option value="Catamarca" {{($domicilio->provincia == "Catamarca") ? 'selected' : ''}}>Catamarca</option>
							<option value="Chaco" {{($domicilio->provincia == "Chaco") ? 'selected' : ''}}>Chaco</option>
							<option value="Chubut" {{($domicilio->provincia == "Chubut") ? 'selected' : ''}}>Chubut</option>
							<option value="Córdoba" {{($domicilio->provincia == "Córdoba") ? 'selected' : ''}}>Córdoba</option>
							<option value="Corrientes" {{($domicilio->provincia == "Corrientes") ? 'selected' : ''}}>Corrientes</option>
							<option value="Entre Ríos" {{($domicilio->provincia == "Entre Ríos") ? 'selected' : ''}}>Entre Ríos</option>
							<option value="Formosa" {{($domicilio->provincia == "Formosa") ? 'selected' : ''}}>Formosa</option>
							<option value="Jujuy" {{($domicilio->provincia == "Jujuy") ? 'selected' : ''}}>Jujuy</option>
							<option value="La Pampa" {{($domicilio->provincia == "La Pampa") ? 'selected' : ''}}>La Pampa</option>
							<option value="La Rioja" {{($domicilio->provincia == "La Rioja") ? 'selected' : ''}}>La Rioja</option>
							<option value="Mendoza" {{($domicilio->provincia == "Mendoza") ? 'selected' : ''}}>Mendoza</option>
							<option value="Misiones" {{($domicilio->provincia == "Misiones") ? 'selected' : ''}}>Misiones</option>
							<option value="Neuquén" {{($domicilio->provincia == "Neuquén") ? 'selected' : ''}}>Neuquén</option>
							<option value="Río Negro" {{($domicilio->provincia == "Río Negro") ? 'selected' : ''}}>Río Negro</option>
							<option value="Salta" {{($domicilio->provincia == "Salta") ? 'selected' : ''}}>Salta</option>
							<option value="San Juan" {{($domicilio->provincia == "San Juan") ? 'selected' : ''}}>San Juan</option>
							<option value="Santa Cruz" {{($domicilio->provincia == "Santa Cruz") ? 'selected' : ''}}>Santa Cruz</option>
							<option value="Santa Fe" {{($domicilio->provincia == "Santa Fe") ? 'selected' : ''}}>Santa Fe</option>
							<option value="Santiago del Estero" {{($domicilio->provincia == "Santiago del Estero") ? 'selected' : ''}}>Santiago del Estero</option>
							<option value="Tierra del Fuego" {{($domicilio->provincia == "Tierra del Fuego") ? 'selected' : ''}}>Tierra del Fuego</option>
							<option value="Tucumán" {{($domicilio->provincia == "Tucumán") ? 'selected' : ''}}>Tucumán</option>
						</select>
						@error('provincia')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror

					</div>

					<div class="col-md-6 form-group">
						<label for="ciudad">Ciudad</label>
						<input type="text" class="form-control {{$errors->has('ciudad') ? 'is-invalid' : ''}}" name="ciudad" value="{{ old('ciudad', $domicilio->ciudad) }}" data-parsley-required>
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
						<input type="text" class="form-control {{$errors->has('calle') ? 'is-invalid' : ''}}" name="calle" value="{{ old('calle', $domicilio->calle) }}" data-parsley-required>

						@error('calle')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>

					<div class="col-md-3 form-group">
						<label for="numero">Número</label>
						<input type="text" class="form-control {{$errors->has('numero') ? 'is-invalid' : ''}}" name="numero" value="{{ old('numero', $domicilio->numero) }}" data-parsley-required data-parsley-type="number">
						@error('numero')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>

					<div class="col-md-3 form-group">
						<label for="dpto">Departamento</label>
						<input type="text" class="form-control {{$errors->has('dpto') ? 'is-invalid' : ''}}" name="dpto" value="{{ old('dpto', $domicilio->dpto) }}" >
						@error('dpto')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>

					<div class="col-md-3 form-group">
						<label for="piso">Piso</label>
						<input type="text" class="form-control {{$errors->has('piso') ? 'is-invalid' : ''}}" name="piso" value="{{ old('piso', $domicilio->piso) }}"  data-parsley-type="number">
						@error('piso')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>
				{{-- ################################################################# --}}
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
