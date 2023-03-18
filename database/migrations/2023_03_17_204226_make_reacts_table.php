<?php

use App\Models\React;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create((new React)->getTable(), static function (Blueprint $table) {
            $table->id(React::id);
            $table->foreignIdFor(User::class, React::user_id)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->tinyInteger(React::like)->nullable()->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new React)->getTable());
    }
};
