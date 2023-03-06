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
        return $this->withFeaturedImage()->withAuthor()
            ->afterCreating(function (Post $post): void {
                $post->publish();
            });
    }

    public function withFeaturedImage(): self
    {
        return $this->afterCreating(function (Post $post) {
            $post->files()->attach(file_f()->featuredImage()->create());
        });
    }

    public function withAuthor(): self
    {
        return $this->afterCreating(function (Post $post) {
            $post->authors()->attach(author_f()->withAvatar()->create());
        });
    }
}
