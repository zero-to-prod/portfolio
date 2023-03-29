<?php

namespace App\Models\Support\User;

trait UserColumns
{
    public const github_id = 'github_id';
    public const google_id = 'google_id';
    public const stripe_id = 'stripe_id';
    public const name = 'name';
    public const email = 'email';
    public const email_verified_at = 'email_verified_at';
    public const password = 'password';
    public const remember_token = 'remember_token';
    public const github_token = 'github_token';
    public const github_refresh_token = 'github_refresh_token';
    public const google_token = 'google_token';
    public const google_refresh_token = 'google_refresh_token';
    public const subscribed_at = 'subscribed_at';
}
