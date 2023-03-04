<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Post;
use Database\Seeders\Support\UploadsFile;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Str;

class PostSeeder extends Seeder
{
    use UploadsFile;

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

        $featured_image = $this->uploadFile('generic.png');

        $post = Post::create([
            Post::title => 'First',
            Post::body => $markdown,
        ]);

        $post->publish();

        $post->authors()->attach(Author::first());
        $post->attachTags(['Laravel', 'Refactoring', 'PHP']);
        $featured_image->tagFeaturedImage();
        $post->files()->attach($featured_image);

        $faker = Factory::create();

        $post = Post::create([
            Post::title => Str::title($faker->bs),
            Post::body => $faker->paragraph,
        ]);

        $post->publish();

        $post->authors()->attach(Author::first());
        $post->attachTags(['Refactoring', 'PHP']);
        $featured_image->tagFeaturedImage();
        $post->files()->attach($featured_image);

        $post = Post::create([
            Post::title => Str::title($faker->bs),
            Post::body => $faker->paragraph,
        ]);
        $post->publish();

        $post->authors()->attach(Author::first());
        $post->attachTags(['Refactoring', 'Deep Dive']);
        $featured_image->tagFeaturedImage();
        $post->files()->attach($featured_image);

        $post = Post::create([
            Post::title => Str::title($faker->bs),
            Post::body => $faker->paragraph,
        ]);

        $post->authors()->attach(Author::first());
        $post->attachTags(['Laravel', 'Deep Dive']);
        $featured_image->tagFeaturedImage();
        $post->files()->attach($featured_image);

        $post = Post::create([
            Post::title => Str::title($faker->bs),
            Post::body => $faker->paragraph,
        ]);
        $post->publish();

        $post->authors()->attach(Author::first());
        $post->attachTags(['Clean Code', 'Automation', 'PHP']);
        $featured_image->tagFeaturedImage();
        $post->files()->attach($featured_image);
    }
}
