<?php

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
        $request->validate([
            'email' => 'required|email'
        ]);
        $mailchimp = new ApiClient();

        $mailchimp->setConfig([
            'apiKey' => '1e98d1729fcd993bc8e1f9f8e7c96f37-us1',
            'server' => 'us1'
        ]);

        $subscriber = [
            'email_address' => $request->email,
            'status' => 'subscribed',
        ];

        $mailchimp->lists->addListMember('55c42ca7e7', $subscriber);

        return response(['message' => 'success']);
    } catch (ValidationException) {
        return response(['message' => 'invalid email'], 422);
    } catch (GuzzleHttp\Exception\ClientException) {
        return response(['message' => 'subscription failed'], 422);
    }

})->name('subscribe');
