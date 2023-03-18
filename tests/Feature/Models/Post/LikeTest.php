<?php

namespace Tests\Feature\Models\Post;

use App\Models\File;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class LikeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see Post::like()
     */
    public function like(): void
    {
        $this->be(user());
        $post = post();

        $post->like();

        $this->assertEquals(1, $post->likes);
        $this->assertEquals(0, $post->dislikes);
        $this->assertEquals(1, $post->reactions()->count());
        $this->assertEquals(1, $post->reactions()->first()->like);
    }

    /**
     * @test
     * @see Post::like()
     */
    public function like_dislike(): void
    {
        $this->be(user());
        $post = post();

        $post->like();
        $post->dislike();

        $this->assertEquals(0, $post->likes);
        $this->assertEquals(1, $post->dislikes);
        $this->assertEquals(1, $post->reactions()->count());
        $this->assertEquals(-1, $post->reactions()->first()->like);
    }

    /**
     * @test
     * @see Post::like()
     */
    public function like_already_liked(): void
    {
        $this->be(user());
        $post = post();

        $post->like();

        $this->assertEquals(1, $post->likes);
        $this->assertEquals(0, $post->dislikes);
        $this->assertEquals(1, $post->reactions()->count());
        $this->assertEquals(1, $post->reactions()->first()->like);

        $post->like();

        $this->assertEquals(1, $post->likes);
        $this->assertEquals(0, $post->dislikes);
        $this->assertEquals(1, $post->reactions()->count());
        $this->assertEquals(1, $post->reactions()->first()->like);
    }
}
