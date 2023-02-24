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
    case logout = 'logout';
    case verification_notice = 'verify-email';
    case email_verificationNotification = 'email/verification-notification';
    case email_verify = 'verify-email/{id}/{hash}';
    case password_confirm = 'password/confirm';
    case password_store = 'password/store';
    case password_update = 'password/update';
}
