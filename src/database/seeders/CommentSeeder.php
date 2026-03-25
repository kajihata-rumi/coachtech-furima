<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    public function run()
    {
        DB::table('comments')->delete();

        DB::table('comments')->insert([
            [
                'item_id' => 1,
                'user_id' => 1,
                'content' => 'こちらにコメントが入ります。',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => 4,
                'user_id' => 2,
                'content' => '使いやすそうですね。',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}