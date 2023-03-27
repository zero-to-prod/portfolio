<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewUser extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public User $user)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(to: 'dasmith@zero-to-prod.com', subject: "New User: {$this->user->name}");
    }

    public function content(): Content
    {
        return new Content(view: 'mail.new_user');
    }
}
