<?php

namespace App\Models;

use App\Models\Support\IdColumn;
use App\Models\Support\React\ReactColumns;
use App\Models\Support\React\ReactRelationships;
use App\Models\Support\TimeStampColumns;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperReact
 */
class React extends Model
{
    use HasFactory;
    use IdColumn;
    use TimeStampColumns;
    use ReactColumns;
    use ReactRelationships;

    protected $fillable = [self::like, self::user_id];

}
