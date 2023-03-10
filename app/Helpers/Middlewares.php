<?php

namespace App\Helpers;

/**
 * @property $value
 * @property $name
 */
enum Middlewares: string
{
    case web = 'web';
    case api = 'api';
    case web_group = 'web_group';
    case auth_group = 'auth_group';
    case guest_group = 'guest_group';
    case register_group = 'register_group';
    case auth = 'auth';
    case auth_basic = 'auth.basic';
    case auth_session = 'auth.session';
    case auth_sanctum = 'auth:sanctum';
    case cache_headers = 'cache.headers';
    case can = 'can';
    case guest = 'guest';
    case password_confirm = 'password.confirm';
    case signed = 'signed';
    case throttle = 'throttle';
    case verified = 'verified';
}
