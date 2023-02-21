<?php

namespace App\Models;

use App\Models\Support\IdColumn;
use App\Models\Support\MessageColumns;
use App\Models\Support\SoftDeleteColumn;
use App\Models\Support\TimeStampColumns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory;
    use IdColumn;
    use TimeStampColumns;
    use SoftDeletes;
    use SoftDeleteColumn;
    use MessageColumns;

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
