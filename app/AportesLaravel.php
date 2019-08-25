<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AportesLaravel extends Model
{
    protected $table = 'aportes_view';

    protected $dates = [
    'created_at',
    'fecha_pago',
	];
}
