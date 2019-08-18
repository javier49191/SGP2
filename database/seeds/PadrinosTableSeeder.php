<?php

use Illuminate\Database\Seeder;

class PadrinosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Padrino::class, 20)->create();
    }
}
