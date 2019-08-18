@extends('layouts.app')

@section('content')
<div class="container">


	<div class="card">
		<h5 class="card-header">Registrar usuario</h5>
		<div class="card-body">
			<form action="{{ route('usuarios.store') }}" method="POST">
				@csrf
				<div class="row">
					<div class="col-md-6 form-group">
						<label for="name">Nombre</label>
						<input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" name="name" value="{{ old('name') }}">

						@error('name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="col-md-6 form-group">
						<label for="last_name">Apellido</label>
						<input type="text" class="form-control {{$errors->has('last_name') ? 'is-invalid' : ''}}" name="last_name" value="{{ old('last_name') }}">
						@error('last_name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="row">
					<div class="col-md-6 form-group">
						<label for="email">Email</label>
						<input type="text" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" name="email" value="{{ old('email') }}">
						@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>

					<div class="col-md-6 form-group">
						<label for="role_id">Rol</label>

						<select name="role_id" class="custom-select {{$errors->has('role_id') ? 'is-invalid' : ''}}">
							<option selected value>Seleccionar...</option>
							@forelse($roles as $role)
							<option value="{{$role->id}}">{{$role->descripcion}}</option>
							@empty
							@endforelse

						</select>

						@error('role_id')
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
