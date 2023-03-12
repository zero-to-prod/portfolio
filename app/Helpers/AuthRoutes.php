<?php

namespace App\Helpers;

/**
 * @property $value
 * @property $name
 */
enum AuthRoutes: string
{
    case profile_update = '/profile/update';

    case passwordNew_create = 'password-new/{token}';
    case passwordNew_store = 'password-new/store';
    case passwordReset_request = 'password-reset/request';
    case passwordReset_store = 'password-reset/email';
    case register = 'register';
    case register_store = 'register/store';
}
