<?php

namespace App\Models;

use App\Helpers\CacheKeys;
use App\Helpers\PostTypes;
use App\Helpers\Tags;
use App\Helpers\TagTypes;
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
use Cache;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use RuntimeException;
use Spatie\LaravelMarkdown\MarkdownRenderer;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;
use Tests\Feature\Models\Post\LikeTest;

/**
 * @mixin IdeHelperPost
 */
class Post extends \Illuminate\Database\Eloquent\Model implements HasRules
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

    protected $fillable = [
        self::post_type_id,
        self::file_id,
        self::alt_file_id,
        self::animation_file_id,
        self::title,
        self::subtitle,
        self::public_content,
        self::cta,
        self::exclusive_content,
        self::premiere_at
    ];
    protected $casts = [
        self::post_type_id => PostTypes::class,
        self::file_id => 'integer',
        self::alt_file_id => 'integer',
        self::animation_file_id => 'integer',
        self::published_at => 'datetime',
        self::premiere_at => 'datetime',
        self::original_publish_date => 'datetime',
        self::views => 'integer',
        self::public_word_count => 'integer',
        self::public_reading_time => 'integer',
    ];

    public function reactions(): MorphToMany
    {
        return $this->morphToMany(Reaction::class, 'reactable');
    }

    public function liked(): bool
    {
        /** @var User $user */
        $user = auth()->user();

        if ($user === null) {
            return false;
        }

        return $this->reactions()->where(Reaction::user_id, $user->id)->first()?->like === 1;
    }

    public function disliked(): bool
    {
        /** @var User $user */
        $user = auth()->user();

        if ($user === null) {
            return false;
        }

        return $this->reactions()->where(Reaction::user_id, $user->id)->first()?->like === -1;
    }

    /**
     * @see LikeTest
     */
    public function like(): static
    {
        /** @var User $user */
        $user = auth()->user();

        if ($user === null) {
            return $this;
        }

        if (!$user->hasVerifiedEmail()) {
            redirect(route('verification.notice'));

            return $this;
        }

        /** @var Reaction $reaction */
        $reaction = $this->reactions()->where(Reaction::user_id, $user->id)->first();
        if ($reaction !== null) {
            if ($reaction->like === 1) {
                $this->decrement(self::likes);
                $reaction->update([Reaction::like => 0]);

                return $this;
            }
            if ($reaction->like === 0) {
                $this->increment(self::likes);
                $reaction->update([Reaction::like => 1]);

                return $this;
            }
            $this->increment(self::likes);
            $this->decrement(self::dislikes);
            $reaction->update([Reaction::like => 1]);

            return $this;
        }

        $reaction = Reaction::create([
            Reaction::user_id => $user->id,
            Reaction::like => 1,
        ]);
        $this->reactions()->attach($reaction);
        $this->increment(self::likes);

        return $this;
    }

    /**
     * @see LikeTest
     */
    public function dislike(): static
    {

        /** @var User $user */
        $user = auth()->user();

        if ($user === null) {
            return $this;
        }

        if (!$user->hasVerifiedEmail()) {
            redirect(route('verification.notice'));

            return $this;
        }

        /** @var Reaction $reaction */
        $reaction = $this->reactions()->where(Reaction::user_id, $user->id)->first();
        if ($reaction !== null) {
            if ($reaction->like === -1) {
                $this->decrement(self::dislikes);
                $reaction->update([Reaction::like => 0]);

                return $this;
            }

            if ($reaction->like === 0) {
                $this->increment(self::dislikes);
                $reaction->update([Reaction::like => -1]);

                return $this;
            }

            $this->increment(self::dislikes);
            $this->decrement(self::likes);
            $reaction->update([Reaction::like => -1]);

            return $this;
        }

        $reaction = Reaction::create([
            Reaction::user_id => $user->id,
            Reaction::like => -1,
        ]);
        $this->reactions()->attach($reaction);
        $this->increment(self::dislikes);

        return $this;
    }

    protected static function booted(): void
    {
        static::addGlobalScope(self::published, self::publishedScope());
    }

    public function author(): Author
    {
        return Cache::remember($this->id . '|' . CacheKeys::post_author->value, 60 * 60, function () {
            return $this->authors->first()->load(Author::file);
        });
    }

    public function authorPostCount(): int
    {
        return Cache::remember($this->id . '|' . CacheKeys::post_author_post_count->value, 60 * 60, function () {
            return $this->authors->first()->posts()->count();
        });
    }

    /**
     * @throws Exception
     */
    public function publish(): self
    {
        if (!PostCanBePublished::evaluate($this)) {
            throw new RuntimeException('Cannot publish post');
        }
        self::unguard();

        $public_content = $this->public_content !== null ? app(MarkdownRenderer::class)->toHtml($this->public_content) : null;
        $cta = $this->cta !== null ? app(MarkdownRenderer::class)->toHtml($this->cta) : null;
        $exclusive_content = $this->exclusive_content !== null ? app(MarkdownRenderer::class)->toHtml($this->exclusive_content) : null;

        $premiere_at = $this->premiere_at;
        if ($this->post_type_id !== PostTypes::animation) {
            $premiere_at = $this->premiere_at ?? now()->addWeek();
        }

        $this->update([
            self::published_public_content => $public_content,
            self::published_cta => $cta,
            self::published_exclusive_content => $exclusive_content,
            self::original_publish_date => $this->original_publish_date ?? now(),
            self::published_at => now(),
            self::premiere_at => $premiere_at,
            self::public_word_count => str_word_count(strip_tags($public_content)),
            self::exclusive_word_count => str_word_count(strip_tags($exclusive_content)),
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

    /**
     * @return Collection<File, File>
     */
    public function inBodyFiles(): Collection
    {
        return $this->files()->whereHas(File::tags, function ($builder) {
            $builder->where(Tag::name . '->en', Tags::in_body->value);
        })->get();
    }

    public static function scopeRelated(Builder $builder, ArrayAccess|\Spatie\Tags\Tag|array|string $tags, array|int|string|null $exclude_ids = [], int|null $limit = 20): Builder
    {
        $exclude_ids = is_array($exclude_ids) ? $exclude_ids : [$exclude_ids];

        return $builder->withAnyTags($tags, TagTypes::post->value)
            ->with([self::authors, self::file, self::tags . '.' . Tag::file, self::altFile, self::animationFile])
            ->whereNotIn(self::id, $exclude_ids)
            ->orderByDesc(self::views)
            ->limit($limit);
    }

    public function authorList(): string
    {
        return Cache::remember($this->id . '|' . CacheKeys::post_author_list->value, 60 * 60, function () {
            return $this->authors->map(fn(Author $author) => $author->name)->join(', ');
        });
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
