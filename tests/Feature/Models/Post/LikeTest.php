<?php

namespace Tests\Feature\Models\Post;

use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LikeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see Post::like()
     */
    public function add_likes_from_two_different_users(): void
    {
        $post = post();
        $user1 = user();
        $this->be($user1);

        $post->like();

        self::assertEquals(1, $post->likes);
        self::assertEquals(1, $post->reactions()->where(Reaction::user_id, $user1->id)->count());
        /** @var Reaction $reaction */
        $reaction = $post->reactions()->where(Reaction::user_id, $user1->id)->first();
        self::assertEquals(1, $reaction->like);
        self::assertEquals($user1->id, $reaction->user_id);

        /* User 2 */
        $user2 = user();
        $this->be($user2);

        $post->like();

        self::assertEquals(2, $post->likes);
        self::assertEquals(1, $post->reactions()->where(Reaction::user_id, $user2->id)->count());
        /** @var Reaction $reaction */
        $reaction = $post->reactions()->where(Reaction::user_id, $user2->id)->first();
        self::assertEquals(1, $reaction->like);
        self::assertEquals($user2->id, $reaction->user_id);
        self::assertEquals(2, $post->reactions()->count());

        /* Decrement likes */
        $post->like();

        self::assertEquals(1, $post->likes);
        self::assertEquals(1, $post->reactions()->where(Reaction::user_id, $user2->id)->count());
        /** @var Reaction $reaction */
        $reaction = $post->reactions()->where(Reaction::user_id, $user2->id)->first();
        self::assertEquals(0, $reaction->like);
        self::assertEquals($user2->id, $reaction->user_id);
        self::assertEquals(2, $post->reactions()->count());

        /* Decrement likes */
        $this->be($user1);
        $post->like();

        self::assertEquals(0, $post->likes);
        self::assertEquals(1, $post->reactions()->where(Reaction::user_id, $user1->id)->count());
        /** @var Reaction $reaction */
        $reaction = $post->reactions()->where(Reaction::user_id, $user1->id)->first();
        self::assertEquals(0, $reaction->like);
        self::assertEquals($user1->id, $reaction->user_id);
    }

    /**
     * @test
     * @see Post::dislike()
     */
    public function add_dislikes_from_two_different_users(): void
    {
        $post = post();
        $user1 = user();
        $this->be($user1);

        $post->dislike();

        self::assertEquals(1, $post->dislikes);
        self::assertEquals(1, $post->reactions()->where(Reaction::user_id, $user1->id)->count());
        /** @var Reaction $reaction */
        $reaction = $post->reactions()->where(Reaction::user_id, $user1->id)->first();
        self::assertEquals(-1, $reaction->like);
        self::assertEquals($user1->id, $reaction->user_id);

        /* User 2 */
        $user2 = user();
        $this->be($user2);

        $post->dislike();

        self::assertEquals(2, $post->dislikes);
        self::assertEquals(1, $post->reactions()->where(Reaction::user_id, $user2->id)->count());
        /** @var Reaction $reaction */
        $reaction = $post->reactions()->where(Reaction::user_id, $user2->id)->first();
        self::assertEquals(-1, $reaction->like);
        self::assertEquals($user2->id, $reaction->user_id);
        self::assertEquals(2, $post->reactions()->count());

        /* Decrement likes */
        $post->dislike();

        self::assertEquals(1, $post->dislikes);
        self::assertEquals(1, $post->reactions()->where(Reaction::user_id, $user2->id)->count());
        /** @var Reaction $reaction */
        $reaction = $post->reactions()->where(Reaction::user_id, $user2->id)->first();
        self::assertEquals(0, $reaction->like);
        self::assertEquals($user2->id, $reaction->user_id);
        self::assertEquals(2, $post->reactions()->count());

        /* Decrement likes */
        $this->be($user1);
        $post->dislike();

        self::assertEquals(0, $post->dislikes);
        self::assertEquals(1, $post->reactions()->where(Reaction::user_id, $user1->id)->count());
        /** @var Reaction $reaction */
        $reaction = $post->reactions()->where(Reaction::user_id, $user1->id)->first();
        self::assertEquals(0, $reaction->like);
        self::assertEquals($user1->id, $reaction->user_id);
    }

    /**
     * @test
     * @see Post::like()
     * @see Post::dislike()
     */
    public function like_dislike(): void
    {
        $post = post();
        $user1 = user();
        $this->be($user1);

        $post->like();
        $post->dislike();

        self::assertEquals(0, $post->likes);
        self::assertEquals(1, $post->dislikes);
        self::assertEquals(1, $post->reactions()->where(Reaction::user_id, $user1->id)->count());
        /** @var Reaction $reaction */
        $reaction = $post->reactions()->where(Reaction::user_id, $user1->id)->first();
        self::assertEquals(-1, $reaction->like);
        self::assertEquals($user1->id, $reaction->user_id);
    }

    /**
     * @test
     * @see Post::like()
     * @see Post::dislike()
     */
    public function dislike_like(): void
    {
        $post = post();
        $user1 = user();
        $this->be($user1);

        $post->dislike();
        $post->like();

        self::assertEquals(1, $post->likes);
        self::assertEquals(0, $post->dislikes);
        self::assertEquals(1, $post->reactions()->where(Reaction::user_id, $user1->id)->count());
        /** @var Reaction $reaction */
        $reaction = $post->reactions()->where(Reaction::user_id, $user1->id)->first();
        self::assertEquals(1, $reaction->like);
        self::assertEquals($user1->id, $reaction->user_id);
    }


    /**
     * @test
     * @see Post::like()
     * @see Post::dislike()
     */
    public function dislike_like_like(): void
    {
        $post = post();
        $user1 = user();
        $this->be($user1);

        $post->dislike();
        $post->like();
        $post->like();

        self::assertEquals(0, $post->likes);
        self::assertEquals(0, $post->dislikes);
        self::assertEquals(1, $post->reactions()->where(Reaction::user_id, $user1->id)->count());
        /** @var Reaction $reaction */
        $reaction = $post->reactions()->where(Reaction::user_id, $user1->id)->first();
        self::assertEquals(0, $reaction->like);
        self::assertEquals($user1->id, $reaction->user_id);
    }

    /**
     * @test
     * @see Post::like()
     * @see Post::dislike()
     */
    public function like_dislike_dislike(): void
    {
        $post = post();
        $user1 = user();
        $this->be($user1);

        $post->like();
        $post->dislike();
        $post->dislike();

        self::assertEquals(0, $post->likes);
        self::assertEquals(0, $post->dislikes);
        self::assertEquals(1, $post->reactions()->where(Reaction::user_id, $user1->id)->count());
        /** @var Reaction $reaction */
        $reaction = $post->reactions()->where(Reaction::user_id, $user1->id)->first();
        self::assertEquals(0, $reaction->like);
        self::assertEquals($user1->id, $reaction->user_id);
    }
}
