<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vinculacione extends Model
{
    protected $fillable = [
    	'padrino_id',
    	'alumno_id',
    	'se_conocen',
    	'observaciones',
    	'deleted_at'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function alumno(){
    	return $this->belongsTo(Alumno::class);
    }

    public function padrino(){
    	return $this->belongsTo(Padrino::class);
    }
}
