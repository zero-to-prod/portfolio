<?php

namespace App\Models;

use App\Models\Support\Author\AuthorColumns;
use App\Models\Support\Author\AuthorRelationships;
use App\Models\Support\Author\AuthorRules;
use App\Models\Support\HasRules;
use App\Models\Support\IdColumn;
use App\Models\Support\Polymorphic\HasFiles;
use App\Models\Support\SlugColumn;
use App\Models\Support\SoftDeleteColumn;
use App\Models\Support\TimeStampColumns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperAuthor
 */
class Author extends Model implements HasRules
{
    use HasFactory;
    use IdColumn;
    use TimeStampColumns;
    use SoftDeletes;
    use SoftDeleteColumn;
    use SlugColumn;
    use AuthorColumns;
    use AuthorRules;
    use HasFiles;
    use AuthorRelationships;

    protected $fillable = [self::name];

}
