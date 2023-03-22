<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use App\Models\User;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Stripe\StripeClient;
use Throwable;

class Subform extends Component
{
    public const plan = 'plan';
    public const email = 'email';
    public const card = 'card';
    public const month = 'month';
    public const year = 'year';
    public const cvc = 'cvc';

    public $plan = 'year';
    public $email;
    public $card;
    public $month = '';
    public $year = '';
    public $cvc;

    public function rules(): array
    {
        return [
            self::email => Contact::rules(Contact::email),
            self::card => 'required|numeric|digits_between:13,19',
            self::month => 'required',
            self::year => 'required',
            self::cvc => 'required|numeric|digits_between:3,4'
        ];
    }

    /**
     * @throws ValidationException
     */
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function submit(): void
    {
        $this->validate();
        try {
            DB::beginTransaction();
            $stripe = app()->make(StripeClient::class);

            $customer = $stripe->customers->create([self::email => $this->email]);
            $payment_method = $stripe->paymentMethods->create([
                'type' => 'card',
                'card' => [
                    'number' => $this->card,
                    'exp_month' => $this->month,
                    'exp_year' => $this->year,
                    'cvc' => $this->cvc,
                ],
            ]);
            $stripe->paymentMethods->attach($payment_method->id, ['customer' => $customer->id]);
            $stripe->subscriptions->create([
                'customer' => $customer->id,
                'items' => [
                    ['price' => $this->plan === 'month' ? config('stripe.monthly_plan') : config('stripe.yearly_plan')],
                ],
                'default_payment_method' => $payment_method->id,
                'trial_period_days' => 7,
            ]);
            $user = User::updateOrCreate([User::email => $this->email], [
                User::stripe_id => $customer->id,
                User::subscribed_at => now(),
            ]);
            DB::commit();
            if ($user->password === null && $user->github_id === null) {
                $this->redirect(to()->subscribe_addPassword($user));
            } else {
                Auth::login($user);

                $this->redirect(to()->subscribe_success());
            }

        } catch (Exception $e) {
            $this->addError('errors', $e->getMessage());
        } catch (Throwable $e) {
            $this->addError('errors', $e->getMessage());
        }
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.subform');
    }
}
