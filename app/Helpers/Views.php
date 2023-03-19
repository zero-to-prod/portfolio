<?php

namespace App\Helpers;

/**
 * @property $value
 * @property $name
 */
enum Views: string
{

    /* Authors */
    /* Posts */
    /* Tags */
    case admin_author_form = 'admin.authors.author_form';
    case admin_author_index = 'admin.authors.author_index';
    case admin_post_form = 'admin.posts.post_form';
    case admin_post_index = 'admin.posts.post_index';
    case admin_tag_form = 'admin.tags.tag_form';
    case admin_tag_index = 'admin.tags.tag_index';
    case auth_confirmPassword = 'auth.confirm-password';
    case auth_forgotPassword = 'auth.forgot-password';
    case auth_login = 'auth.login';
    case auth_register = 'auth.register';
    case auth_resetPassword = 'auth.reset-password';
    case auth_verifyEmail = 'auth.verify-email';
    case contact = 'contact';
    case cv = 'cv';
    case dashboard = 'dashboard';
    case layouts_app = 'layouts.app';
    case layouts_guest = 'layouts.guest';
    case register_notice = 'register_notice';
    case register_success = 'register_success';
    case register_verify = 'register_verify';
    case layouts_login = 'layouts.login';
    case layouts_main = 'layouts.main';
    case layouts_subscribe = 'layouts.subscribe';
    case privacy = 'privacy';
    case profile_edit = 'profile.edit';
    case read_post = 'read.post';
    case results = 'results';
    case newsletter = 'newsletter';
    case subscribe = 'subscribe';
    case tos = 'tos';
    case welcome = 'welcome';
}
