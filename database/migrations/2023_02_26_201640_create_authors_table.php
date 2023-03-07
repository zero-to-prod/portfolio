<?php

use App\Models\Author;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create((new Author)->getTable(), static function (Blueprint $table) {
            $table->id();
            $table->slug();
            $table->name();
            $table->text(Author::bio)->nullable();
            $table->char(Author::title)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new Author)->getTable());
    }
};
