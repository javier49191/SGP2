<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
        	'nombre' => 'Admin',
        	'descripcion' => 'Administrador del sistema'
        ]);
        Role::create([
        	'nombre' => 'Secretaria',
        	'descripcion' => 'Secretaria del sistema'
        ]);
        Role::create([
        	'nombre' => 'Encargado',
        	'descripcion' => 'Encargado de cuentas del sistema'
        ]);
    }
}
