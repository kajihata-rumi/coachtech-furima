<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemListTest extends TestCase
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

    public function test_item_list_is_displayed(): void
    {
        $this->seed();

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('腕時計');
        $response->assertSee('HDD');
        $response->assertSee('マイク');
        $response->assertSee('メイクセット');
    }

    public function test_sold_label_is_displayed_for_purchased_items(): void
    {
        $this->seed();

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Sold');
    }

    public function test_own_items_are_not_displayed_in_item_list_for_logged_in_user(): void
    {
        $this->loginUser();

        $response = $this->get('/');

        $response->assertStatus(200);

        // user_id=1 の出品商品は表示されない
        $response->assertDontSee('腕時計');
        $response->assertDontSee('HDD');
        $response->assertDontSee('玉ねぎ3束');
        $response->assertDontSee('革靴');
        $response->assertDontSee('ノートPC');

        // user_id=2 の出品商品は表示される
        $response->assertSee('マイク');
        $response->assertSee('ショルダーバッグ');
        $response->assertSee('タンブラー');
        $response->assertSee('コーヒーミル');
        $response->assertSee('メイクセット');
    }
}