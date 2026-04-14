<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LikeToggleTest extends TestCase
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

    public function test_authenticated_user_can_like_an_item(): void
{
    $user = $this->loginUser();

    $response = $this->post('/item/8/like');

    $response->assertStatus(302);

    $this->assertDatabaseHas('likes', [
        'user_id' => $user->id,
        'item_id' => 8,
    ]);
}

public function test_authenticated_user_can_unlike_an_item(): void
{
    $user = $this->loginUser();

    $this->post('/item/8/like')->assertStatus(302);

    $this->assertDatabaseHas('likes', [
        'user_id' => $user->id,
        'item_id' => 8,
    ]);

    $response = $this->delete('/item/8/like');

    $response->assertStatus(302);

    $this->assertDatabaseMissing('likes', [
        'user_id' => $user->id,
        'item_id' => 8,
    ]);
}
}