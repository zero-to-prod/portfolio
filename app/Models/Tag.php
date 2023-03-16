<?php

namespace App\Models;

use App\Helpers\Tags;
use App\Helpers\TagTypes;
use App\Models\Support\HasRules;
use App\Models\Support\IdColumn;
use App\Models\Support\Polymorphic\HasFiles;
use App\Models\Support\Tag\TagColumns;
use App\Models\Support\Tag\TagRelationships;
use App\Models\Support\Tag\TagRules;
use App\Models\Support\TimeStampColumns;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;

/**
 * @mixin IdeHelperTag
 */
class Tag extends \Spatie\Tags\Tag implements HasRules
{
//    use Cachable;
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

        return $query->where('type', (int)$type)->ordered();
    }
    public static function bootHasSlug(): void
    {
        static::saving(static function (Tag $model) {
            collect($model->getTranslatedLocales(self::name))
                ->each(function (string $locale) use ($model) {
                    if ($model->slug === null) {
                        return $model->setTranslation(
                            'slug',
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
        return self::withSum('posts', 'views')
            ->orderByDesc('posts_sum_views')
            ->withType(TagTypes::post->value)
            ->with('file');
    }

    public function logo(): ?File
    {
        return $this->files()->whereHas(File::tags, function ($builder) {
            $builder->where(Tag::name . '->en', Tags::logo->value);
        })->first();
    }

    public function relatedPosts(int|null $limit = null): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'taggable')
            ->with(Post::authors)
            ->orderByDesc(Post::views)
            ->limit($limit);
    }

    public function getRelatedPosts(array|int|string|null $exclude_ids = [], int|null $limit = null): Collection
    {
        $posts = $this->posts()
            ->with(Post::authors)
            ->whereNotIn(Post::id, is_array($exclude_ids) ? $exclude_ids : [$exclude_ids])
            ->orderByDesc(Post::views)
            ->get();

        $latest = $posts->keyBy(Post::id)->filter(fn(Post $post) => $post->original_publish_date->isToday());

        return $latest->union($posts)->take($limit);
    }
}
