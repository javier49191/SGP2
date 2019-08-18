<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Pago;
use Faker\Generator as Faker;

$factory->define(Pago::class, function (Faker $faker) {
    return [
        'monto_pago' => $faker->randomFloat($nbMaxDecimals = 2, $min = 2000, $max = 5000),

        'detalle_pago_id' => random_int(\DB::table('detalles_pagos')->min('id'), \DB::table('detalles_pagos')->max('id')),

        'padrino_id' => random_int(\DB::table('padrinos')->min('id'), \DB::table('padrinos')->max('id')),

        'fecha_pago' => $faker->dateTimeBetween($startDate = '-3840 days', $endDate = 'now', $timezone = 'UTC'),

        'user_id' => random_int(\DB::table('users')->min('id'), \DB::table('users')->max('id')),
    ];
});
