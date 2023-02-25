<?php

namespace App\Http;

enum Routes: string
{
    case connect = '/connect';
    case connect_store = '/connect/store';
    case cv = '/cv';
    case welcome = '/';

    /* Admin */

    case dashboard = '/dashboard';
    case email_verificationNotice = 'email/verification-notice';
    case email_verificationNotification = 'email/verification-notification';
    case email_verify = 'email/verify/{id}/{hash}';
    case logout = 'logout';
    case password_confirm = 'password/confirm';
    case password_store = 'password/store';
    case password_update = 'password/update';
    case passwordReset_request = 'password-reset/request';
    case passwordReset_store = 'password-reset/email';
    case passwordNew_create = 'password-new/{token}';
    case profile_destroy = '/profile/destroy';
    case profile_edit = '/profile/edit';
    case profile_update = '/profile/update';

    /* Guest */
    case register = 'register';
    case register_store = 'register/store';
    case login = 'login';
    case login_store = 'login/store';

}
