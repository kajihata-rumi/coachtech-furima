<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
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
    public function test_authenticated_user_can_add_a_comment(): void
{
    $user = $this->loginUser();

    $response = $this->post('/item/8/comment', [
        'content' => 'テストコメントです',
    ]);

    $response->assertStatus(302);
    $response->assertSessionHasNoErrors();

    $this->assertDatabaseHas('comments', [
        'user_id' => $user->id,
        'item_id' => 8,
        'content' => 'テストコメントです',
    ]);
}
public function test_guest_user_cannot_add_a_comment(): void
{
    $this->seed();

    $response = $this->post('/item/8/comment', [
        'content' => 'ゲストコメントです',
    ]);

    $response->assertStatus(302);
    $response->assertRedirect('/login');

    $this->assertDatabaseMissing('comments', [
        'item_id' => 8,
        'content' => 'ゲストコメントです',
    ]);
}
public function test_comment_is_required(): void
{
    $this->loginUser();

    $response = $this->from('/item/8')->post('/item/8/comment', [
        'content' => '',
    ]);

    $response->assertStatus(302);
    $response->assertSessionHasErrors(['content']);
}

public function test_comment_must_not_exceed_255_characters(): void
{
    $this->loginUser();

    $response = $this->from('/item/8')->post('/item/8/comment', [
        'content' => str_repeat('あ', 256),
    ]);

    $response->assertStatus(302);
    $response->assertSessionHasErrors(['content']);
}

}