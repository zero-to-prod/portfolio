<?php

use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table((new Post)->getTable(), static function (Blueprint $table) {
            $table->unsignedInteger(Post::dislikes)->after(Post::views)->default(0);
            $table->unsignedInteger(Post::likes)->after(Post::views)->default(0);
        });
    }

    public function down(): void
    {
        Schema::table((new Post)->getTable(), static function (Blueprint $table) {
            $table->dropColumn(Post::dislikes);
            $table->dropColumn(Post::likes);
        });
    }
};
