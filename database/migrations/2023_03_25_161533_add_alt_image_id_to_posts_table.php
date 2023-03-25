<?php

use App\Models\File;
use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table((new Post)->getTable(), static function (Blueprint $table) {
            $table->foreignId(Post::alt_file_id)
                ->nullable()
                ->after(Post::file_id)
                ->constrained((new File)->getTable())
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->text(Post::public_content)
                ->nullable()
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table((new Post)->getTable(), static function (Blueprint $table) {
            $table->dropForeign([Post::alt_file_id]);
            $table->dropColumn(Post::alt_file_id);
            $table->text(Post::public_content)
                ->nullable(false)
                ->change();
        });
    }
};
