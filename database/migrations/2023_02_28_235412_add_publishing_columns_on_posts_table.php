<?php

use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table((new Post)->getTable(), static function (Blueprint $table) {
            $table->timestamp(Post::published_at)->after(Post::reading_time)->nullable();
            $table->longText(Post::published_content)->after(Post::reading_time)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table((new Post)->getTable(), static function (Blueprint $table) {
            $table->dropColumn(Post::published_at);
            $table->dropColumn(Post::published_content);
        });
    }
};
