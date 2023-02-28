<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{

    public function run(): void
    {
        Author::unguard();
        Author::firstOrCreate(config('author.default'));
    }
}
