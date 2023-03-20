<?php

namespace Register;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VerificationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see routes/web.php
     */
    public function ok(): void
    {
        $this->get(temp_signed_route(to()->register->verification))->assertOk();
    }

    /**
     * @test
     * @see routes/web.php
     */
    public function requires_signed_url(): void
    {
        $this->getAs(to()->register->verification())->assertForbidden();
    }
}
