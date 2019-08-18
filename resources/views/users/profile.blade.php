@extends('layouts.app')

@section('links')
<script type="text/javascript" src="{{ asset('js/bootstrap-filestyle.js') }} "></script>
@endsection

@section('content')
<div class="container">

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<b>Detalles de usuario: {{$user->name}}</b>
				</div>

				<div class="card-body">
					<div class="row">
						<div class="col-md-6 form-group">
							<img class="imagen" src="{{ asset('images/avatar/') }}/{{$user->avatar}}" title="avatar de {{$user->name}}">
							<hr>
							<form enctype="multipart/form-data" action="{{ route('profile') }}" method="POST">
								@csrf
								<div class="form-group">
									<label for="imagen">Actualizar imagen</label>
									<br>
									<input type="file" id="BSbtndanger" name="avatar" class=" @error('avatar') is-invalid @enderror">
									
									<input type="submit" class="btn btn-primary mt-2" value="Guardar">
									@if ($errors->has('avatar'))
									<div role="alert">
										<strong style="color: red;">{{$errors->first('avatar')}}</strong>
										<hr>
									</div>

									@endif
								</div>
							</form>
						</div>
						<div class="col-md-6 form-group">
							{{-- @error('avatar')
							<div class="invalid-feedback" role="alert">
								<strong>Testing</strong>
								<hr>
							</div>
							@enderror --}}
							<p class="form-control"><b>Nombre: </b>{{$user->name}}</p>
							<p class="form-control"><b>Email: </b>{{$user->email}}</p>
							<p class="form-control"><b>Apellido: </b>{{$user->last_name}}</p>
							<p class="form-control"><b>Registrado: </b>{{$user->created_at->format('d-m-Y')}}</p>
							<p class="form-control"><b>Rol: </b>{{$user->role->nombre}}</p>
							<p class="form-control"><b>Descripción: </b>{{$user->role->descripcion}}</p>

						</div>
						
					</div>
					
				</div>
			</div>
		</div>
	</div>

</div>
@endsection

@section('scripts')
{{-- Toastr --}}
@include('partials.alert')

<script>
	$('#BSbtndanger').filestyle({
		btnClass : 'btn-warning',
		text : 'Nueva',
		htmlIcon: '<i class="icon-file_alt"></i> '
	});
</script>

@endsection