<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\File;
use App\Models\Post;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Storage;
use Str;

class PostSeeder extends Seeder
{
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

        $file = Storage::disk('local')->path('generic.png');
        $bucket_path = config('filesystems.disks.s3.bucket_path');
        $file = Storage::disk('s3')->putFile($bucket_path, $file);
        $model = File::create([
            File::path => $bucket_path,
            File::name => explode($bucket_path . '/', $file)[1],
            File::original_name => 'generic.png',
            File::mime_type => 'image/png'
        ]);

        $post = Post::create([
            Post::title => 'First',
            Post::body => $markdown,
        ]);

        $post->publish();

        $post->authors()->attach(Author::first());
        $post->attachTags(['tag', 'tag2', 'tag3']);
        $model->attachTags(['featured']);
        $post->files()->attach($model);

        $faker = Factory::create();

        $post = Post::create([
            Post::title => Str::title($faker->bs),
            Post::body => $faker->paragraph,
        ]);

        $post->publish();

        $post->authors()->attach(Author::first());
        $post->attachTags(['tag2', 'tag3']);
        $model->attachTags(['featured']);
        $post->files()->attach($model);

        $post = Post::create([
            Post::title => Str::title($faker->bs),
            Post::body => $faker->paragraph,
        ]);
        $post->publish();

        $post->authors()->attach(Author::first());
        $post->attachTags(['tag2', 'tag4']);
        $model->attachTags(['featured']);
        $post->files()->attach($model);
    }
}
