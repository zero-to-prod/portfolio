<?php

namespace App\Models;

use App\Helpers\Relations;
use App\Helpers\Tags;
use App\Models\Support\HasRules;
use App\Models\Support\IdColumn;
use App\Models\Support\Polymorphic\HasFiles;
use App\Models\Support\Tag\TagColumns;
use App\Models\Support\Tag\TagRelationships;
use App\Models\Support\Tag\TagRules;
use App\Models\Support\TimeStampColumns;
use DB;
use Illuminate\Support\Collection;

/**
 * @mixin IdeHelperTag
 */
class Tag extends \Spatie\Tags\Tag implements HasRules
{
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
        return self::with('files')->join('taggables', 'tags.id', '=', 'taggables.tag_id')
            ->join('posts', 'taggables.taggable_id', '=', 'posts.id')
            ->where('taggables.taggable_type', Relations::post->value)
            ->select('tags.id', 'tags.name', 'tags.slug', DB::raw('SUM(posts.views) AS total_views'))
            ->groupBy('tags.id', 'tags.name', 'tags.slug')
            ->orderByDesc('total_views')
            ->limit($limit)
            ->get();
    }

    public function logo(): ?File
    {
        return $this->files()->whereHas('tags', function ($builder) {
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

    public function relatedPosts(array|int|string|null $exclude_ids = [], int|null $limit = null): Collection
    {
        $posts = $this->posts()
            ->with(Post::authors . ':' . Author::id . ',' . Author::name)
            ->whereNotIn(Post::id, is_array($exclude_ids) ? $exclude_ids : [$exclude_ids])
            ->orderByDesc(Post::views)
            ->get()
            ->keyBy(Post::id);

        $latest_post = $posts->sortByDesc(Post::published_at)->first();

        return $posts->forget($latest_post?->id)->prepend($latest_post)->take($limit);
    }
}
