<?php

namespace Tests\Feature\Auth;

use App\Http\Controllers\LoginStoreRedirect;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get(to()->guest->admin_login->index());

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->post(to()->guest->admin_login->store(), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirectHome();
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post(to()->guest->admin_login->store(), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    /**
     * @test
     * @see LoginStoreRedirect
     */
    public function login(): void
    {
        $response = $this->post(to()->web->login->store(), [
            LoginRequest::email => user()->email,
            LoginRequest::password => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirectAs(LoginStoreRedirect::redirect_as);
    }

    /**
     * @test
     * @see LoginStoreRedirect
     */
    public function login_rejected(): void
    {
        $user = user();
        $this->post(to()->web->login->store(), [
            LoginRequest::email => $user->email,
            LoginRequest::password => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
