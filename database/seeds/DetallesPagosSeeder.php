<?php

use Illuminate\Database\Seeder;

class DetallesPagosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\DetallesPago::class, 20)->create();
    }
}
