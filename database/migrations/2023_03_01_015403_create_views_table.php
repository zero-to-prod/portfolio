<?php

use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\View;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create((new View)->getTable(), static function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Post::class)->constrained()->cascadeOnUpdate()->cascadeOnUpdate();
            $table->char(View::ip)->nullable();
            $table->char(View::user_agent)->nullable();
            $table->char(View::locale)->nullable();
            $table->timestamp(View::created_at)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new View)->getTable());
    }
};
