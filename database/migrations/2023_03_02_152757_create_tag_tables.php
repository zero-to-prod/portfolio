<?php

use App\Models\Fileable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create((new Fileable)->getTable(), static function (Blueprint $table) {
            $table->foreignId(Fileable::file_id)->constrained()->cascadeOnDelete();

            $table->unsignedBigInteger(Fileable::fileable_id);
            $table->smallInteger(Fileable::fileable_type);

            $table->index([Fileable::fileable_id, Fileable::fileable_type]);

            $table->unique([Fileable::file_id, Fileable::fileable_id, Fileable::fileable_type]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new Fileable)->getTable());
    }
};
