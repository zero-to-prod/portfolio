<?php

namespace Middleware;

use App\Helpers\Routes;
use App\Http\Middleware\DenyUnpublishedPosts;
use App\Models\User;
use R;
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
        $this->get(R::read(post()))->assertNotFound();
    }

    /**
     * @test
     * @see DenyUnpublishedPosts
     */
    public function denies_nonexistent_posts(): void
    {
        $this->get(route_as(Routes::read, 'bogus post'))->assertNotFound();
    }

    /**
     * @test
     * @see DenyUnpublishedPosts
     */
    public function allows_published_posts(): void
    {
        User::factory()->create();
        $post = post_f()->published()->create();

        $this->get(R::read($post))->assertOk();
    }
}
