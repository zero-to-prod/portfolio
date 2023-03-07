<?php

namespace App\Models\Support\Post;

use App\Models\Author;
use App\Models\View;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait PostRelationships
{
    public const tags = 'tags';
    public const authors = 'authors';

    public function views(): HasMany
    {
        return $this->hasMany(View::class);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }
}
