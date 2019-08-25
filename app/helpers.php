<?php

function active($path){
	return Request::is($path) ? 'custom_active active' : '';
}
function pendientes($val1){
	return (12 - $val1);
}
function vinculado($val1, $val2, $val3){
	if ($val1->firstWhere($val2, $val3)){
		return true;
	}
	else{
		return false;
	}
}
function estadoFinanciero($val1, $val2, $val3){
	return $val1->firstWhere($val2, '>=', $val3)->nombre;
}
function claseEstado($val1, $val2, $val3){
	$res = $val1->firstWhere($val2, '>=', $val3)->nombre;

	if ($res=='Regular') {
		return 'badge-success';
	}
	elseif ($res=='Atrasado') {
		return 'badge-warning';
	}
	else{
		return 'badge-danger';
	}
}
function cantidadEstadoRegular($val1, $val2, $val3){
	$count = 0;
	foreach ($val3 as $p) {

		$res = $val1->firstWhere($val2, '>=', (12 - $p->pagos->count()))->nombre;

		if ($res=='Regular') {
			$count++;
		}
	}
	return $count;
}
function cantidadEstadoAtrasado($val1, $val2, $val3){
	$count = 0;
	foreach ($val3 as $p) {

		$res = $val1->firstWhere($val2, '>=', (12 - $p->pagos->count()))->nombre;

		if ($res=='Atrasado') {
			$count++;
		}
	}
	return $count;
}
function cantidadEstadoMoroso($val1, $val2, $val3){
	$count = 0;
	foreach ($val3 as $p) {

		$res = $val1->firstWhere($val2, '>=', (12 - $p->pagos->count()))->nombre;

		if ($res=='Moroso') {
			$count++;
		}
	}
	return $count;
}
function tipoPago($val1, $val2){
	$count = 0;
	foreach ($val1 as $p) {
		if ($p->detallePago->tipoPago->descripcion == $val2) {
			$count++;
		}
	}
	return $count;
	
}

function padrinoNombre($val1){
	return $val1->padrino->nombre;
}
function usuarioNombre($val1){
	return $val1->user->name;
}
