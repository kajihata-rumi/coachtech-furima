<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    public function run()
    {
        DB::table('comments')->insert([
            [
                'item_id' => 1,
                'user_id' => 1,
                'content' => '素敵ですね。',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => 1,
                'user_id' => 2,
                'content' => '高級感があっていいですね。',
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
            [
                'item_id' => 6,
                'user_id' => 1,
                'content' => '音質が良さそうで気になります。',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}