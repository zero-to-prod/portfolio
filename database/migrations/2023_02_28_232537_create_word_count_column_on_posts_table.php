<?php

use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table((new Post)->getTable(), static function (Blueprint $table) {
            $table->string('reading_time')
                ->nullable()
                ->after(Post::body)
                ->virtualAs("round(((LENGTH(body) - LENGTH(REPLACE(body, ' ', '')) + 1) * .9) / 183)")
                ->comment("The estimated reading time in minutes. The .9 constant accounts for the added syntax that occurs in markdown. The constant 183 is the average words per minute.");
        });
    }

    public function down(): void
    {
        Schema::table((new Post)->getTable(), static function (Blueprint $table) {
            $table->dropColumn(Post::reading_time);
        });
    }
};
