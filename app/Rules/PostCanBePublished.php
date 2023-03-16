<?php

namespace App\Rules;

use App\Models\Post;
use App\Rules\Support\BusinessRule;
use App\Rules\Support\EvaluatesBusinessRule;

/**
 * @method static evaluate(Post $post)
 */
class PostCanBePublished implements BusinessRule
{
    use EvaluatesBusinessRule;

    public function __construct(private readonly Post $post)
    {
    }

    /**
     * @see PostCanBePublishedTest
     */
    public function handle(): bool
    {
        return $this->post->title !== null
            && $this->post->slug !== null
            && $this->post->body !== null
            && $this->post->file !== null;
    }
}
