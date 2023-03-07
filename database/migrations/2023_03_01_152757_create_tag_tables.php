<?php

use App\Models\Tag;
use App\Models\Taggable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create((new Tag)->getTable(), static function (Blueprint $table) {
            $table->id();
            $table->json(Tag::name);
            $table->json(Tag::slug);
            $table->string(Tag::type)->nullable();
            $table->integer(Tag::order_column)->nullable();

            $table->timestamps();
        });

        Schema::create((new Taggable)->getTable(), static function (Blueprint $table) {
            $table->foreignId(Taggable::tag_id)->constrained()->cascadeOnDelete();

            $table->unsignedBigInteger(Taggable::taggable_id);
            $table->smallInteger(Taggable::taggable_type);

            $table->index([Taggable::taggable_id, Taggable::taggable_type]);

            $table->unique([Taggable::tag_id, Taggable::taggable_id, Taggable::taggable_type]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new Taggable)->getTable());
        Schema::dropIfExists((new Tag)->getTable());
    }
};
