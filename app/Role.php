<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
    	'nombre',
    	'descripcion'
    ];

    public function users(){
    	return $this->hasMany(User::class);
    }
}
