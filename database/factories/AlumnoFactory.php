<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Alumno;
use Faker\Generator as Faker;

$factory->define(Alumno::class, function (Faker $faker) {
    $complete = explode(" ", $faker->name);
    while($complete[0] == 'Mr.' || $complete[0] == 'Dr.' || $complete[0] == 'Mrs.' || $complete[0] == 'Prof.' || $complete[0] == 'Ms.' || $complete[0] == 'Miss'){
        $complete = explode(" ", $faker->name);
    }
    $name = $complete[0];
    $last_name = $complete[1];
    return [
    	'alias' => ucfirst($name),
        'nombre' => ucfirst($name),
        'apellido' => ucfirst($last_name),
        'dni' => $faker->numberBetween($min = 88000000, $max = 89000000),
        'grado' => $faker->numberBetween($min = 1, $max = 6),
        'observaciones' => $faker->sentence($nbWords = 6, $variableNbWords = false),
        'es_alumno' => $faker->numberBetween($min = 0, $max = 1),
        'fecha_nacimiento' => $faker->dateTimeBetween($startDate = '-18 years', $endDate = '-10 years', $timezone = 'UTC'),
    ];
});
