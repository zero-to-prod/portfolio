<?php

namespace Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see To::logo()
     */
    public function ok(): void
    {
        $this->post(to()->logo())->assertOk();
    }
}
