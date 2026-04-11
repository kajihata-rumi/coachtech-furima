<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemDetailTest extends TestCase
{
    use RefreshDatabase;

    protected function loginUser(): User
    {
        $this->seed();
        /** @var User $user */
        $user = User::findOrFail(1);

        $this->actingAs($user);

        return $user;
    }

    public function test_required_item_detail_information_is_displayed(): void
    {
        $this->seed();

        $response = $this->get('/item/1');
        $response->assertStatus(200);

        // 商品情報
        $response->assertSee('腕時計');
        $response->assertSee('Rolax');
        $response->assertSee('15,000');
        $response->assertSee('スタイリッシュなデザインのメンズ腕時計');
        $response->assertSee('良好');

        // 画像
        $response->assertSee('watch.jpg');

        // いいね数・コメント数
        $response->assertSee('1');
        $response->assertSee('コメント(2)');

        // コメント情報
        $response->assertSee('testuser1');
        $response->assertSee('素敵ですね。');
        $response->assertSee('testuser2');
        $response->assertSee('高級感があっていいですね。');
    }

    public function test_multiple_categories_are_displayed(): void
    {
        $this->seed();

        $response = $this->get('/item/1');

        $response->assertStatus(200);
        $response->assertSee('メンズ');
        $response->assertSee('アクセサリー');
    }
}