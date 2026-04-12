<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileUpdateTest extends TestCase
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

    public function test_profile_edit_page_displays_current_user_information(): void
{
    $user = User::factory()->create([
        'email_verified_at' => now(),
        'name' => '山田花子',
        'postal_code' => '123-4567',
        'address' => '東京都渋谷区1-1-1',
    ]);

    $this->actingAs($user);

    $response = $this->get('/mypage/profile');

    $response->assertStatus(200);
    $response->assertSee('山田花子');
    $response->assertSee('123-4567');
    $response->assertSee('東京都渋谷区1-1-1');
}

public function test_guest_cannot_view_profile_edit_page(): void
{
    $response = $this->get('/mypage/profile');

    $response->assertRedirect('/login');
}
}
