<?php

namespace App\Providers;

use App\Helpers\Roles;
use App\Models\User;
use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        Gate::before(static function (User $user) {
            return $user->hasRole(Roles::super_admin->value) ? true : null;
        });
    }
}
