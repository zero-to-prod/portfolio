<?php

namespace App\Helpers;

/**
 * @property $value
 * @property $name
 */
enum PostTypes: int
{
    case post = 1;
    case animation = 2;
}