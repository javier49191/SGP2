<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Domicilio;
use Faker\Generator as Faker;

$factory->define(Domicilio::class, function (Faker $faker) {
	return [
		'calle' => $faker->word,
		'numero' => $faker->numberBetween($min = 10, $max = 90),
		'provincia' => $faker->randomElement([
			"Buenos Aires",
			"Catamarca",
			"Chaco",
			"Chubut",
			"Córdoba",
			"Corrientes",
			"Entre Ríos",
			"Formosa",
			"Jujuy",
			"La Pampa",
			"La Rioja",
			"Mendoza",
			"Misiones",
			"Neuquén",
			"Río Negro",
			"Salta",
			"San Juan",
			"Santa Cruz",
			"Santa Fe",
			"Santiago del Estero",
			"Tierra del Fuego",
			"Tucumán",
		]),
		'ciudad' => $faker->word,
		'dpto' => $faker->numberBetween($min = 10, $max = 90),
		'piso' => $faker->numberBetween($min = 10, $max = 90),
	];
});
