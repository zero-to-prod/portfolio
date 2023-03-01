<?php

namespace App\Models;

use App\Models\Support\AuthorColumns;
use App\Models\Support\AuthorRules;
use App\Models\Support\HasRules;
use App\Models\Support\IdColumn;
use App\Models\Support\SlugColumn;
use App\Models\Support\SoftDeleteColumn;
use App\Models\Support\TimeStampColumns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperAuthor
 */
class Author extends Model implements HasRules
{
    use HasFactory;
    use IdColumn;
    use TimeStampColumns;
    use SoftDeletes;
    use SoftDeleteColumn;
    use SlugColumn;
    use AuthorColumns;
    use AuthorRules;

    protected $fillable = [self::name];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }
}
