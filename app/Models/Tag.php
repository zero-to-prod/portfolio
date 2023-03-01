<?php

namespace App\Models;

use App\Models\Support\IdColumn;
use App\Models\Support\TagColumns;
use App\Models\Support\TimeStampColumns;

/**
 * @mixin IdeHelperTag
 */
class Tag extends \Spatie\Tags\Tag
{
    use IdColumn;
    use TimeStampColumns;
    use TagColumns;

    protected $fillable = [self::name, self::slug, self::type, self::order_column];
}
