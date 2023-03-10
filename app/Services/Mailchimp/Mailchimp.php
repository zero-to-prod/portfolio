<?php

namespace App\Services\Mailchimp;

use App\Services\Mailchimp\Support\MailchimpSubscriber;
use Illuminate\Contracts\Container\BindingResolutionException;
use MailchimpMarketing\ApiClient;

class Mailchimp
{

    /**
     * @throws BindingResolutionException
     */
    public static function subscribe(MailchimpSubscriber $subscriber): void
    {
        $mailchimp = app()->make(ApiClient::class);
        $mailchimp->lists->addListMember(config('mail.mailchimp.list_id'), $subscriber->toArray());
    }
}