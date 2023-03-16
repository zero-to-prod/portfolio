<?php

namespace Rules;

use App\Models\Post;
use App\Rules\PostCanBePublished;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostCanBePublishedTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see PostCanBePublished
     */
    public function post_is_published(): void
    {
        $post = post_f()->published()->create();

        $this->assertTrue(PostCanBePublished::evaluate($post));
    }

    /**
     * @test
     * @see PostCanBePublished
     */
    public function missing_title(): void
    {
        $post = post_f([
            Post::title => null,
            Post::slug => 'slug',
            Post::body => 'body',
        ])->withFile()->make();

        $this->assertFalse(PostCanBePublished::evaluate($post));
    }

    /**
     * @test
     * @see PostCanBePublished
     */
    public function missing_slug(): void
    {
        $post = post_f([
            Post::title => 'title',
            Post::slug => null,
            Post::body => 'body',
        ])->withFile()->make();

        $this->assertFalse(PostCanBePublished::evaluate($post));
    }

    /**
     * @test
     * @see PostCanBePublished
     */
    public function missing_body(): void
    {
        $post = post_f([
            Post::title => 'title',
            Post::slug => 'slug',
            Post::body => null,
        ])->withFile()->make();

        $this->assertFalse(PostCanBePublished::evaluate($post));
    }

    /**
     * @test
     * @see PostCanBePublished
     */
    public function missing_featured_image(): void
    {
        $post = post_f([
            Post::title => 'title',
            Post::slug => 'slug',
            Post::body => 'body',
        ])->make();

        $this->assertFalse(PostCanBePublished::evaluate($post));
    }
}
