<?php

use Illuminate\Database\Seeder;

class DomiciliosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Domicilio::class, 20)->create();
    }
}
