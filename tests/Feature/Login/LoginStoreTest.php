<?php

namespace Login;

use App\Http\Controllers\Login\StoreRedirect;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginStoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see \App\Http\Controllers\Login\StoreRedirect
     */
    public function login(): void
    {
        $response = $this->post(to()->web->login->store(), [
            LoginRequest::email => user()->email,
            LoginRequest::password => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirectAs(StoreRedirect::redirect_as);
    }

    /**
     * @test
     * @see StoreRedirect
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
