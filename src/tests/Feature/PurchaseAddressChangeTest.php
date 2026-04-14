<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PurchaseAddressChangeTest extends TestCase
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

    public function test_changed_shipping_address_is_reflected_on_purchase_page(): void
{
    $this->loginUser();

    $response = $this->post('/purchase/address/8', [
        'postal_code' => '150-0001',
        'address' => '東京都渋谷区神宮前1-2-3',
        'building' => 'テストマンション101',
    ]);

    $response->assertStatus(302);

    $response = $this->get('/purchase/8');

    $response->assertStatus(200);
    $response->assertSee('150-0001');
    $response->assertSee('東京都渋谷区神宮前1-2-3');
    $response->assertSee('テストマンション101');
}

public function test_changed_shipping_address_is_saved_with_purchase(): void
{
    $user = $this->loginUser();

    $this->post('/purchase/address/8', [
        'postal_code' => '150-0001',
        'address' => '東京都渋谷区神宮前1-2-3',
        'building' => 'テストマンション101',
    ])->assertStatus(302);

    $response = $this->post('/purchase/8/checkout', [
        'payment_method' => 'konbini',
        'postal_code' => '150-0001',
        'address' => '東京都渋谷区神宮前1-2-3',
        'building' => 'テストマンション101',
    ]);

    $response->assertSessionHasNoErrors();
    $response->assertStatus(302);

    $this->assertDatabaseHas('purchases', [
        'user_id' => $user->id,
        'item_id' => 8,
        'payment_method' => 'konbini',
        'postal_code' => '150-0001',
        'address' => '東京都渋谷区神宮前1-2-3',
        'building' => 'テストマンション101',
    ]);
}
}