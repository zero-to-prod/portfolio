<?php

namespace Tests\Feature;

use App\Http\Routes;
use App\Models\Contact;
use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConnectControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see ConnectController::__invoke
     */
    public function stores_a_message_and_creates_a_related_contact(): void
    {
        $email = 'test@domain.com';
        $subject = '315437194327983';
        $data = [
            Contact::email => $email,
            Message::subject => $subject,
            Message::body => 'body',
        ];

        $this->postRoute(Routes::connect, $data)->assertOk();

        $message = Message::whereSubject($subject)->first();
        $contact = $message?->contact;
        self::assertNotNull($message, 'Message was not created.');
        self::assertEquals($email, $message->contact->email, 'The contact email does not match the email in the form.');
        self::assertEquals(1, $contact->messages()->count(), 'The contact does not have the correct number of messages.');


        /* Sets up another test verifying the same contact can have multiple messages. */

        $data = [
            Contact::email => $contact->email,
            Message::subject => 'subject',
            Message::body => 'body',
        ];

        $this->postRoute(Routes::connect, $data)->assertOk();

        self::assertEquals(2, $contact->messages()->count(), 'The contact does not have the correct number of messages.');
    }

    /**
     * @test
     * @see ConnectController::__invoke
     */
    public function fails_if_nothing_is_not_passed(): void
    {
        $this->postRoute(Routes::connect)->assertFound();
    }
}
