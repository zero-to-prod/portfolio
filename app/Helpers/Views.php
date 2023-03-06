<?php

namespace App\Helpers;

/**
 * @property $value
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
    case layouts_app = 'layouts.app';
    case layouts_guest = 'layouts.guest';
    case layouts_main = 'layouts.main';
    case profile_edit = 'profile.edit';
    case welcome = 'welcome';
}
