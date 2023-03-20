<?php

namespace Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReadTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see To::read()
     */
    public function ok(): void
    {
        $post = post_f()->published()->create();
        $this->get(to()->read($post))->assertOk();
    }
}
