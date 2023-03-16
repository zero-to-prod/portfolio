<?php

namespace App\Helpers;

/**
 * @property $value
 * @property $name
 */
enum CacheKeys: string
{
    case newsletter = 'newsletter';
    case most_viewed = 'most_viewed';
}