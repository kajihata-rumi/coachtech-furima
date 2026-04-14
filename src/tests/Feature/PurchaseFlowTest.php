<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PurchaseFlowTest extends TestCase
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

    public function test_user_can_purchase_item_successfully(): void
    {
        $this->loginUser();

        $response = $this->post('/purchase/8/checkout', [
    'payment_method' => 'konbini',
    'postal_code' => '100-0001',
    'address' => '東京都千代田区千代田1-1',
]);

$response->assertSessionHasNoErrors();
$response->assertStatus(302);

$this->assertDatabaseHas('purchases', [
    'user_id' => 1,
    'item_id' => 8,
    'payment_method' => 'konbini',
]);
    }

    public function test_purchased_item_is_displayed_as_sold_in_item_list(): void
    {
        $this->loginUser();

        $this->post('/purchase/8/checkout', [
    'payment_method' => 'konbini',
    'postal_code' => '100-0001',
    'address' => '東京都千代田区千代田1-1',
])->assertSessionHasNoErrors();

        $this->assertDatabaseHas('purchases', [
            'user_id' => 1,
            'item_id' => 8,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('タンブラー');
        $response->assertSee('Sold');
    }

    public function test_purchased_item_is_added_to_profile_purchase_list(): void
    {
        $this->loginUser();

        $this->post('/purchase/8/checkout', [
    'payment_method' => 'konbini',
    'postal_code' => '100-0001',
    'address' => '東京都千代田区千代田1-1',
])->assertSessionHasNoErrors();

        $this->assertDatabaseHas('purchases', [
            'user_id' => 1,
            'item_id' => 8,
        ]);

        $response = $this->get('/mypage?page=buy');

        $response->assertStatus(200);
        $response->assertSee('タンブラー');
    }
}