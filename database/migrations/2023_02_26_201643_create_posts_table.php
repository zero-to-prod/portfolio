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
            $table->char(Post::subtitle);
            $table->longText(Post::body);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new Post)->getTable());
    }
};
