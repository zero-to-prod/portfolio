<?php

use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table((new Post)->getTable(), static function (Blueprint $table) {
            $table->unsignedInteger(Post::dislikes)->after(Post::views)->index()->default(0)->change();
            $table->unsignedInteger(Post::likes)->after(Post::views)->index()->default(0)->change();
        });
    }

    public function down(): void
    {
        Schema::table((new Post)->getTable(), static function (Blueprint $table) {
            $table->dropIndex([Post::dislikes]);
            $table->dropIndex([Post::likes]);
        });
    }
};
