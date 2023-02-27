<?php

namespace App\Models;

use App\Models\Support\AuthorColumns;
use App\Models\Support\TimeStampColumns;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @mixin IdeHelperAuthorPost
 */
class AuthorPost extends Pivot
{
    use AuthorColumns;
    use TimeStampColumns;
}
