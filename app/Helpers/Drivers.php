<?php

namespace App\Helpers;

/**
 * @property $value
 * @property $name
 */
enum Drivers: string
{
    case github = 'github';
    case google = 'google';
}