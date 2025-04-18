<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     *
     * @return void
     */
    public function run()
    {
        // Membuat user dengan role admin, operator, dokter, kasir dan password
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('Admin123'), 
        ]);
        
        User::factory()->create([
            'name' => 'Operator User',
            'email' => 'operator@gmail.com',
            'role' => 'operator',
            'password' => Hash::make('Operator123'), 
        ]);
        
        User::factory()->create([
            'name' => 'Dokter User',
            'email' => 'dokter@gmail.com',
            'role' => 'dokter',
            'password' => Hash::make('Dokter123'), 
        ]);
        
        User::factory()->create([
            'name' => 'Kasir User',
            'email' => 'kasir@gmail.com',
            'role' => 'kasir',
            'password' => Hash::make('Kasir123'), 
        ]);
    }
}
