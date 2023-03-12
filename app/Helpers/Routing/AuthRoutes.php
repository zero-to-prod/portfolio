<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;

class AuthRoutes
{

    public Routes $upload = Routes::auth_upload;
    public Routes $emailVerificationNotice = Routes::auth_email_verificationNotice;
    public Routes $emailVerificationNotification = Routes::auth_email_verificationNotification;
    public Routes $emailVerify = Routes::auth_email_verify;
    public Routes $logout = Routes::auth_logout;

    public function __construct(
        public PasswordNewRoutes   $passwordNew = new PasswordNewRoutes,
        public PasswordResetRoutes $passwordReset = new PasswordResetRoutes,
        public PasswordRoutes      $password = new PasswordRoutes,
        public ProfileRoutes       $profile = new ProfileRoutes,
        public RegisterRoutes      $register = new RegisterRoutes,
    )
    {
    }

    public function logout(): string
    {
        return route_as($this->logout);
    }

    public function emailVerify(): string
    {
        return route_as($this->emailVerify);
    }

    public function emailVerificationNotice(): string
    {
        return route_as($this->emailVerificationNotice);
    }

    public function emailVerificationNotification(): string
    {
        return route_as($this->emailVerificationNotification);
    }

    public function upload(): string
    {
        return route_as($this->upload);
    }
}
