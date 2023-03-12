<?php

namespace App\Helpers;

/**
 * @property $value
 * @property $name
 */
enum AuthRoutes: string
{
    case register = 'register';
    case register_store = 'register/store';
}
