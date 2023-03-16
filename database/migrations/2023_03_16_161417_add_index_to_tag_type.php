<?php

use App\Helpers\TagTypes;
use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Tag::all()->each(function (Tag $tag) {
            $tag->update([Tag::type => $tag->type === 'system' ? TagTypes::system->value : TagTypes::post->value]);
        });

        Schema::table((new Tag)->getTable(), static function (Blueprint $table) {
            $table->unsignedInteger(Tag::type)->index()->change();
        });
    }
};
