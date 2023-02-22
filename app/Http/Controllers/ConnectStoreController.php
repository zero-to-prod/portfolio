<?php

namespace App\Http\Controllers;

use App\Mail\ConnectRequest;
use App\Models\Contact;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Mail;

class ConnectStoreController extends Controller
{
    /**
     * @see ConnectStoreControllerTest
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            Contact::email => Contact::rules(Contact::email),
            Message::subject => Message::rules(Message::subject),
            Message::body => Message::rules(Message::body),
        ]);

        /** @var Message $message */
        $message = Contact::firstOrCreate([
            Contact::email => $validated[Contact::email],
        ])->messages()->create([
            Message::subject => $validated[Message::subject],
            Message::body => $validated[Message::body],
        ])->load('contact');

        Mail::queue(new ConnectRequest($message));

        return back()->with('email', $validated[Contact::email]);
    }
}
