<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\URL;

class EmailVerificationFlowTest extends TestCase
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

    public function test_verification_email_is_sent_after_register(): void
    {
        Notification::fake();

        $response = $this->post('/register', [
            'name' => '山田花子',
            'email' => 'hanako@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $user = User::where('email', 'hanako@example.com')->first();

        $this->assertNotNull($user);
        $this->assertNull($user->email_verified_at);

        Notification::assertSentTo($user, VerifyEmail::class);

        $response->assertRedirect();
    }

    public function test_unverified_user_can_view_email_verification_notice_page(): void
{
    $user = User::factory()->create([
        'email_verified_at' => null,
    ]);

    $this->actingAs($user);

    $response = $this->get('verify-email');

    $response->assertStatus(200);
    $response->assertSee('認証はこちらから');
}

public function test_user_is_redirected_to_profile_edit_page_after_email_verification(): void
{
    $user = User::factory()->create([
        'email_verified_at' => null,
    ]);

    $this->actingAs($user);

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        [
            'id' => $user->id,
            'hash' => sha1($user->email),
        ]
    );

    $response = $this->get($verificationUrl);

    $user->refresh();

    $this->assertNotNull($user->email_verified_at);
    $response->assertRedirect('/mypage/profile');
}
}
