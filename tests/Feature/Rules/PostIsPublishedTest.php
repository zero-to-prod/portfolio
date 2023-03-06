<?php

namespace Tests\Feature\Rules;

use App\Rules\PostIsPublished;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostIsPublishedTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see PostIsPublished
     */
    public function post_is_published(): void
    {
        $post = post_f()->published()->create();

        $this->assertTrue(PostIsPublished::evaluate($post));

    }

    /**
     * @test
     * @see PostIsPublished
     */
    public function post_is_not_published(): void
    {
        $this->assertFalse(PostIsPublished::evaluate(post()));
    }
}
