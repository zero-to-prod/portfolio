<?php

use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table((new Post)->getTable(), static function (Blueprint $table) {
            $table->unsignedInteger(Post::exclusive_word_count)
                ->after(Post::public_reading_time)
                ->nullable();
        });

        Schema::table((new Post)->getTable(), static function (Blueprint $table) {
            $table->string(Post::exclusive_reading_time)->nullable()
                ->virtualAs("ceil(exclusive_word_count / 183)")
                ->after(Post::exclusive_word_count)
                ->comment("The estimated reading time in minutes. The constant 183 is the average words per minute.");
        });
    }

    public function down(): void
    {
        Schema::table((new Post)->getTable(), static function (Blueprint $table) {
            $table->dropColumn([Post::exclusive_reading_time, Post::exclusive_word_count]);
        });
    }
};
