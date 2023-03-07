<?php

namespace Database\Seeders;

use App\Helpers\Tags;
use App\Helpers\TagTypes;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = collect([
            [
                Tag::name => Tags::featured->value,
                Tag::type => TagTypes::system->value,
            ],
            [
                Tag::name => Tags::avatar->value,
                Tag::type => TagTypes::system->value,
            ],
            [
                Tag::name => Tags::logo->value,
                Tag::type => TagTypes::system->value,
            ],
        ]);
        $tags->each(function ($tag) {
            Tag::create($tag);
        });
    }
}
