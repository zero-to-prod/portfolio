<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Author>
 */
class AuthorFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            Author::name => $this->faker->name,
        ];
    }

    public function withAvatar(): self
    {
        return $this->afterCreating(function (Author $author) {
            $author->files()->sync([file_f()->avatar()->create()->tagAvatar()->id]);
        });
    }
}
