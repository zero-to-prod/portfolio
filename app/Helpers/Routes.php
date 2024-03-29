<?php

namespace App\Helpers;

use App\Http\Controllers\Admin\Author\AuthorForm;
use App\Http\Controllers\Admin\Post\PostForm;
use App\Http\Controllers\Admin\Post\PostPublish;
use App\Http\Controllers\Admin\Tag\TagForm;

/**
 * @property $value
 * @property $name
 */
enum Routes: string
{
    case welcome = '/';
    case contact_store = 'contact/store/';
    case contact = 'contact/';
    case file = 'file/{file}/';
    case loginIndex = 'login/';
    case login_store = 'auth/login/store/';
    case logout = 'auth/logout/';
    case registerIndex = 'register/';
    case register_store = 'register/store/';
    case register_notice = 'register/notice/';
    case register_verification = 'register/verification/';
    case register_verification_notice = 'register/verification/notice/';
    case register_verification_send = 'register/verification/send/';
    case register_verify = 'register/verify/{id}/{hash}/';
    case privacy = 'privacy/';
    case read = 'read/{post}/';
    case results = 'results/';
    case logo = 'logo/';
    case search = 'search/';
    case newsletter = 'newsletter/';
    case newsletter_success = 'newsletter/success/';
    case subscribe = 'subscribe/';
    case subscribe_success = 'subscribe/success/';
    case subscribe_addPassword = 'subscribe/add-password/{user}/';
    case tos = 'terms-of-service/';


    /* Auth */
    case auth_github_callback = 'auth/github/callback/';
    case auth_github_index = 'auth/github/';

    case auth_google_callback = 'auth/google/callback/';
    case auth_google_index = 'auth/google/';

    case passwordNew_create = 'password-new/{token}/';
    case passwordNew_store = 'password-new/store/';
    case passwordReset_request = 'password-reset/request/';
    case passwordReset_store = 'password-reset/email/';
    case password_confirm = 'password/confirm/';
    case password_store = 'password/store/';
    case auth_password_update = 'password/update/';
    case profile_destroy = 'profile/destroy/';
    case profile_edit = 'profile/edit/';
    case profile_update = 'profile/update/';
    case auth_upload = 'upload/';

    /* Api */
    case api_v1_subscribe = 'api/v1/subscribe/';
    case api_v1_thanks = 'api/v1/thanks/';

    /* Guest */
    case admin_login_index = 'admin/login/';
    case admin_login_store = 'admin/login/store/';

    /* Admin */

    case admin_author_create = 'admin/authors/create/';
    case admin_author_edit = 'admin/authors/{' . AuthorForm::author . '}/edit/';
    case admin_author_index = 'admin/authors/';
    case admin_author_store = 'admin/authors/store/';
    case admin_post_create = 'admin/posts/create/';
    case admin_post_edit = 'admin/posts/{' . PostForm::post . '}/edit/';
    case admin_post_index = 'admin/posts/';
    case admin_post_publish = 'admin/posts/{' . PostPublish::id . '}/publish/';
    case admin_post_store = 'admin/posts/store/';
    case admin_post_unPublish = 'admin/posts/{' . PostForm::post . '}/un-publish/';
    case admin_tag_create = 'admin/tags/create/';
    case admin_tag_edit = 'admin/tags/{' . TagForm::tag . '}/edit/';
    case admin_tag_index = 'admin/tags/';
    case admin_tag_store = 'admin/tags/store/';
    case dashboard = 'admin/dashboard/';
}
