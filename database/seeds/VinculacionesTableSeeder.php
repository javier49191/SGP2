<?php

use Illuminate\Database\Seeder;

class VinculacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Vinculacione::class, 20)->create();
    }
}
