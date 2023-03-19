<?php

namespace Tests\Feature\Login;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\AuthTestCase;

class LoginIndexTest extends AuthTestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function ok(): void
    {
        $this->get(to()->web->login->index())->assertOk();
    }
}
