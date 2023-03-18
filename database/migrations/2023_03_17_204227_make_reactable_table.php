<?php

use App\Models\Reactable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create((new Reactable)->getTable(), static function (Blueprint $table) {
            $table->foreignId(Reactable::reaction_id)->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->unsignedBigInteger(Reactable::reactable_id);
            $table->smallInteger(Reactable::reactable_type);

            $table->index([Reactable::reactable_id, Reactable::reactable_type]);

            $table->unique([Reactable::reaction_id, Reactable::reactable_id, Reactable::reactable_type]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new Reactable)->getTable());
    }
};
