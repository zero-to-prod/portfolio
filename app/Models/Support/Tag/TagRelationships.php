<?php

namespace App\Models\Support\Tag;

use App\Models\Post;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait TagRelationships
{
    public const posts = 'posts';

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }
}
