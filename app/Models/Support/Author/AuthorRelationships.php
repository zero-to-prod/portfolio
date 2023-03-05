<?php

namespace App\Models\Support\Author;

use App\Models\Post;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait AuthorRelationships
{
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }
}
