<?php

namespace App\Models;

use App\Models\Support\IdColumn;
use App\Models\Support\TagColumns;
use App\Models\Support\TimeStampColumns;
use DB;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;

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

    public static function mostViewed(int|null $limit = null): Collection
    {
        return Tag::join('taggables', 'tags.id', '=', 'taggables.tag_id')
            ->join('posts', 'taggables.taggable_id', '=', 'posts.id')
            ->where('taggables.taggable_type', 2)
            ->select('tags.id', 'tags.name', 'tags.slug', DB::raw('COALESCE(SUM(posts.views), 0) as total_views'))
            ->groupBy('tags.id', 'tags.name')
            ->limit($limit)
            ->orderByDesc('total_views')
            ->get();
    }

    public function recommended(array|int|string|null $exclude_ids = []): Collection
    {
        $posts = $this->posts()
            ->with(Post::authors . ':' . Author::id . ',' . Author::name)
            ->whereNotIn(Post::id, is_array($exclude_ids) ? $exclude_ids : [$exclude_ids])
            ->orderByDesc(Post::views)
            ->get()
            ->keyBy(Post::id);

        $latest_post = $posts->sortByDesc(Post::published_at)->first();

        return $posts->forget($latest_post?->id)->prepend($latest_post);
    }
}
