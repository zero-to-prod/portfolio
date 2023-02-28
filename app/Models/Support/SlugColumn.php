<?php

namespace App\Models\Support;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

trait SlugColumn
{
    use HasSlug;

    public const slug = 'slug';

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(self::name)
            ->saveSlugsTo('slug');
    }
}
