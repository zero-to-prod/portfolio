<?php

namespace App\Models;

use App\Models\Support\Fileable\FileableColumns;

/**
 * @mixin IdeHelperFileable
 */
class Fileable extends Model
{
    use FileableColumns;

    protected $fillable = [self::file_id, self::fileable_id, self::fileable_type];

}
