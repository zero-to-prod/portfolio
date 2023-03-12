<?php

namespace App\Helpers;

class AuthRoutesHelper
{

    public Routes $upload = Routes::auth_upload;
    public Routes $emailVerificationNotice = Routes::auth_email_verificationNotice;
    public Routes $emailVerificationNotification = Routes::auth_email_verificationNotification;
    public Routes $emailVerify = Routes::auth_email_verify;
    public Routes $logout = Routes::auth_logout;

    public function __construct(
        public AuthPasswordNewRoutesHelper   $passwordNew = new AuthPasswordNewRoutesHelper,
        public AuthPasswordResetRoutesHelper $passwordReset = new AuthPasswordResetRoutesHelper,
        public AuthPasswordRoutesHelper      $password = new AuthPasswordRoutesHelper,
        public AuthProfileRoutesHelper       $profile = new AuthProfileRoutesHelper,
        public AuthRegisterRoutesHelper      $register = new AuthRegisterRoutesHelper,
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
