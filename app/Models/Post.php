<?php

namespace App\Models;

use App\Helpers\Tags;
use App\Models\Support\HasRules;
use App\Models\Support\IdColumn;
use App\Models\Support\Polymorphic\HasFiles;
use App\Models\Support\Post\PostColumns;
use App\Models\Support\Post\PostRelationships;
use App\Models\Support\Post\PostRules;
use App\Models\Support\Post\PostScopes;
use App\Models\Support\SlugColumn;
use App\Models\Support\SoftDeleteColumn;
use App\Models\Support\TimeStampColumns;
use App\Rules\PostCanBePublished;
use App\Rules\PostIsPublished;
use ArrayAccess;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RuntimeException;
use Spatie\LaravelMarkdown\MarkdownRenderer;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;

/**
 * @mixin IdeHelperPost
 */
class Post extends Model implements HasRules
{
    use HasFactory;
    use IdColumn;
    use TimeStampColumns;
    use SoftDeletes;
    use SoftDeleteColumn;
    use SlugColumn;
    use PostColumns;
    use PostRules;
    use HasTags;
    use PostRelationships;
    use PostScopes;
    use HasFiles;
    use PostScopes;

    protected $fillable = [self::title, self::subtitle, self::body];
    protected $casts = [
        self::published_at => 'datetime',
        self::original_publish_date => 'datetime',
        self::views => 'integer',
        self::published_word_count => 'integer',
        self::reading_time => 'integer',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(self::published, self::publishedScope());
    }

    /**
     * @throws Exception
     */
    public function publish(): self
    {
        if(!PostCanBePublished::evaluate($this)) {
            throw new RuntimeException('Cannot publish post');
        }
        self::unguard();

        $published_content = app(MarkdownRenderer::class)->toHtml($this->body);

        $this->update([
            self::published_content => $published_content,
            self::original_publish_date => $this->original_publish_date ?? now(),
            self::published_at => now(),
            self::published_word_count => str_word_count(strip_tags($published_content)),
        ]);

        self::reguard();

        return $this;
    }

    public function isPublished(): bool
    {
        return PostIsPublished::evaluate($this);
    }

    public function isNotPublished(): bool
    {
        return !PostIsPublished::evaluate($this);
    }

    public static function related(ArrayAccess|\Spatie\Tags\Tag|array|string $tags, array|int|string|null $exclude_ids = [], int|null $limit = 20): Collection
    {
        $posts = self::withAnyTags($tags, Tags::post->value)
            ->with(self::authors)
            ->whereNotIn(self::id, is_array($exclude_ids) ? $exclude_ids : [$exclude_ids])
            ->orderByDesc(self::views)
            ->limit($limit)
            ->get()
            ->keyBy(self::id);

        $latest_post = $posts->sortByDesc(self::published_at)->first();
        $posts = $posts->forget($latest_post?->id);

        return $latest_post === null ? $posts : $posts->prepend($latest_post);
    }

    public function featuredImage(): ?File
    {
        return $this->files()->whereHas(self::tags, function ($builder) {
            $builder->where(Tag::name . '->en', Tags::featured->value);
        })->first();
    }

    public function hasFeaturedImage(): bool
    {
        return $this->featuredImage() !== null;
    }

    public function isMissingFeaturedImage(): bool
    {
        return $this->featuredImage() === null;
    }

    public function authorAvatar(): ?File
    {
        return $this->authors()->first()?->avatar();
    }

    public function authorList(): string
    {
        return $this->authors->map(fn(Author $author) => $author->name)->join(', ');
    }

    public function getRouteKeyName(): string
    {
        return self::slug;
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(self::title)
            ->saveSlugsTo(self::slug)
            ->doNotGenerateSlugsOnUpdate();
    }



    public function unPublish(): self
    {
        self::unguard();

        $this->update([
            self::published_at => null,
        ]);

        self::reguard();

        return $this;
    }
}
