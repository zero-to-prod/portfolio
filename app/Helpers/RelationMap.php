<?php

namespace App\Helpers;

/**
 * @property $value
 */
enum RelationMap: int
{
    case user = 1;
    case post = 2;
    case file = 3;
    case author = 4;
    case tag = 5;
}