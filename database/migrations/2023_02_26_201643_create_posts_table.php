<?php

use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create((new Post)->getTable(), static function (Blueprint $table) {
            $table->id();
            $table->slug();
            $table->char(Post::title);
            $table->char(Post::subtitle)->nullable();
            $table->longText(Post::body);
            $table->longText(Post::published_content)->nullable();
            $table->unsignedInteger(Post::published_word_count)->nullable();
            $table->string(Post::reading_time)->nullable()
                ->virtualAs("ceil(published_word_count / 183)")
                ->comment("The estimated reading time in minutes. The constant 183 is the average words per minute.");
            $table->timestamp(Post::originally_published_at)->nullable();
            $table->timestamp(Post::published_at)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new Post)->getTable());
    }
};
