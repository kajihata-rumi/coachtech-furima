<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Item;
use App\Models\Purchase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    protected function loginUser(): User
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user);

        return $user;
    }

    public function test_authenticated_user_can_view_profile_page(): void
{
    $user = $this->loginUser();

    $response = $this->get('/mypage');

    $response->assertStatus(200);
    $response->assertSee($user->name);
}

public function test_guest_cannot_view_profile_page(): void
{
    $response = $this->get('/mypage');

    $response->assertRedirect('/login');
}

public function test_user_listed_items_are_displayed_on_profile_page(): void
{
    $user = $this->loginUser();

    $myItem = Item::factory()->create([
        'user_id' => $user->id,
        'name' => '自分の出品商品',
        'description' => '自分の出品商品の説明',
        'price' => 1000,
        'condition_id' => 1,
    ]);

    $otherUser = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    $otherItem = Item::factory()->create([
        'user_id' => $otherUser->id,
        'name' => '他人の出品商品',
        'description' => '他人の出品商品の説明',
        'price' => 2000,
        'condition_id' => 1,
    ]);

    $response = $this->get('/mypage');

    $response->assertStatus(200);
    $response->assertSee('自分の出品商品');
    $response->assertDontSee('他人の出品商品');
}

public function test_user_purchased_items_are_displayed_on_profile_page(): void
{
    $user = $this->loginUser();

    $seller = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    $purchasedItem = Item::factory()->create([
        'user_id' => $seller->id,
        'name' => '自分が購入した商品',
        'description' => '購入した商品の説明',
        'price' => 3000,
        'condition_id' => 1,
    ]);

    Purchase::factory()->create([
    'user_id' => $user->id,
    'item_id' => $purchasedItem->id,
    'payment_method' => 'card',
    'postal_code' => '123-4567',
    'address' => '東京都渋谷区1-1-1',
    'building' => 'テストビル',
    'purchased_at' => now(),
]);

    $notPurchasedItem = Item::factory()->create([
        'user_id' => $seller->id,
        'name' => '購入していない商品',
        'description' => '未購入商品の説明',
        'price' => 4000,
        'condition_id' => 1,
    ]);

    $response = $this->get('/mypage?page=buy');

    $response->assertStatus(200);
    $response->assertSee('自分が購入した商品');
    $response->assertDontSee('購入していない商品');
}
}