<?php

namespace App\Models;

use App\Http\Routes;
use App\Models\Support\FileColumns;
use App\Models\Support\IdColumn;
use App\Models\Support\SoftDeleteColumn;
use App\Models\Support\TimeStampColumns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperFile
 */
class File extends Model
{
    use HasFactory;
    use IdColumn;
    use TimeStampColumns;
    use SoftDeletes;
    use SoftDeleteColumn;
    use FileColumns;

    protected $fillable = [self::name, self::path, self::original_name, self::mime_type];

    public function relativeUrl(): string
    {
        return str_replace('{img}',  $this->name, Routes::img->value);
    }
}
