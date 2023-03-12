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
    case connect = 'connect';
    case connect_store = 'connect/store';
    case cv = 'cv';
    case file = 'file/{file}';
    case welcome = '/';

    case read = 'read/{post}';
    case search = 'search';
    case results = 'results';

    /* Auth */
    case auth_upload = 'upload';
    case auth_email_verificationNotice = 'email/verification-notice';
    case auth_email_verificationNotification = 'email/verification-notification';
    case auth_email_verify = 'email/verify/{id}/{hash}';
    case auth_logout = 'logout';
    case auth_password_confirm = 'password/confirm';
    case auth_password_store = 'password/store';
    case auth_password_update = 'password/update';
    case auth_profile_destroy = 'profile/destroy';
    case auth_profile_edit = 'profile/edit';
    case auth_profile_update = 'profile/update';

    /* Api */
    case subscribe = 'subscribe';

    /* Admin */

    case dashboard = 'dashboard';
    case admin_post_index = '/posts';
    case admin_post_create = '/posts/create';
    case admin_post_store = '/posts/store';
    case admin_post_edit = '/posts/{' . PostFormView::post . '}/edit';
    case admin_post_publish = '/posts/{' . PostPublishRedirect::id . '}/publish';
    case admin_post_unPublish = '/posts/{' . PostFormView::post . '}/un-publish';

    case admin_tag_index = 'tags';
    case admin_tag_create = 'tags/create';
    case admin_tag_edit = 'tags/{' . TagFormView::tag . '}/edit';
    case admin_tag_store = 'tags/store';

    case admin_author_index = 'authors';
    case admin_author_create = 'authors/create';
    case admin_author_edit = 'authors/{' . AuthorFormView::author . '}/edit';
    case admin_author_store = 'authors/store';
}
