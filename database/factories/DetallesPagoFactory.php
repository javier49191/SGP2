<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\DetallesPago;
use Faker\Generator as Faker;

$factory->define(DetallesPago::class, function (Faker $faker) {
    return [
        'tipo_pago_id' => random_int(\DB::table('tipos_pagos')->min('id'), \DB::table('tipos_pagos')->max('id')),
        'factura' => $faker->numberBetween($min = 1000, $max = 9000),
        'comprobante' => $faker->numberBetween($min = 1000, $max = 9000),
        'descripcion' => $faker->sentence($nbWords = 6, $variableNbWords = false),
    ];
});
