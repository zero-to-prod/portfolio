<?php

namespace Middleware;

use App\Http\Middleware\DenyUnpublishedPosts;
use App\Models\Post;
use App\Models\User;
use Tests\Support\GetRouteList;
use Tests\TestCase;

class DenyUnpublishedPostsTest extends TestCase
{
    use GetRouteList;

    /**
     * @test
     * @see DenyUnpublishedPosts
     */
    public function denies_unpublished_posts(): void
    {
        $this->get(to()->web->read(post()))->assertNotFound();
    }

    /**
     * @test
     * @see DenyUnpublishedPosts
     */
    public function denies_nonexistent_posts(): void
    {
        $this->get(to()->web->read(post_f()->make([Post::slug => 'bogus'])))->assertNotFound();
    }

    /**
     * @test
     * @see DenyUnpublishedPosts
     */
    public function allows_published_posts(): void
    {
        User::factory()->create();
        $post = post_f()->published()->create();

        $this->get(to()->web->read($post))->assertOk();
    }
}
