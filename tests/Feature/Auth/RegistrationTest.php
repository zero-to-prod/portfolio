<?php

namespace Tests\Feature\Auth;

use App\Helpers\AuthRoutes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->getAs(AuthRoutes::register);

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->postAs(AuthRoutes::register_store, [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirectHome();
    }
}
