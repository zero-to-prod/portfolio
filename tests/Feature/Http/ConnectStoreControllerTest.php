<?php

namespace Http;

use App\Mail\ConnectRequest;
use App\Models\Contact;
use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mail;
use Route;
use Tests\TestCase;

class ConnectStoreControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see ConnectStoreRedirect::__invoke
     */
    public function stores_a_message_and_creates_a_related_contact(): void
    {
        Mail::fake();

        $email = 'test@domain.com';
        $subject = '315437194327983';
        $data = [
            Contact::email => $email,
            Message::subject => $subject,
            Message::body => 'body',
        ];

        $this->post(to()->web->connectStore(), $data)->assertRedirect()->assertSessionHas('email', $email);

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

        $this->post(to()->web->connectStore(), $data)->assertRedirect();

        self::assertEquals(2, $contact->messages()->count(), 'The contact does not have the correct number of messages.');
        Mail::assertQueued(ConnectRequest::class, 2);
    }

    /**
     * @test
     * @see ConnectStoreRedirect::__invoke
     */
    public function fails_if_nothing_is_not_passed(): void
    {
        $this->post(to()->web->connectStore())->assertFound();
    }

    /**
     * @test
     * @dataProvider getRoutes
     */
    public function check_each_route(string $route): void
    {
        $this->get(route($route))->assertOk();
    }

    public function getRoutes(): array
    {
        $routes = [];

        foreach (Route::getRoutes() as $route) {
            $has_GET_method = in_array('GET', $route->methods(), true);
            $has_middleware = in_array('web_group', $route->gatherMiddleware(), true);

            if ($has_GET_method && $has_middleware) {
                $name = $route->getName();
                $routes["Route: $name"] = [$name];
            }
        }

        return $routes;
    }
}
