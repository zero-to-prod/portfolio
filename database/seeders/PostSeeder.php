<?php

namespace Database\Seeders;

use App\Helpers\Tags;
use App\Models\Author;
use App\Models\Post;
use App\Models\Tag;
use Database\Seeders\Support\UploadsFile;
use Exception;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Str;

class PostSeeder extends Seeder
{
    use UploadsFile;

    /**
     * @throws Exception
     */
    public function run(): void
    {
        $markdown = <<<'MARKDOWN'
# h1 Heading
## h2 Heading
### h3 Heading
#### h4 Heading

## Code

Inline `code`

Indented code

    // Some comments
    line 1 of code
    line 2 of code
    line 3 of code


Block code "fences"

```
Sample text here...
```

Syntax highlighting

``` js
var foo = function (bar) {
  return bar++;
};

console.log(foo(5));
```
MARKDOWN;

        $image = $this->uploadFile('php.png');
        $php = Tag::create([Tag::name => 'PHP', Tag::type => Tags::post->value]);
        $image->tagLogo();
        $php->files()->attach($image);

        $image = $this->uploadFile('laravel.png');
        $laravel = Tag::create([Tag::name => 'Laravel', Tag::type => Tags::post->value]);
        $image->tagLogo();
        $laravel->files()->attach($image);

        $image = $this->uploadFile('docker.png');
        $docker = Tag::create([Tag::name => 'Docker', Tag::type => Tags::post->value]);
        $image->tagLogo();
        $docker->files()->attach($image);

        $image = $this->uploadFile('react.png');
        $react = Tag::create([Tag::name => 'React', Tag::type => Tags::post->value]);
        $image->tagLogo();
        $react->files()->attach($image);

        $image = $this->uploadFile('ts.png');
        $ts = Tag::create([Tag::name => 'TypeScript', Tag::type => Tags::post->value]);
        $image->tagLogo();
        $ts->files()->attach($image);

        $featured_image = $this->uploadFile('generic.png');
        $faker = Factory::create();
        $post = Post::create([
            Post::title => 'First',
            Post::body => $markdown,
            Post::subtitle => $faker->sentence,
        ]);

        $post->authors()->attach(Author::first());
        $post->attachTags([$laravel, $docker, $php]);
        $featured_image->tagFeaturedImage();
        $post->files()->attach($featured_image);

        $post->publish();

        for ($i = 0; $i < 4; $i++) {
            $post = Post::create([
                Post::title => Str::title($faker->bs),
                Post::subtitle => $faker->sentence,
                Post::body => $faker->paragraph,
            ]);

            $post->authors()->attach(Author::first());
            $post->attachTags([$laravel, $docker, $php, $react, $ts]);
            $featured_image->tagFeaturedImage();
            $post->files()->attach($featured_image);
            $post->publish();

        }

        $post = Post::create([
            Post::title => Str::title($faker->bs),
            Post::body => $faker->paragraph,
            Post::subtitle => $faker->sentence,
        ]);

        $post->authors()->attach(Author::first());
        $post->attachTags([$php, $react]);
        $featured_image->tagFeaturedImage();
        $post->files()->attach($featured_image);
        $post->publish();

        $post = Post::create([
            Post::title => Str::title($faker->bs),
            Post::body => $faker->paragraph,
            Post::subtitle => $faker->sentence,
        ]);

        $post->authors()->attach(Author::first());
        $post->attachTags([$laravel, $react]);
        $featured_image->tagFeaturedImage();
        $post->files()->attach($featured_image);

        $post = Post::create([
            Post::title => Str::title($faker->bs),
            Post::body => $faker->paragraph,
            Post::subtitle => $faker->sentence,
        ]);

        $post->authors()->attach(Author::first());
        $post->attachTags([$php, $react, $ts]);
        $featured_image->tagFeaturedImage();
        $post->files()->attach($featured_image);

        $post->publish();
    }
}
