<?php

namespace App\Models;

use App\Models\Support\AuthorColumns;
use App\Models\Support\AuthorRules;
use App\Models\Support\HasRules;
use App\Models\Support\IdColumn;
use App\Models\Support\SlugColumn;
use App\Models\Support\SoftDeleteColumn;
use App\Models\Support\TimeStampColumns;
use App\Models\Support\ViewColumns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperView
 */
class View extends Model
{
    use HasFactory;
    use IdColumn;
    use ViewColumns;
    const UPDATED_AT = null;

    protected $fillable = [self::post_id, self::ip, self::user_agent, self::locale];
}
