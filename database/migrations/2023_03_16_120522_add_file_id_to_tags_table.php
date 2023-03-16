<?php

use App\Models\File;
use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table((new Tag)->getTable(), static function (Blueprint $table) {
            $table->foreignIdFor(File::class)
                ->nullable()
                ->after(Tag::id)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table((new Tag)->getTable(), static function (Blueprint $table) {
            $table->dropForeignIdFor(File::class);
            $table->dropColumn(Tag::file_id);
        });
    }
};
