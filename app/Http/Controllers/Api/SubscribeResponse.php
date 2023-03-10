<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\EmailSubscription;
use App\Models\Contact;
use App\Services\Mailchimp\Mailchimp;
use App\Services\Mailchimp\Support\MailchimpSubscriber;
use DB;
use GuzzleHttp\Exception\ClientException;
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

    /**
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function __invoke(Request $request): Response|Application|ResponseFactory
    {
        try {

            DB::beginTransaction();

            $email = $request->validate([self::email => Contact::rules(Contact::email)])[self::email];

            Mailchimp::subscribe(new MailchimpSubscriber(email_address: $email));
            Contact::firstOrCreate([Contact::email => $email]);
            Mail::queue(new EmailSubscription($email));

            DB::commit();

            return response(['message' => 'success']);
        } catch (ClientException) {
            return response(['message' => 'subscription failed'], 422);
        }
    }
}
