<?php

namespace App\Helpers;

use App\Http\Controllers\Admin\Post\PostFormView;
use App\Http\Controllers\Admin\Post\PostPublishRedirect;
use App\Http\Controllers\Admin\Tag\TagFormView;

/**
 * @property $value
 * @property $name
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

    /**
     * Admin
     */

    /* Posts */
    case admin_post_index = '/admin/posts';
    case admin_post_create = '/admin/posts/create';
    case admin_post_store = '/admin/posts/store';
    case admin_post_edit = '/admin/posts/{'.PostFormView::post.'}/edit';
    case admin_post_publish = '/admin/posts/{'.PostPublishRedirect::id.'}/publish';
    case admin_post_unPublish = '/admin/posts/{'.PostFormView::post.'}/un-publish';

    /* Tags */
    case admin_tag_index = '/admin/tags';
    case admin_tag_create = '/admin/tags/create';
    case admin_tag_edit = '/admin/tags/{'.TagFormView::tag.'}/edit';
    case admin_tag_store = '/admin/tags/store';




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
