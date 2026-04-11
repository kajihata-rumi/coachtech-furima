<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('purchases')->insert([
            [
                'user_id' => 1,
                'item_id' => 6,
                'payment_method' => 'card',
                'postal_code' => '150-0001',
                'address' => '東京都渋谷区神宮前1-2-3',
                'building' => 'テストマンション101',
                'purchased_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'item_id' => 7,
                'payment_method' => 'konbini',
                'postal_code' => '150-0001',
                'address' => '東京都渋谷区神宮前1-2-3',
                'building' => 'テストマンション101',
                'purchased_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('items')
            ->whereIn('id', [6, 7])
            ->update([
                'is_sold' => true,
                'updated_at' => now(),
            ]);
    }
}