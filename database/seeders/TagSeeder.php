<?php

namespace Database\Seeders;

use App\Helpers\Tags;
use App\Models\Support\Tag\TagTypes;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        Tag::create([
            Tag::name => Tags::featured->value,
            Tag::type => TagTypes::system->value,
        ]);
        Tag::create([
            Tag::name => Tags::avatar->value,
            Tag::type => TagTypes::system->value,
        ]);
    }
}
