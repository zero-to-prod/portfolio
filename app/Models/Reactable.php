<?php

namespace App\Models;

use App\Models\Support\Reactable\ReactableColumns;

/**
 * @mixin IdeHelperReactable
 */
class Reactable extends Model
{
    use ReactableColumns;

    protected $fillable = [self::react_id, self::reactable_id, self::reactable_type];

}
