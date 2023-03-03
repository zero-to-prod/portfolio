<?php

namespace App\Models;

use App\Models\Support\IdColumn;
use App\Models\Support\TagColumns;
use App\Models\Support\TimeStampColumns;
use DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @mixin IdeHelperTag
 */
class Tag extends \Spatie\Tags\Tag
{
    use IdColumn;
    use TimeStampColumns;
    use TagColumns;

    protected $fillable = [self::name, self::slug, self::type, self::order_column];

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    /**
     * @return \Illuminate\Support\Collection<Tag>
     */
    public static function mostViewed(): \Illuminate\Support\Collection
    {
        return Tag::join('taggables', 'tags.id', '=', 'taggables.tag_id')
            ->join('posts', 'taggables.taggable_id', '=', 'posts.id')
            ->leftJoin(DB::raw('(SELECT post_id, COUNT(*) as views FROM views GROUP BY post_id) as post_views'), 'posts.id', '=', 'post_views.post_id')
            ->where('taggables.taggable_type', 2)
            ->select('tags.id', 'tags.name', 'tags.slug', DB::raw('COALESCE(SUM(post_views.views), 0) as total_views'))
            ->groupBy('tags.id', 'tags.name')
            ->get();
    }

    public function recommended(array|int|string|null $exclude_ids = []): Collection
    {
        $posts = $this->posts()
            ->with('authors:id,name')
            ->whereNotIn(Post::id, is_array($exclude_ids) ? $exclude_ids : [$exclude_ids])
            ->whereNotNull(Post::published_at)
            ->withCount('views')
            ->orderByDesc('views_count')
            ->get()
            ->keyBy(Post::id);

        $latest_post = $posts->sortByDesc(Post::published_at)->first();

        return $posts->forget($latest_post?->id)->prepend($latest_post);
    }
}
