<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;
use Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin1@gmail.com',
            'role'=>'admin',
            'phone'=>'085719127681',
            'password' => Hash::make('Admin123'),
            'remember_token' => Str::random(32),
        ]);
    }
}