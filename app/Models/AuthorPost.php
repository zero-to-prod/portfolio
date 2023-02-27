<?php

namespace App\Models;

use App\Models\Support\AuthorColumns;
use App\Models\Support\TimeStampColumns;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @mixin IdeHelperAuthor
 */
class AuthorPost extends Pivot
{
    use AuthorColumns;
    use TimeStampColumns;
}
