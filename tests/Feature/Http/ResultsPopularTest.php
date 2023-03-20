<?php

namespace Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResultsPopularTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see To::resultsPopular()
     */
    public function ok(): void
    {
        $this->get(to()->resultsPopular())->assertOk();
    }
}
