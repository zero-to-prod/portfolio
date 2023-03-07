<?php

namespace App\Models\Support;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

trait SlugColumn
{
    use HasSlug;

    public const slug = 'slug';

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(self::name)
            ->saveSlugsTo(self::slug)
            ->doNotGenerateSlugsOnUpdate();
    }
}
