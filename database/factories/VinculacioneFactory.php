<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Vinculacione;
use Faker\Generator as Faker;

$factory->define(Vinculacione::class, function (Faker $faker) {
    return [
        'padrino_id' => random_int(\DB::table('padrinos')->min('id'), \DB::table('padrinos')->max('id')),
        'alumno_id' => random_int(\DB::table('alumnos')->min('id'), \DB::table('alumnos')->max('id')),
        'se_conocen' => $faker->numberBetween($min = 0, $max = 1),
        'observaciones' => $faker->sentence($nbWords = 4, $variableNbWords = false),
        'created_at' => $faker->dateTimeBetween($startDate = '-4 years', $endDate = '-1 years', $timezone = 'UTC'),
    ];
});
