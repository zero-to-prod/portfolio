<?php

use App\Models\Reaction;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create((new Reaction)->getTable(), static function (Blueprint $table) {
            $table->id(Reaction::id);
            $table->foreignIdFor(User::class, Reaction::user_id)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->tinyInteger(Reaction::like)->nullable()->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new Reaction)->getTable());
    }
};
