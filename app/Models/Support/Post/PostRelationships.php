<?php

namespace App\Models\Support\Post;

use App\Models\Author;
use App\Models\File;
use App\Models\View;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait PostRelationships
{
    public const tags = 'tags';
    public const authors = 'authors';

    public const file = 'file';

    public function file(): HasOne
    {
        return $this->hasOne(File::class, File::id, self::file_id);
    }

    public function views(): HasMany
    {
        return $this->hasMany(View::class);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }
}
