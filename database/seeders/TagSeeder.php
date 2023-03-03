<?php

namespace Database\Seeders;

use App\Helpers\Tags;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        Tag::create([
            Tag::name => Tags::featured->value,
            Tag::type => 'system',
        ]);
        Tag::create([
            Tag::name => Tags::avatar->value,
            Tag::type => 'system',
        ]);
    }
}
