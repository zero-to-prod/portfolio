<?php

namespace App\Helpers;

/**
 * @property $value
 */
enum Routes: string
{
    case connect = '/connect';
    case connect_store = '/connect/store';
    case cv = '/cv';
    case upload = '/upload';
    case file = '/file/{file}';
    case welcome = '/';

    case read = '/read/{post}';
    case search = '/search';
    case results = '/results';

    /* Admin */

    case admin_posts = '/admin/posts';
    case admin_posts_create = '/admin/posts/create';
    case admin_posts_store = '/admin/posts/store';
    case admin_posts_edit = '/admin/posts/{post}/edit';
    case admin_posts_publish = '/admin/posts/{post}/publish';
    case admin_posts_unPublish = '/admin/posts/{post}/un-publish';
    case dashboard = '/dashboard';
    case email_verificationNotice = 'email/verification-notice';
    case email_verificationNotification = 'email/verification-notification';
    case email_verify = 'email/verify/{id}/{hash}';
    case logout = 'logout';
    case password_confirm = 'password/confirm';
    case password_store = 'password/store';
    case password_update = 'password/update';
    case profile_destroy = '/profile/destroy';
    case profile_edit = '/profile/edit';
    case profile_update = '/profile/update';

    /* Guest */
    case login = 'login';
    case login_store = 'login/store';
    case passwordNew_create = 'password-new/{token}';
    case passwordNew_store = 'password-new/store';
    case passwordReset_request = 'password-reset/request';
    case passwordReset_store = 'password-reset/email';
    case register = 'register';
    case register_store = 'register/store';
}
