<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $fillable =[
    	'nombre',
    	'alias',
    	'apellido',
    	'dni',
    	'grado',
    	'observaciones',
    	'es_alumno',
    	'fecha_nacimiento'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'fecha_nacimiento',
    ];
    public function vinculaciones(){
        return $this->hasMany(Vinculacione::class);
    }
}
