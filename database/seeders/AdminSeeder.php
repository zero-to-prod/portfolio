<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            User::name => 'david',
            User::email => 'dave0016@gmail.com',
            User::password => '$2y$10$D5v9wt15ueSqFYXAGDddiusqlWn2tK25kgdXhp79Us4uifQB2m//a',
        ]);
    }
}
