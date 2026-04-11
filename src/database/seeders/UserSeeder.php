<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'testuser1',
                'postal_code' => '100-0001',
                'address' => '東京都千代田区千代田1-1',
                'building' => 'テストビル101',
                'image' => null,
                'email' => 'test1@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'testuser2',
                'postal_code' => null,
                'address' => null,
                'building' => null,
                'image' => null,
                'email' => 'test2@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'testuser3',
                'postal_code' => '150-0001',
                'address' => '東京都渋谷区神宮前1-1-1',
                'building' => 'テストマンション303',
                'image' => null,
                'email' => 'test3@example.com',
                'email_verified_at' => null,
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}