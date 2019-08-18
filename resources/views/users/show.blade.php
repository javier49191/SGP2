@extends('layouts.app')

@section('links')
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
							<img class="imagenShow" src="{{ asset('images/avatar/') }}/{{$user->avatar}}" title="avatar de {{$user->name}}">
						</div>
						<div class="col-md-6 form-group">
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

@endsection