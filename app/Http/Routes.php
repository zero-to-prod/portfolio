<?php

namespace App\Http;

enum Routes: string
{
    case cv = '/cv';
    case connect = '/connect';
    case connect_store = '/connect/store';
    case welcome = '/';
    case dashboard = '/dashboard';

    case profile_edit = '/profile/edit';
    case profile_update = '/profile/update';
    case profile_destroy = '/profile/destroy';
    case verification_notice = 'verify-email';
    case verification_send = 'email/verification-notification';
    case verification_verify = 'verify-email/{id}/{hash}';
    case password_confirm = 'confirm-password';
    case password_store = 'password/store';
}
