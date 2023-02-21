<?php

namespace App\Models;

use App\Models\Support\ContactColumns;
use App\Models\Support\IdColumn;
use App\Models\Support\SoftDeleteColumn;
use App\Models\Support\TimeStampColumns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperContact
 */
class Contact extends Model
{
    use HasFactory;
    use IdColumn;
    use TimeStampColumns;
    use SoftDeletes;
    use SoftDeleteColumn;
    use ContactColumns;

    protected $fillable = [self::email];

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
