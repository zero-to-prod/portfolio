<?php

namespace App\Models;

use App\Models\Support\Taggable\TaggableColumns;

/**
 * @mixin IdeHelperTaggable
 */
class Taggable extends Model
{
    use TaggableColumns;

    protected $fillable = [self::tag_id, self::taggable_id, self::taggable_type];

}
