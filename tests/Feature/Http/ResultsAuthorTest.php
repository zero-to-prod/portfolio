<?php

namespace Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResultsAuthorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see To::resultsAuthor()
     */
    public function ok(): void
    {
        $this->get(to()->resultsAuthor())->assertOk();
    }

    /**
     * @test
     * @see To::resultsAuthor()
     */
    public function ok_with_author(): void
    {
        $author = post_f()->published()->create()->authors()->first();
        $this->get(to()->resultsAuthor($author))->assertOk()->assertSee($author->name);
    }
}
