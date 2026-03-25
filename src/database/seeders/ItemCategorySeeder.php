<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemCategorySeeder extends Seeder
{
    public function run()
    {
        $now = now();

        $items = Item::whereIn('name', [
            '腕時計',
            'HDD',
            '玉ねぎ3束',
            '革靴',
            'ノートPC',
            'マイク',
            'ショルダーバッグ',
            'タンブラー',
            'コーヒーミル',
            'メイクセット',
        ])->get()->keyBy('name');

        $categories = Category::whereIn('content', [
            'ファッション',
            '家電',
            'レディース',
            'メンズ',
            'コスメ',
            'キッチン',
            'アクセサリー',
        ])->get()->keyBy('content');

        DB::table('item_category')->insert([
            [
                'item_id' => $items['腕時計']->id,
                'category_id' => $categories['メンズ']->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'item_id' => $items['腕時計']->id,
                'category_id' => $categories['アクセサリー']->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'item_id' => $items['HDD']->id,
                'category_id' => $categories['家電']->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'item_id' => $items['玉ねぎ3束']->id,
                'category_id' => $categories['キッチン']->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'item_id' => $items['革靴']->id,
                'category_id' => $categories['メンズ']->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'item_id' => $items['革靴']->id,
                'category_id' => $categories['ファッション']->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'item_id' => $items['ノートPC']->id,
                'category_id' => $categories['家電']->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'item_id' => $items['マイク']->id,
                'category_id' => $categories['家電']->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'item_id' => $items['ショルダーバッグ']->id,
                'category_id' => $categories['レディース']->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'item_id' => $items['ショルダーバッグ']->id,
                'category_id' => $categories['ファッション']->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'item_id' => $items['タンブラー']->id,
                'category_id' => $categories['キッチン']->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'item_id' => $items['コーヒーミル']->id,
                'category_id' => $categories['キッチン']->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'item_id' => $items['メイクセット']->id,
                'category_id' => $categories['レディース']->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'item_id' => $items['メイクセット']->id,
                'category_id' => $categories['コスメ']->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}