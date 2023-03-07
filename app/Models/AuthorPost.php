<?php

namespace App\Models;

use App\Models\Support\AuthorPost\AuthorPostColumns;
use App\Models\Support\TimeStampColumns;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @mixin IdeHelperAuthorPost
 */
class AuthorPost extends Pivot
{
    use AuthorPostColumns;
    use TimeStampColumns;
}
