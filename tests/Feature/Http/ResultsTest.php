<?php

namespace Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResultsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see To::results()
     */
    public function ok(): void
    {
        $this->get(to()->results())->assertOk();
    }

    /**
     * @test
     * @see To::results()
     */
    public function ok_with_tag(): void
    {
        $tag = tag();
        $this->get(to()->results($tag))->assertOk()->assertSee($tag->name);
    }
}
