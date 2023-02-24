<?php

namespace App\Http;

enum Routes: string
{
    case cv = '/cv';
    case connect = '/connect';
    case connect_store = '/connect/store';
    case welcome = '/';
    case dashboard = '/dashboard';

    /* Auth */
    case profile_edit = '/profile';
}
