<?php

namespace Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PrivacyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see To::privacy()
     */
    public function ok(): void
    {
        $this->get(to()->privacy())->assertOk();
    }
}
