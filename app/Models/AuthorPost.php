<?php

namespace App\Models;

use App\Models\Support\AuthorPost\AuthorPostColumns;
use App\Models\Support\TimeStampColumns;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @mixin IdeHelperAuthorPost
 */
class AuthorPost extends Pivot
{
    use Cachable;
    use AuthorPostColumns;
    use TimeStampColumns;
}
