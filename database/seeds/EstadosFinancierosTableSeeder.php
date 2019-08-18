<?php

use Illuminate\Database\Seeder;
use App\EstadosFinanciero;

class EstadosFinancierosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadosFinanciero::create([
        	'nombre' => 'Regular',
        	'cantidad_cuotas' => 4
        ]);

        EstadosFinanciero::create([
        	'nombre' => 'Atrasado',
        	'cantidad_cuotas' => 8
        ]);

        EstadosFinanciero::create([
        	'nombre' => 'Moroso',
        	'cantidad_cuotas' => 12
        ]);
    }
}
