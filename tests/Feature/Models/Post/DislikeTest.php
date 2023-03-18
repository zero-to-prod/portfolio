<?php

namespace Models\Post;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DislikeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see Post::like()
     */
    public function dislike(): void
    {
        $this->be(user());
        $post = post();

        $post->dislike();

        $this->assertEquals(1, $post->dislikes);
        $this->assertEquals(1, $post->reactions()->count());
        $this->assertEquals(-1, $post->reactions()->first()->like);

    }

    /**
     * @test
     * @see Post::like()
     */
    public function dislike_already_disliked(): void
    {
        $this->be(user());
        $post = post();

        $post->dislike();

        $this->assertEquals(1, $post->dislikes);
        $this->assertEquals(1, $post->reactions()->count());
        $this->assertEquals(-1, $post->reactions()->first()->like);


        $post->dislike();

        $this->assertEquals(1, $post->dislikes);
        $this->assertEquals(1, $post->reactions()->count());
        $this->assertEquals(-1, $post->reactions()->first()->like);

    }
}
