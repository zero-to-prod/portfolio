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
        return $this->state(function (): array {
            return [Author::file_id => file_f()->create()->id];
        });
    }
}
