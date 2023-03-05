<?php

namespace App\Models;

use App\Helpers\Tags;
use App\Models\Support\File\FileColumns;
use App\Models\Support\File\FileRelationships;
use App\Models\Support\IdColumn;
use App\Models\Support\SoftDeleteColumn;
use App\Models\Support\TimeStampColumns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Tags\HasTags;

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
    use FileRelationships;
    use HasTags;

    protected $fillable = [self::name, self::path, self::original_name, self::mime_type];

    public function tagFeaturedImage(): File
    {
        return $this->attachTags([Tags::featured->value], 'system');
    }

}
