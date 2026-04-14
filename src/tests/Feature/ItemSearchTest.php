<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemSearchTest extends TestCase
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
    public function test_items_can_be_searched_by_partial_match(): void
    {
        $this->seed();
    $response = $this->get('/?keyword=タン');

    $response->assertStatus(200);
    $response->assertSee('タンブラー');
    $response->assertDontSee('ショルダーバッグ');
    }

    public function test_search_keyword_is_retained_on_mylist_page(): void
    {
    $this->loginUser();
    $response = $this->get('/?keyword=タン');

    $response->assertStatus(200);
    $response->assertSee('?tab=mylist&amp;keyword=タン', false);

    $response = $this->get('/?tab=mylist&keyword=タン');

    $response->assertStatus(200);
    $response->assertSee('value="タン"', false);
    }
}

