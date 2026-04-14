<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Item;

class MyListIndexTest extends TestCase
{
    use RefreshDatabase;

    protected function loginUser(): User
{
    $this->seed();

    /** @var User $user */
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    $this->actingAs($user);

    return $user;
}

    public function test_authenticated_user_can_view_liked_items_on_mylist_page(): void
{
    $user = $this->loginUser();

    $likedItem = Item::findOrFail(8);

    $this->post("/item/{$likedItem->id}/like")->assertStatus(302);

    $response = $this->get('/?tab=mylist');

    $response->assertStatus(200);
    $response->assertSee($likedItem->name);
}

public function test_only_liked_items_are_displayed_on_mylist_page(): void
{
    $user = $this->loginUser();

    $likedItem = Item::findOrFail(8);
    $unlikedItem = Item::findOrFail(7);

    $this->post("/item/{$likedItem->id}/like")->assertStatus(302);

    $response = $this->get('/?tab=mylist');

    $response->assertStatus(200);
    $response->assertSee($likedItem->name);
    $response->assertDontSee($unlikedItem->name);
}
}
