<?php

use App\Mail\EmailSubscription;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use MailchimpMarketing\ApiClient;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
})->name('user');

Route::middleware('auth:sanctum')->post('/subscribe', function (Request $request) {

    try {
        $validated = $request->validate([
            'email' => 'required|email:dns'
        ]);

        $mailchimp = new ApiClient();

        $mailchimp->setConfig([
            'apiKey' => config('mail.mailchimp.api_key'),
            'server' => config('mail.mailchimp.server')
        ]);

        $subscriber = [
            'email_address' => $validated['email'],
            'status' => 'subscribed',
        ];

        $mailchimp->lists->addListMember(config('mail.mailchimp.list_id'), $subscriber);
        Contact::firstOrCreate([Contact::email => $validated['email']]);
        Mail::queue(new EmailSubscription($validated['email']));

        return response(['message' => 'success']);
    } catch (ValidationException) {
        return response(['message' => 'invalid email'], 422);
    } catch (GuzzleHttp\Exception\ClientException) {
        return response(['message' => 'subscription failed'], 422);
    }

})->name('subscribe');
