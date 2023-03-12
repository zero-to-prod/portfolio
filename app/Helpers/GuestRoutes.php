<?php

namespace App\Helpers;

/**
 * @property $value
 * @property $name
 */
enum GuestRoutes: string
{
    case login = 'login';
    case login_store = 'login/store';
}
