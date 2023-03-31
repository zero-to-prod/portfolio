<?php

namespace Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsletterSuccessTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see To::newsletter_success()
     */
    public function ok(): void
    {
        $this->get(to()->newsletter_success())->assertOk();
    }
}
