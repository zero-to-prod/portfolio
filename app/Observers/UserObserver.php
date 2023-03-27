<?php

namespace App\Observers;

use App\Mail\NewUser;
use App\Models\User;
use Mail;

class UserObserver
{
    public function created(User $user): void
    {
        Mail::queue(new NewUser($user));
    }
}
