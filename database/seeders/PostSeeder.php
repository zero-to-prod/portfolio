<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Post;
use Illuminate\Database\Seeder;

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

        $post = Post::create([
            Post::title => 'First',
            Post::body => $markdown,
        ]);

        $post->publish();

        $post->authors()->attach(Author::first());
        $post->attachTag('tag');

        $post = Post::create([
            Post::title => 'Second',
            Post::body => $markdown,
        ]);

        $post->publish();

        $post->authors()->attach(Author::first());
        $post->attachTag('tag');
    }
}
