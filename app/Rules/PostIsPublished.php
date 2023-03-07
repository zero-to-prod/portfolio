<?php

namespace App\Rules;

use App\Models\Post;
use App\Rules\Support\BusinessRule;
use App\Rules\Support\EvaluatesBusinessRule;

/**
 * @method static evaluate(Post $post)
 */
class PostIsPublished implements BusinessRule
{
    use EvaluatesBusinessRule;

    public function __construct(private readonly Post $post)
    {
    }

    /**
     * @see PostIsPublishedTest
     */
    public function handle(): bool
    {
        return $this->post->published_at !== null;
    }
}
