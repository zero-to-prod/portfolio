<?php

namespace Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsletterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see To::newsletter()
     */
    public function ok(): void
    {
        $this->get(to()->newsletter())->assertOk();
    }
}
