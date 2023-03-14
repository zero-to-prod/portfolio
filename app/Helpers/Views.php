<?php

namespace App\Helpers;

/**
 * @property $value
 * @property $name
 */
enum Views: string
{
    case auth_confirmPassword = 'auth.confirm-password';
    case auth_forgotPassword = 'auth.forgot-password';
    case auth_login = 'auth.login';
    case auth_register = 'auth.register';
    case auth_resetPassword = 'auth.reset-password';
    case auth_verifyEmail = 'auth.verify-email';
    case read_post = 'read.post';
    case connect = 'connect';
    case results = 'results';
    case cv = 'cv';
    case dashboard = 'dashboard';
    /* Posts */
    case admin_post_index = 'admin.posts.post_index';
    case admin_post_form = 'admin.posts.post_form';

    /* Tags */
    case admin_tag_index = 'admin.tags.tag_index';
    case admin_tag_form = 'admin.tags.tag_form';

    /* Authors */
    case admin_author_index = 'admin.authors.author_index';
    case admin_author_form = 'admin.authors.author_form';

    case layouts_app = 'layouts.app';
    case layouts_guest = 'layouts.guest';
    case layouts_main = 'layouts.main';
    case layouts_login = 'layouts.login';
    case profile_edit = 'profile.edit';
    case welcome = 'welcome';
    case subscribe = 'subscribe';
}
