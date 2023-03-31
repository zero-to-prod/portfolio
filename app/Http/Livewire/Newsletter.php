<?php

namespace App\Http\Livewire;

use App\Mail\EmailSubscription;
use App\Models\Contact;
use App\Services\Newsletter\Support\MailchimpSubscriber;
use DB;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Mail;
use Throwable;

class Newsletter extends Component
{
    public const email = 'email';
    public const errors = 'errors';
    public ?string $email;

    public function rules(): array
    {
        return [
            self::email => Contact::rules(Contact::email),
        ];
    }

    /**
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function submit(): void
    {
        $validated = $this->validate();
        try {
            DB::beginTransaction();

            $email = $validated[self::email];

            \App\Services\Newsletter\Newsletter::subscribe(new MailchimpSubscriber(email_address: $email));
            Contact::firstOrCreate([Contact::email => $email]);
            Mail::queue(new EmailSubscription($email));
            DB::commit();

        } catch (Exception) {
            $this->addError(self::errors, 'Something went wrong. Try another email.');
        }
        $this->redirect(to()->newsletter_success());
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.newsletter');
    }
}
