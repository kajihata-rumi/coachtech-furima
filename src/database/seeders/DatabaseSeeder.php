<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ConditionSeeder::class,
            ItemSeeder::class,
            ItemCategorySeeder::class,
            CommentSeeder::class,
            LikeSeeder::class,
            PurchaseSeeder::class,
        ]);
    }
}