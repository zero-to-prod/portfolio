<?php

namespace App\Models\Support\Post;

use Illuminate\Database\Eloquent\Builder;

trait PostScopes
{
    public const published = 'published';
    protected static function publishedScope(): \Closure
    {
        return static function (Builder $builder) {
            $builder->whereNotNull(self::published_at);
        };
    }
}