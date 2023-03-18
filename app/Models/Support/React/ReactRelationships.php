<?php

namespace App\Models\Support\React;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait ReactRelationships
{

    public const posts = 'posts';
    public const authors = 'authors';
    public const tags = 'tags';

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'reactable');
    }

    public function users(): MorphToMany
    {
        return $this->morphedByMany(User::class, 'reactable');
    }
}
