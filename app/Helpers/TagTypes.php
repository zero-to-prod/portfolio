<?php

namespace App\Helpers;

/**
 * @property $value
 * @property $name
 */
enum TagTypes: int
{
    case system = 1;
    case post = 2;
}
