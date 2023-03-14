<?php

use App\Helpers\Roles;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;

return new class extends Migration
{

    public function up(): void
    {
        Role::create(['name' => Roles::super_admin->value]);
        Role::create(['name' => Roles::contributor->value]);
        $user = User::where(User::email, config('admin.user')[User::email])->firstOrFail();
        $user->assignRole(Roles::super_admin->value);
    }
};
