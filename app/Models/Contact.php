<?php

namespace App\Models;

use App\Models\Support\Contact\ContactColumns;
use App\Models\Support\Contact\ContactRelationships;
use App\Models\Support\Contact\ContactRules;
use App\Models\Support\HasRules;
use App\Models\Support\IdColumn;
use App\Models\Support\SoftDeleteColumn;
use App\Models\Support\TimeStampColumns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperContact
 */
class Contact extends Model implements HasRules
{
    use HasFactory;
    use IdColumn;
    use TimeStampColumns;
    use SoftDeletes;
    use SoftDeleteColumn;
    use ContactColumns;
    use ContactRelationships;
    use ContactRules;

    protected $fillable = [self::email];

}
