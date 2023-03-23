<?php

use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table((new Post)->getTable(), static function (Blueprint $table) {
            $table->text(Post::cta)->after(Post::public_content)->nullable();
            $table->text(Post::published_cta)->after(Post::published_public_content)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table((new Post)->getTable(), static function (Blueprint $table) {
            $table->dropColumn(Post::cta);
            $table->dropColumn(Post::published_cta);
        });
    }
};
