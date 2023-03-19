<?php

namespace Register;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterSuccessTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see routes/web.php
     */
    public function ok(): void
    {
        $this->get(temp_signed_route(to()->web->register->success))->assertOk();
    }

    /**
     * @test
     * @see routes/web.php
     */
    public function requires_signed_url(): void
    {
        $this->getAs(to()->web->register->success())->assertForbidden();
    }
}
