<?php

namespace App\Models;

use App\Helpers\CacheKeys;
use App\Helpers\Relations;
use App\Helpers\Tags;
use App\Models\Support\HasRules;
use App\Models\Support\IdColumn;
use App\Models\Support\Polymorphic\HasFiles;
use App\Models\Support\Tag\TagColumns;
use App\Models\Support\Tag\TagRelationships;
use App\Models\Support\Tag\TagRules;
use App\Models\Support\TimeStampColumns;
use Cache;
use DB;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Support\Collection;

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

    protected $fillable = [self::name, self::slug, self::type, self::order_column];

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

    public static function mostViewed(int|null $limit = 20): Collection
    {
        return Cache::rememberAs(CacheKeys::most_viewed, 60 * 60, static function () use ($limit) {
            return self::query()
                ->select('tags.id', 'tags.name', 'tags.slug', DB::raw('SUM(posts.views) as total_views'))
                ->with('files')
                ->leftJoin('taggables', function ($join) {
                    $join->on('tags.id', '=', 'taggables.tag_id')
                        ->where('taggables.taggable_type', Relations::post->value);
                })
                ->leftJoin('posts', 'taggables.taggable_id', '=', 'posts.id')
                ->where('tags.type', Tags::post->value)
                ->groupBy('tags.id', 'tags.name', 'tags.slug')
                ->orderByDesc('total_views')
                ->limit($limit)
                ->get();
        });
    }

    public function logo(): ?File
    {
        return $this->files()->whereHas(File::tags, function ($builder) {
            $builder->where(Tag::name . '->en', Tags::logo->value);
        })->first();
    }

    public function hasLogo(): bool
    {
        return $this->logo() !== null;
    }

    public function isMissingLogo(): bool
    {
        return $this->logo() === null;
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
