<?php

namespace Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResultsTopicsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see To::resultsTopics()
     */
    public function ok(): void
    {
        $this->get(to()->resultsTopics())->assertOk();
    }
}
