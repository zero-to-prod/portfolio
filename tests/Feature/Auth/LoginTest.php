<?php

namespace Auth;

use App\Http\Controllers\Auth\Login;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see Login
     */
    public function login(): void
    {
        $response = $this->post(to()->web->login->store(), [
            LoginRequest::email => user()->email,
            LoginRequest::password => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirectAs(Login::redirectUrl());
    }

    /**
     * @test
     * @see Login
     */
    public function login_rejected(): void
    {
        $this->post(to()->web->login->store(), [
            LoginRequest::email => user()->email,
            LoginRequest::password => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
