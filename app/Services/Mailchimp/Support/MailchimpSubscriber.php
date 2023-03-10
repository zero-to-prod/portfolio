<?php

namespace App\Services\Mailchimp\Support;

use App\Helpers\ToArray;

readonly class MailchimpSubscriber
{
    use ToArray;

    public function __construct(
        public string  $email_address,
        public ?string $status = 'subscribed',
    )
    {
    }

}