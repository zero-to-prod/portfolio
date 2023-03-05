<?php

namespace App\Models;

use App\Models\Support\HasRules;
use App\Models\Support\IdColumn;
use App\Models\Support\MessageColumns;
use App\Models\Support\MessageRelationships;
use App\Models\Support\MessageRules;
use App\Models\Support\SoftDeleteColumn;
use App\Models\Support\TimeStampColumns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperMessage
 */
class Message extends Model implements HasRules
{
    use HasFactory;
    use IdColumn;
    use TimeStampColumns;
    use SoftDeletes;
    use SoftDeleteColumn;
    use MessageColumns;
    use MessageRelationships;
    use MessageRules;

    protected $fillable = [self::subject, self::body];

}
