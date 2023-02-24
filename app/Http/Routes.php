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
    case profile_edit = '/profile/edit';
    case verification_notice = 'verify-email';
    case verification_verify = 'verify-email/{id}/{hash}';
    case password_confirm = 'confirm-password';
}
