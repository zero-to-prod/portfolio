<?php

namespace App\Models;

use App\Helpers\TagTypes;
use App\Models\Support\HasRules;
use App\Models\Support\IdColumn;
use App\Models\Support\Polymorphic\HasFiles;
use App\Models\Support\Tag\TagColumns;
use App\Models\Support\Tag\TagRelationships;
use App\Models\Support\Tag\TagRules;
use App\Models\Support\TimeStampColumns;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin IdeHelperTag
 */
class Tag extends \Spatie\Tags\Tag implements HasRules
{
    use Cachable;
    use IdColumn;
    use TimeStampColumns;
    use TagColumns;
    use TagRules;
    use TagRelationships;
    use HasFiles;

    protected $fillable = [self::file_id, self::name, self::slug, self::type, self::order_column];
    protected $casts = [self::type => 'integer'];

    public function scopeWithType(Builder $query, string $type = null): Builder
    {
        if (is_null($type)) {
            return $query;
        }

        return $query->where(self::type, (int)$type)->ordered();
    }

    public static function bootHasSlug(): void
    {
        static::saving(static function (Tag $model) {
            collect($model->getTranslatedLocales(self::name))
                ->each(function (string $locale) use ($model) {
                    if ($model->slug === null) {
                        return $model->setTranslation(
                            self::slug,
                            $locale,
                            $model->generateSlug($locale)
                        );
                    }

                    return $model;
                });
        });
    }

    public function scopeMostViewed(): Builder|Tag
    {
        return self::withSum(self::posts, Post::views)
            ->orderByDesc('posts_sum_views')
            ->withType(TagTypes::post->value)
            ->with(self::file);
    }
}
