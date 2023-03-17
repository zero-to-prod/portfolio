<?php

namespace App\Helpers;

use App\Http\Controllers\Admin\Author\AuthorFormView;
use App\Http\Controllers\Admin\Post\PostFormView;
use App\Http\Controllers\Admin\Post\PostPublishRedirect;
use App\Http\Controllers\Admin\Tag\TagFormView;

/**
 * @property $value
 * @property $name
 */
enum Routes: string
{

    case connect_store = 'connect/store';
    case contact = 'contact';
    case cv = 'cv';
    case file = 'file/{file}';
    case login = 'login';
    case privacy = 'privacy';
    case read = 'read/{post}';
    case results = 'results';
    case search = 'search';
    case newsletter = 'newsletter';
    case tos = 'terms-of-service';
    case welcome = '/';

    /* Auth */

    case auth_email_verificationNotice = 'email/verification-notice';
    case auth_email_verificationNotification = 'email/verification-notification';
    case auth_email_verify = 'email/verify/{id}/{hash}';
    case auth_github_callback = 'auth/github/callback';
    case auth_github_index = 'auth/github';
    case auth_logout = 'logout';
    case auth_passwordNew_create = 'password-new/{token}';
    case auth_passwordNew_store = 'password-new/store';
    case auth_passwordReset_request = 'password-reset/request';
    case auth_passwordReset_store = 'password-reset/email';
    case auth_password_confirm = 'password/confirm';
    case auth_password_store = 'password/store';
    case auth_password_update = 'password/update';
    case auth_profile_destroy = 'profile/destroy';
    case auth_profile_edit = 'profile/edit';
    case auth_profile_update = 'profile/update';
    case auth_register_index = 'register';
    case auth_register_store = 'register/store';
    case auth_upload = 'upload';


    /* Api */
    case api_v1_subscribe = 'api/v1/subscribe';
    case api_v1_thanks = 'api/v1/thanks';

    /* Guest */
    case admin_login_index = 'admin/login';
    case admin_login_store = 'admin/login/store';

    /* Admin */



    case admin_author_create = 'admin/authors/create';
    case admin_author_edit = 'admin/authors/{' . AuthorFormView::author . '}/edit';
    case admin_author_index = 'admin/authors';
    case admin_author_store = 'admin/authors/store';
    case admin_post_create = 'admin/posts/create';
    case admin_post_edit = 'admin/posts/{' . PostFormView::post . '}/edit';
    case admin_post_index = 'admin/posts';
    case admin_post_publish = 'admin/posts/{' . PostPublishRedirect::id . '}/publish';
    case admin_post_store = 'admin/posts/store';
    case admin_post_unPublish = 'admin/posts/{' . PostFormView::post . '}/un-publish';
    case admin_tag_create = 'admin/tags/create';
    case admin_tag_edit = 'admin/tags/{' . TagFormView::tag . '}/edit';
    case admin_tag_index = 'admin/tags';
    case admin_tag_store = 'admin/tags/store';
    case dashboard = 'admin/dashboard';
}
