<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PurchasePaymentMethodTest extends TestCase
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

    public function test_default_payment_method_is_displayed_on_purchase_page(): void
{
    $this->loginUser();

    $response = $this->get('/purchase/8');

    $response->assertStatus(200);
    $response->assertSee('支払い方法');
    $response->assertSee('コンビニ支払い');
}

public function test_selected_payment_method_is_applied_when_purchasing(): void
{
    $user = $this->loginUser();

    $response = $this->post('/purchase/8/checkout', [
        'payment_method' => 'card',
        'postal_code' => '100-0001',
        'address' => '東京都千代田区千代田1-1',
    ]);

    $response->assertSessionHasNoErrors();
    $response->assertStatus(302);

    $this->assertDatabaseHas('purchases', [
        'user_id' => $user->id,
        'item_id' => 8,
        'payment_method' => 'card',
    ]);
}
}