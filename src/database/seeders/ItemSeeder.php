<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'user_id' => 1,
                'name' => '腕時計',
                'brand_name' => 'Rolax',
                'description' => 'スタイリッシュなデザインのメンズ腕時計',
                'price' => 15000,
                'condition_id' => 1,
                'image' => 'img/items/watch.jpg',
            ],
            [
                'user_id' => 1,
                'name' => 'HDD',
                'brand_name' => '西芝',
                'description' => '高速で信頼性の高いハードディスク',
                'price' => 5000,
                'condition_id' => 2,
                'image' => 'img/items/hdd.jpg',
            ],
            [
                'user_id' => 1,
                'name' => '玉ねぎ3束',
                'brand_name' => null,
                'description' => '新鮮な玉ねぎ3束のセット',
                'price' => 300,
                'condition_id' => 3,
                'image' => 'img/items/onion.jpg',
            ],
            [
                'user_id' => 1,
                'name' => '革靴',
                'brand_name' => null,
                'description' => 'クラシックなデザインの革靴',
                'price' => 4000,
                'condition_id' => 4,
                'image' => 'img/items/shoes.jpg',
            ],
            [
                'user_id' => 1,
                'name' => 'ノートPC',
                'brand_name' => null,
                'description' => '高性能なノートパソコン',
                'price' => 45000,
                'condition_id' => 1,
                'image' => 'img/items/laptop.jpg',
            ],
            [
                'user_id' => 2,
                'name' => 'マイク',
                'brand_name' => null,
                'description' => '高音質のレコーディング用マイク',
                'price' => 8000,
                'condition_id' => 2,
                'image' => 'img/items/mic.jpg',
            ],
            [
                'user_id' => 2,
                'name' => 'ショルダーバッグ',
                'brand_name' => null,
                'description' => 'おしゃれなショルダーバッグ',
                'price' => 3500,
                'condition_id' => 3,
                'image' => 'img/items/shoulder-bag.jpg',
            ],
            [
                'user_id' => 2,
                'name' => 'タンブラー',
                'brand_name' => null,
                'description' => '使いやすいタンブラー',
                'price' => 500,
                'condition_id' => 4,
                'image' => 'img/items/tumbler.jpg',
            ],
            [
                'user_id' => 2,
                'name' => 'コーヒーミル',
                'brand_name' => 'Starbacks',
                'description' => '手動のコーヒーミル',
                'price' => 4000,
                'condition_id' => 1,
                'image' => 'img/items/coffee-mill.jpg',
            ],
            [
                'user_id' => 2,
                'name' => 'メイクセット',
                'brand_name' => null,
                'description' => '便利なメイクアップセット',
                'price' => 2500,
                'condition_id' => 2,
                'image' => 'img/items/makeup-set.jpg',
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}