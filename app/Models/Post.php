<?php

namespace App\Models;

use App\Models\Support\HasRules;
use App\Models\Support\IdColumn;
use App\Models\Support\PostColumns;
use App\Models\Support\PostRules;
use App\Models\Support\SlugColumn;
use App\Models\Support\SoftDeleteColumn;
use App\Models\Support\TimeStampColumns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
    protected $casts = [self::published_at => 'datetime'];

    public function views(): HasMany
    {
        return $this->hasMany(View::class);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
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
            self::published_at => now(),
            self::published_word_count => str_word_count(strip_tags($published_content)),
        ]);

        self::reguard();

        return $this;
    }
}
