@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<img src="{{ asset('images/403.png') }}" class="img-fluid" alt="">
		</div>
		<div class="col-md-6 mt-5">
			<h2 class="text-center">Acceso no autorizado</h2>
			<h4>Por razones de seguridad, el usuario con rol <i class="text-primary">{{Auth::user()->role->nombre}}</i> no tiene permisos para ver la página solicitada.</h4>
			<h4>Por favor, contacte al administrador del sistema.</h4>
			<h4>Gracias!</h4>
		</div>
	</div>
</div>
@endsection