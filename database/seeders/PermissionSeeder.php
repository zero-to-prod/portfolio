<?php

namespace Database\Seeders;

use App\Helpers\Roles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['name' => Roles::super_admin->value]);
        Role::create(['name' => Roles::contributor->value]);
    }
}
