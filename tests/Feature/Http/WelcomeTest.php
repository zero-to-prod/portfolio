<?php

namespace Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WelcomeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see To::welcome()
     */
    public function ok(): void
    {
        $this->get(to()->welcome())->assertOk();
    }
}
