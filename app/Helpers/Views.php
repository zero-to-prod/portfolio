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
    case admin_posts = 'admin.posts.index';
    case admin_posts_form = 'admin.posts.post_form';
    case layouts_app = 'layouts.app';
    case layouts_guest = 'layouts.guest';
    case layouts_main = 'layouts.main';
    case profile_edit = 'profile.edit';
    case welcome = 'welcome';
}
