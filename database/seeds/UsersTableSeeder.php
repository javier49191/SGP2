<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role_id' => 1,
            'name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role_id' => 2,
        	'name' => 'Secretaria',
            'last_name' => 'secretaria',
        	'email' => 'secretaria@secretaria.com',
        	'email_verified_at' => now(),
        	'password' => bcrypt('secretaria123'),
        	'remember_token' => Str::random(10),
        ]);

        User::create([
            'role_id' => 3,
        	'name' => 'Encargado de cuentas',
            'last_name' => 'encargado',
        	'email' => 'encargado@encargado.com',
        	'email_verified_at' => now(),
        	'password' => bcrypt('encargado123'),
        	'remember_token' => Str::random(10),
        ]);
    }
}
