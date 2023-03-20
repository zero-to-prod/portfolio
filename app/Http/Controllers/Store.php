<?php

namespace App\Http\Controllers;

use App\Mail\ConnectRequest;
use App\Models\Contact;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Mail;

class Store extends Controller
{
    public const email = 'email';
    public const subject = 'subject';
    public const body = 'body';

    /**
     * @see ConnectStoreControllerTest
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            self::email => Contact::rules(Contact::email),
            self::subject => Message::rules(Message::subject),
            self::body => Message::rules(Message::body),
        ]);

        /** @var Message $message */
        $message = Contact::firstOrCreate([
            self::email => $validated[self::email],
        ])->messages()->create([
            self::subject => $validated[self::subject],
            self::body => $validated[self::body],
        ])->load(Message::contact);

        Mail::queue(new ConnectRequest($message));

        return back()->with(self::email, $validated[self::email]);
    }
}
