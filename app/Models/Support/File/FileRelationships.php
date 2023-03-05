<?php

namespace App\Models\Support\File;

use App\Models\Author;
use App\Models\Post;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait FileRelationships
{
    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'fileable');
    }

    public function authors(): MorphToMany
    {
        return $this->morphedByMany(Author::class, 'fileable');
    }
}
