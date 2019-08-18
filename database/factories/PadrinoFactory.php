<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Padrino;
use Faker\Generator as Faker;

$factory->define(Padrino::class, function (Faker $faker) {
	$complete = explode(" ", $faker->name);
    while($complete[0] == 'Mr.' || $complete[0] == 'Dr.' || $complete[0] == 'Mrs.' || $complete[0] == 'Prof.' || $complete[0] == 'Ms.' || $complete[0] == 'Miss'){
        $complete = explode(" ", $faker->name);
    }
    $name = $complete[0];
    $last_name = $complete[1];
    return [
    	'apellido' => ucfirst($last_name),
        'nombre' => ucfirst($name),
    	'alias' => ucfirst($name),
    	'dni' => $faker->numberBetween($min = 33000000, $max = 36000000),
    	'cuil' => $faker->numberBetween($min = 33000000, $max = 36000000),
    	'email' => $faker->freeEmail,
    	'segundo_email' => $faker->freeEmail,
    	'telefono' => $faker->numberBetween($min = 35100000, $max = 35200000),
    	'segundo_telefono' => $faker->numberBetween($min = 35100000, $max = 35200000),
    	'contacto' => $faker->sentence($nbWords = 4, $variableNbWords = false),
        'domicilio_id' => random_int(\DB::table('domicilios')->min('id'), \DB::table('domicilios')->max('id')),
        'checklist' => $faker->randomElement([0, 1]),
    ];
});
