<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class LargeScaleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory()->count(1000)->create();
    }
}
