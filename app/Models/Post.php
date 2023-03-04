<?php

namespace App\Models;

use App\Helpers\Tags;
use App\Models\Support\HasRules;
use App\Models\Support\IdColumn;
use App\Models\Support\PostColumns;
use App\Models\Support\PostRules;
use App\Models\Support\SlugColumn;
use App\Models\Support\SoftDeleteColumn;
use App\Models\Support\TimeStampColumns;
use ArrayAccess;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
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

    protected $fillable = [self::title, self::subtitle, self::body];
    protected $casts = [self::published_at => 'datetime', self::originally_published_at => 'datetime'];

    public function files(): MorphToMany
    {
        return $this->morphToMany(File::class, 'fileable');
    }

    public function views(): HasMany
    {
        return $this->hasMany(View::class);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }

    public function isPublished(): bool
    {
        return $this->published_at !== null;
    }

    public function isUnPublished(): bool
    {
        return !$this->isPublished();
    }

    public static function recommended(ArrayAccess|\Spatie\Tags\Tag|array|string $tags, array|int|string|null $exclude_ids = []): Collection
    {
        $posts = self::withAnyTags($tags)
            ->with('authors')
            ->whereNotIn(self::id, is_array($exclude_ids) ? $exclude_ids : [$exclude_ids])
            ->whereNotNull(self::published_at)
            ->withCount('views')
            ->orderByDesc('views_count')
            ->get()
            ->keyBy(self::id);

        $latest_post = $posts->sortByDesc(self::published_at)->first();

        return $posts->forget($latest_post?->id)->prepend($latest_post);
    }

    public function featuredImage(): ?File
    {
        return $this->files()->whereHas('tags', function ($builder) {
            $builder->where('name->en', Tags::featured->value);
        })->first();
    }

    public function authorAvatar(): ?File
    {
        return $this->authors()->first()?->files()->whereHas('tags', function ($builder) {
            $builder->where('name->en', Tags::avatar->value);
        })->first();
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

    public function publish(): self
    {
        self::unguard();

        $published_content = app(MarkdownRenderer::class)->toHtml($this->body);

        $this->update([
            self::published_content => $published_content,
            self::originally_published_at => $this->originally_published_at === null ? now() : $this->originally_published_at,
            self::published_at => now(),
            self::published_word_count => str_word_count(strip_tags($published_content)),
        ]);

        self::reguard();

        return $this;
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
