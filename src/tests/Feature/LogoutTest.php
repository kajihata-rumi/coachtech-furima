<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
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

    public function test_authenticated_user_can_logout(): void
{
    $this->loginUser();

    $response = $this->post('/logout');

    $response->assertStatus(302);
    $this->assertGuest();
}
}