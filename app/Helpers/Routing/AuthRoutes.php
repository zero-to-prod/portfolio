<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;

class AuthRoutes
{

    public Routes $upload = Routes::auth_upload;
    public Routes $emailVerificationNotice = Routes::auth_email_verificationNotice;
    public Routes $emailVerificationNotification = Routes::auth_email_verificationNotification;

    public function __construct(
        public GithubRoutes        $github = new GithubRoutes,
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
        return route_as(Routes::logout);
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
