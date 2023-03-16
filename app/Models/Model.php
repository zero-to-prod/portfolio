<?php

namespace App\Models;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Model extends \Illuminate\Database\Eloquent\Model
{
    use Cachable;
}