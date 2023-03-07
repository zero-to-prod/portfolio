<?php

namespace Database\Factories;

use App\Models\File;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends Factory<File>
 */
class FileFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            File::path => config('filesystems.file_disk_path'),
            File::name => Str::random(),
            File::mime_type => 'image/jpeg',
            File::original_name => 'test.jpg',
        ];
    }

    public function featuredImage(): self
    {
        return $this->afterCreating(function(File $file){
            $file->tagFeaturedImage();
        });
    }

    public function avatar(): self
    {
        return $this->afterCreating(function(File $file){
            $file->tagAvatar();
        });
    }
}
