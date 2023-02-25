<?php

namespace App\Http;

enum Views: string
{
    case auth_confirmPassword = 'auth.confirm-password';
    case auth_forgotPassword = 'auth.forgot-password';
    case auth_login = 'auth.login';
    case auth_register = 'auth.register';
    case auth_resetPassword = 'auth.reset-password';
    case connect = 'connect';
    case cv = 'cv';
    case dashboard = 'dashboard';
    case layouts_app = 'layouts.app';
    case layouts_guest = 'layouts.guest';
    case profile_edit = 'profile.edit';
    case welcome = 'welcome';
}
