<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class ThanksResponse extends Controller
{

    public const email = 'email';
    public const amount = 'amount';
    public const card_number = 'card_number';
    public const expiration = 'expiration';
    public const exp_year = 'exp_year';
    public const cvc = 'cvc';
    public const response = ['message' => 'success'];

    /**
     * @throws BindingResolutionException|ApiErrorException
     */
    public function __invoke(Request $request): Response|Application|ResponseFactory
    {
        $validated = $request->validate([
            self::email => Contact::rules(Contact::email),
            self::amount => 'required|numeric',
            self::card_number => 'required|numeric|digits_between:13,19',
            self::expiration => 'required|date_format:m / y',
            self::cvc => 'required|numeric|digits_between:3,4'
        ]);
        $month = explode(' / ', $validated[self::expiration])[0];
        $year = explode(' / ', $validated[self::expiration])[1];

        $stripe = app()->make(StripeClient::class);

        $customer = $stripe->customers->create(['email' => $validated[self::email],]);
        $paymentMethod = $stripe->paymentMethods->create([
            'type' => 'card',
            'card' => [
                'number' => $validated[self::card_number],
                'exp_month' => $month,
                'exp_year' => $year,
                'cvc' => $validated[self::cvc],
            ],
        ]);
        $stripe->paymentMethods->attach($paymentMethod->id, ['customer' => $customer->id]);
        $payment_intent = $stripe->paymentIntents->create([
            'amount' => $validated[self::amount] * 100,
            'currency' => 'usd',
            'customer' => $customer->id,
            'receipt_email' => $validated[self::email],
            'description' => 'Thank you for supporting!',
        ]);
        $stripe->paymentIntents->confirm($payment_intent->id, ['payment_method' => $paymentMethod->id]);

        return response(self::response);
    }
}
