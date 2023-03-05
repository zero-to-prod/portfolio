<?php

namespace App\Models;

use App\Helpers\RelationMap;
use App\Models\Support\IdColumn;
use App\Models\Support\Tag\TagColumns;
use App\Models\Support\Tag\TagRelationships;
use App\Models\Support\TimeStampColumns;
use DB;
use Illuminate\Support\Collection;

/**
 * @mixin IdeHelperTag
 */
class Tag extends \Spatie\Tags\Tag
{
    use IdColumn;
    use TimeStampColumns;
    use TagColumns;
    use TagRelationships;

    protected $fillable = [self::name, self::slug, self::type, self::order_column];

    public static function mostViewed(int|null $limit = null): Collection
    {
        return Tag::join('taggables', 'tags.id', '=', 'taggables.tag_id')
            ->join('posts', 'taggables.taggable_id', '=', 'posts.id')
            ->where('taggables.taggable_type', RelationMap::post->value)
            ->select('tags.id', 'tags.name', 'tags.slug', DB::raw('SUM(posts.views) AS total_views'))
            ->groupBy('tags.id', 'tags.name', 'tags.slug')
            ->orderByDesc('total_views')
            ->limit($limit)
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
