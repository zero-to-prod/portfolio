<?php

use App\Models\Author;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table((new Author)->getTable(), static function (Blueprint $table) {
            $table->text(Author::bio)->nullable()->after(Author::name);
            $table->char(Author::title)->nullable()->after(Author::name);
        });
    }

    public function down(): void
    {
        Schema::table((new Author)->getTable(), static function (Blueprint $table) {
            $table->dropColumn(Author::bio);
            $table->dropColumn(Author::title);
        });
    }
};
