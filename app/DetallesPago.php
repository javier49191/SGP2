<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallesPago extends Model
{
    protected $fillable = [
    	'tipo_pago_id',
    	'factura',
    	'comprobante',
    	'descripcion',
    ];

    public function tipoPago(){
    	return $this->belongsTo(TiposPago::class);
    }
}
