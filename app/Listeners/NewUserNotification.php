<?php

namespace App\Listeners;

use App\Mail\NewUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

class NewUserNotification
{
    public function handle(Registered $event): void
    {
        Mail::queue(new NewUser($event->user));
    }
}
