<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConnectRequest extends Mailable
{
    use Queueable, SerializesModels;


    public function __construct(public Message $message_model)
    {


    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            to: 'dasmith@zero-to-prod.com',
            subject: $this->message_model->subject,
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'mail.connect_request'
        );
    }
}
