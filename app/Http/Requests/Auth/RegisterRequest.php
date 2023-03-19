<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

/**
 * @property mixed $name
 * @property mixed $email
 * @property mixed $password
 */
class RegisterRequest extends FormRequest
{
    public const name = 'name';
    public const email = 'email';
    public const password = 'password';

    /**
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            self::name => ['required', 'string', 'max:255'],
            self::email => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            self::password => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function createUser(): User
    {
        return User::create([
            self::name => $this->name,
            self::email => $this->email,
            self::password => Hash::make($this->password),
        ]);
    }
}
