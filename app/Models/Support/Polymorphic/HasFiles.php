<?php

namespace App\Models\Support\Polymorphic;

use App\Models\File;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasFiles
{
    public const fileable = 'fileable';
    public function files(): MorphToMany
    {
        return $this->morphToMany(File::class, self::fileable);
    }
}
