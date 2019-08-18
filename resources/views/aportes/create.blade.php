@extends('layouts.app')

@section('links')
@include('partials.DateCKEditor')
<link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
@endsection

@section('content')
<div class="container">

	<div class="card">
		<h5 class="card-header">Registrar Aporte</h5>
		<div class="card-body">

			<form action="{{ route('aportes.store') }}" method="POST" data-parsley-validate="">
				@csrf
				<div class="row">
					<div class="col-md-12">
						<label for="padrino_id">Buscar Padrinos</label>
						<select class="custom-select {{$errors->has('padrino_id') ? 'is-invalid' : ''}}" name="padrino_id" data-parsley-required data-parsley-validate="parsley">
							<option selected disabled>Seleccionar...</option>
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
								<option>No existen registros</option>
								@endforelse
							</select>
							@error('padrino_id')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>

					</div>
					{{-- ############################################### --}}
					<br>
					<b class="mt-3">Infomación del padrino seleccionado</b>
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
					{{-- ############################################### --}}
					<hr class="bg-dark">
					<div class="row mt-3">
						<div class="col-md-4">
							<label for="tipo_pago_id">Medio de pago</label>
							<select class="custom-select {{$errors->has('tipo_pago_id') ? 'is-invalid' : ''}}" name="tipo_pago_id" data-parsley-required>
								<option selected value>Seleccionar...</option>
								@forelse($tipos as $tipo)
								<option value="{{$tipo->id}}">{{$tipo->descripcion}}</option>
								@empty
								<option>No existen registros</option>
								@endforelse
							</select>
							@error('tipo_pago_id')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
						<div class="col-md-4">
							<label for="monto_pago">Monto</label>
							<input type="text" class="form-control {{$errors->has('monto_pago') ? 'is-invalid' : ''}}" name="monto_pago" value="{{ old('monto_pago') }}" data-parsley-required data-parsley-type="number">

							@error('monto_pago')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
						<div class="col-md-4">
							<label for="fecha_pago">Fecha del pago</label>
							<input type="text" class="form-control {{$errors->has('fecha_pago') ? 'is-invalid' : ''}}" name="fecha_pago" id='datetimepicker1' value="{{ old('fecha_pago') }}" placeholder="DD-MM-YYYY">

							@error('fecha_pago')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>
					{{-- ############################################### --}}
					<div class="row mt-3">
						<div class="col-md-4">
							<label for="factura">Factura</label>
							<input type="text" class="form-control {{$errors->has('factura') ? 'is-invalid' : ''}}" name="factura" value="{{ old('factura') }}" data-parsley-required>

							@error('factura')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
						<div class="col-md-4">
							<label for="comprobante">Comprobante</label>
							<input type="text" class="form-control {{$errors->has('comprobante') ? 'is-invalid' : ''}}" name="comprobante" value="{{ old('comprobante') }}" data-parsley-required>

							@error('comprobante')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
						<div class="col-md-4">
							<label for="descripcion">Descripción</label>
							<input type="text" class="form-control {{$errors->has('descripcion') ? 'is-invalid' : ''}}" name="descripcion" value="{{ old('descripcion') }}" data-parsley-required>

							@error('descripcion')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>
					{{-- ############################################### --}}

					<button type="submit" class="btn btn-primary mt-3">Guardar</button>

				</form>
			</div>
		</div>

	</div>

	@endsection

	@section('scripts')
	@include('partials.parsley')
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
	<script type="text/javascript">
		$(function () {
			$('#datetimepicker1').datetimepicker({
				locale: 'es',
				viewMode: 'days',
				format: 'DD-MM-YYYY'
			});
		});
	</script>
	@endsection