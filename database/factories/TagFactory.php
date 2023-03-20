<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Author>
 */
class TagFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            Tag::name => 'tag',
            Tag::slug => 'tag',
        ];
    }
}
