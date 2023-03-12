<?php

namespace App\Helpers;

/**
 * @property $value
 * @property $name
 */
enum AuthRoutes: string
{
    case passwordReset_store = 'password-reset/email';
    case register = 'register';
    case register_store = 'register/store';
}
