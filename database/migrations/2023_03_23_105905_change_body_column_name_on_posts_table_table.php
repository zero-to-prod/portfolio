<?php

use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table((new Post)->getTable(), static function (Blueprint $table) {
            $table->renameColumn('body', 'public_content');
        });
    }

    public function down(): void
    {
        Schema::table((new Post)->getTable(), static function (Blueprint $table) {
            $table->renameColumn('public_content', 'body');
        });
    }
};
