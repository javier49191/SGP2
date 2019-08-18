<?php

use Illuminate\Database\Seeder;
use App\TiposPago;

class TiposPagosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TiposPago::create([
        	'descripcion' => 'Efectivo'
        ]);
        TiposPago::create([
        	'descripcion' => 'Tarjeta Naranja'
        ]);
        TiposPago::create([
        	'descripcion' => 'Visa'
        ]);
        TiposPago::create([
        	'descripcion' => 'Cheque'
        ]);
    }
}
