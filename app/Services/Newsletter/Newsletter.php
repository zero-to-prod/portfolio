<?php

namespace App\Services\Newsletter;

use App\Services\Newsletter\Support\MailchimpSubscriber;
use Illuminate\Contracts\Container\BindingResolutionException;
use MailchimpMarketing\ApiClient;

class Newsletter
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