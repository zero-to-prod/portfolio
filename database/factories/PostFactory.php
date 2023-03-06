<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            Post::title => $this->faker->sentence,
            Post::body => $this->faker->paragraph,
        ];
    }

    public function published(): self
    {
        return $this->state(fn() => [
            Post::published_at => now(),
        ]);
    }
}
