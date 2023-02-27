<?php

use App\Models\Author;
use App\Models\AuthorPost;
use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create((new AuthorPost)->getTable(), static function (Blueprint $table) {
            $table->foreignIdFor(Author::class)->constrained()->cascadeOnUpdate()->cascadeOnUpdate();
            $table->foreignIdFor(Post::class)->constrained()->cascadeOnUpdate()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new AuthorPost)->getTable());
    }
};
