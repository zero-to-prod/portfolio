<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ConnectController extends Controller
{
    /**
     * @see ConnectControllerTest
     */
    public function __invoke(Request $request): Response
    {
        $validated = $request->validate([
            Contact::email => Contact::rules(Contact::email),
            Message::subject => Message::rules(Message::subject),
            Message::body => Message::rules(Message::body),
        ]);

        Contact::firstOrCreate([
            Contact::email => $validated[Contact::email],
        ])->messages()->create([
            Message::subject => $validated[Message::subject],
            Message::body => $validated[Message::body],
        ]);

        return new Response();
    }
}
