<?php

namespace App\Models\Support\Author;

use App\Models\File;
use App\Models\Post;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait AuthorRelationships
{
    public const file = 'file';
    public const posts = 'posts';

    public function file(): HasOne
    {
        return $this->hasOne(File::class, File::id, self::file_id);
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }
}
