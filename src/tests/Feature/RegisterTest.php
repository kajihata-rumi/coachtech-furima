<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_name_is_required_for_registration()
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors(['name']);
    }

    public function test_email_is_required_for_registration()
{
    $response = $this->post('/register', [
        'name' => 'testuser',
        'email' => '',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertSessionHasErrors(['email']);
}

public function test_password_is_required_for_registration()
{
    $response = $this->post('/register', [
        'name' => 'testuser',
        'email' => 'test@example.com',
        'password' => '',
        'password_confirmation' => '',
    ]);

    $response->assertSessionHasErrors(['password']);
}

public function test_password_must_be_at_least_8_characters_for_registration()
{
    $response = $this->post('/register', [
        'name' => 'testuser',
        'email' => 'test@example.com',
        'password' => 'pass',
        'password_confirmation' => 'pass',
    ]);

    $response->assertSessionHasErrors(['password']);
}

public function test_password_confirmation_must_match_for_registration()
{
    $response = $this->post('/register', [
        'name' => 'testuser',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'different-password',
    ]);

    $response->assertSessionHasErrors(['password']);
}

public function test_user_can_register_successfully()
{
    $response = $this->post('/register', [
        'name' => 'testuser',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertStatus(302);
    $this->assertAuthenticated();

    $this->assertDatabaseHas('users', [
        'name' => 'testuser',
        'email' => 'test@example.com',
    ]);
}
}