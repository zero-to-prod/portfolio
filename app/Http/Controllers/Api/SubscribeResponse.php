<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\EmailSubscription;
use App\Models\Contact;
use App\Services\Newsletter\Newsletter;
use App\Services\Newsletter\Support\MailchimpSubscriber;
use DB;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mail;
use Throwable;

class SubscribeResponse extends Controller
{

    public const email = 'email';
    public const response = ['message' => 'success'];

    /**
     * @throws BindingResolutionException
     * @throws Throwable
     *
     * @see SubscribeResponseTest
     */
    public function __invoke(Request $request): Response|Application|ResponseFactory
    {
        DB::beginTransaction();

        $email = $request->validate([self::email => Contact::rules(Contact::email)])[self::email];

        Newsletter::subscribe(new MailchimpSubscriber(email_address: $email));
        Contact::firstOrCreate([Contact::email => $email]);
        Mail::queue(new EmailSubscription($email));

        DB::commit();

        return response(self::response);
    }
}
