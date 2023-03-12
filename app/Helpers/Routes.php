<?php

namespace App\Helpers;

/**
 * @property $value
 * @property $name
 */
enum Routes: string
{
    case connect = '/connect';
    case connect_store = '/connect/store';
    case cv = '/cv';
    case file = '/file/{file}';
    case welcome = '/';

    case read = '/read/{post}';
    case search = '/search';
    case results = '/results';

    case dashboard = '/dashboard';
}
