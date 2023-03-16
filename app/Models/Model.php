<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;

/**
 * @mixin IdeHelperModel
 */
class Model extends \Illuminate\Database\Eloquent\Model
{
    use Cachable;
}