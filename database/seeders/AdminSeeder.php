<?php

namespace Database\Seeders;

use App\Helpers\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create(config('admin.user'));
        $user->assignRole(Roles::super_admin->value);
    }
}
