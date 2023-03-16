<?php

namespace App\Models;

use App\Models\Support\IdColumn;
use App\Models\Support\View\ViewColumns;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperView
 */
class View extends \Illuminate\Database\Eloquent\Model
{
    use HasFactory;
    use IdColumn;
    use ViewColumns;
    const UPDATED_AT = null;

    protected $fillable = [self::post_id, self::ip, self::user_agent, self::locale];
}
