<?php

namespace App\Http\Livewire;

use App\Models\User;
use Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Livewire\Component;

class AddPassword extends Component
{
    public User $user;
    public string $password;

    public function rules(): array
    {
        return [
            'password' => ['required', Rules\Password::defaults()]
        ];
    }

    public function submit(): void
    {
        $this->validate();
        $user = $this->user;
        $user->update([
            User::password => Hash::make($this->password)
        ]);
        event(new Registered($user));
//        $user->sendEmailVerificationNotification();

        Auth::login($user);
        $this->redirect(to()->subscribe_success());
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.add-password');
    }
}
