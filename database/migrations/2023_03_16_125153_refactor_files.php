<?php

use App\Models\Author;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {

    public function up(): void
    {
        Author::all()->each(function (Author $author) {
            $author->update([Author::file_id => $author->avatar()?->id]);
        });
        Tag::all()->each(function (Tag $tag) {
            $tag->update([Tag::file_id => $tag->logo()?->id]);
        });
        Post::all()->each(function (Post $tag) {
            $tag->update([Post::file_id => $tag->featuredImage()?->id]);
        });
    }
};
