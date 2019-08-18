<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadosFinanciero extends Model
{
    protected $fillable = [
    	'nombre',
    	'cantidad_cuotas'
    ];
}
