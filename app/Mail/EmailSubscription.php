<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailSubscription extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public string $email)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            to: 'dasmith@zero-to-prod.com',
            subject: 'Subscription: ' . $this->email,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.email_subscription'
        );
    }
}
