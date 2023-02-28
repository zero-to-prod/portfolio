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

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(self::title)
            ->saveSlugsTo(self::slug);
    }
}
