<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'testuser1',
            'email' => 'test1@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'testuser2',
            'email' => 'test2@example.com',
            'password' => Hash::make('password'),
        ]);

        $this->call([
            ItemSeeder::class,
        ]);
    }
}