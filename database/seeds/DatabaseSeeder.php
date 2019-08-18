<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TiposPagosTableSeeder::class);
        $this->call(AlumnosTableSeeder::class);
        $this->call(DomiciliosTableSeeder::class);
        $this->call(PadrinosTableSeeder::class);
        $this->call(DetallesPagosSeeder::class);
        $this->call(PagosTableSeeder::class);
        $this->call(VinculacionesTableSeeder::class);
        $this->call(EstadosFinancierosTableSeeder::class);
    }
}
