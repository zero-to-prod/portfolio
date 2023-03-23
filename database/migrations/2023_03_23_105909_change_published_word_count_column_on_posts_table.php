<?php

use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table((new Post)->getTable(), static function (Blueprint $table) {
            $table->dropColumn('reading_time');
            $table->renameColumn('published_word_count', Post::public_word_count);
        });

        Schema::table((new Post)->getTable(), static function (Blueprint $table) {
            $table->string(Post::public_reading_time)->nullable()
                ->virtualAs("ceil(public_word_count / 183)")
                ->after(Post::public_word_count)
                ->comment("The estimated reading time in minutes. The constant 183 is the average words per minute.");
        });
    }
};
