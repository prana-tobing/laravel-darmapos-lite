<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'Admin DarmaPOS',
            'email' => 'adminpos@darma.co.id',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'roles' => 'ADMIN',
            'phone' => '085273626277'
        ]);
    }
}
