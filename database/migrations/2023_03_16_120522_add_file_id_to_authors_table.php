<?php

use App\Models\Author;
use App\Models\File;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table((new Author)->getTable(), static function (Blueprint $table) {
            $table->foreignIdFor(File::class)
                ->nullable()
                ->after(Author::id)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table((new Author)->getTable(), static function (Blueprint $table) {
            $table->dropForeignIdFor(File::class);
            $table->dropColumn(Author::file_id);
        });
    }
};
