<?php

use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table((new Post)->getTable(), static function (Blueprint $table) {
            $table->string(Post::reading_time)
                ->nullable()
                ->after(Post::published_word_count)
                ->virtualAs("ceil(published_word_count / 183)")
                ->comment("The estimated reading time in minutes. The constant 183 is the average words per minute.");
        });
    }

    public function down(): void
    {
        Schema::table((new Post)->getTable(), static function (Blueprint $table) {
            $table->dropColumn(Post::reading_time);
        });
    }
};
