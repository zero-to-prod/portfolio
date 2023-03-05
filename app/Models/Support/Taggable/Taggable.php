<?php

namespace App\Models\Support\Taggable;

use App\Models\IdeHelperTaggable;
use App\Models\Support\TaggableColumns;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperTaggable
 */
class Taggable extends Model
{
    use TaggableColumns;

    protected $fillable = [self::tag_id, self::taggable_id, self::taggable_type];

}
