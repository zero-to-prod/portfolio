<?php

namespace Tests\Feature\Login;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see Logout
     */
    public function logout(): void
    {
        $this->be(user());

        $this->post(to()->auth->logout())
            ->assertRedirect();
        $this->assertGuest();

        $this->get(to()->admin->dashboard())
            ->assertFound()
            ->assertRedirect();
    }
}
