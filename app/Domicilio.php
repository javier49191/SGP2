<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domicilio extends Model
{
    protected $fillable = [
    	'calle',
    	'numero',
    	'provincia',
    	'ciudad',
    	'dpto',
    	'piso'
    ];

    public function padrinos(){
    	return $this->hasMany(Padrino::class);
    }
}
