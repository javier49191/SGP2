<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $fillable = [
    	'monto_pago',
    	'detalle_pago_id',
        'padrino_id',
    	'fecha_pago',
    	'user_id',
    ];

    protected $dates = [
    'created_at',
    'updated_at',
    'fecha_pago',
];

    public function padrino(){
    	return $this->belongsTo(Padrino::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function detallePago(){
        return $this->belongsTo(DetallesPago::class);
    }
}
