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
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\LaravelMarkdown\MarkdownRenderer;
use Spatie\Sluggable\SlugOptions;

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

    protected $fillable = [self::title, self::subtitle, self::body];
    protected $casts = [self::published_at => 'datetime'];

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
        $this->update([
            self::published_content => app(MarkdownRenderer::class)
                ->highlightTheme('github-dark')
                ->toHtml($this->body),
            self::published_at => now(),
        ]);
        self::reguard();

        return $this;
    }
}
