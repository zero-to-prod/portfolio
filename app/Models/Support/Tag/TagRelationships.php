<?php

namespace App\Models\Support\Tag;

use App\Models\File;
use App\Models\Post;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait TagRelationships
{
    public const posts = 'posts';
    public const file = 'file';

    public function file(): HasOne
    {
        return $this->hasOne(File::class, File::id, self::file_id);
    }

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }
}
