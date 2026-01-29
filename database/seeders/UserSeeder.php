<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Usuario',
            'email' => 'usuario@sena.edu.co',
            'password' => Hash::make('12345678'),
            'rol' => 'user'
        ]);

        User::create([
            'name' => 'instructor',
            'email' => 'instructor@sena.edu.co',
            'password' => Hash::make('12345678'),
            'rol' => 'instructor'
        ]);

        User::create([
            'name' => 'instructor',
            'email' => 'lider@sena.edu.co',
            'password' => Hash::make('12345678'),
            'rol' => 'lider'
        ]);

        User::create([
            'name' => 'instructor',
            'email' => 'supervisor@sena.edu.co',
            'password' => Hash::make('12345678'),
            'rol' => 'supervisor'
        ]);
    }
}
