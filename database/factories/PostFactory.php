<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
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
        return $this->withFile()->withAuthor()
            ->afterCreating(function (Post $post): void {
                $post->publish();
            });
    }

    public function withFile(): self
    {
        return $this->state(function (): array {
            return [Post::file_id => file_f()->create()->id];
        });
    }

    public function withAuthor(): self
    {
        return $this->afterCreating(function (Post $post) {
            $post->authors()->attach(author_f()->withAvatar()->create());
        });
    }
}
