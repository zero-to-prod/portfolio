<?php

namespace Middleware;

use App\Http\Middleware\PostViewCounter;
use App\Models\View;
use R;
use Tests\Support\GetRouteList;
use Tests\TestCase;

class PostViewCounterTest extends TestCase
{
    use GetRouteList;

    /**
     * @test
     * @see PostViewCounter
     */
    public function increments_view_count(): void
    {
        $post = post_f()->published()->create();

        $this->get(R::read($post));

        $post->refresh();
        self::assertEquals(1, $post->views);
        self::assertEquals(1, $post->views()->count());
        /** @var View $view */
        $view = $post->views()->first();
        self::assertEquals($post->id, $view->post_id);
        self::assertNotNull($view->ip);
        self::assertNotNull($view->user_agent);
        self::assertNotNull($view->locale);
    }

    /**
     * @test
     * @see PostViewCounter
     */
    public function increments_view_count_2_times(): void
    {
        $post = post_f()->published()->create();

        $this->get(R::read($post));
        $this->get(R::read($post));

        $post->refresh();
        self::assertEquals(2, $post->views);
        self::assertEquals(2, $post->views()->count());
    }
    /**
     * @test
     * @see PostViewCounter
     */
    public function does_not_increment_count_for_incorrect_routes(): void
    {
        $post = post_f()->published()->create();

        $this->get(R::admin_post_edit($post));

        $post->refresh();
        self::assertEquals(0, $post->views);
        self::assertEquals(0, $post->views()->count());
    }
}
