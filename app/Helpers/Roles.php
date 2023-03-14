<?php

namespace App\Helpers;

/**
 * @property $value
 * @property $name
 */
enum Roles: string
{
    case super_admin = 'super_admin';
    case contributor = 'contributor';
}