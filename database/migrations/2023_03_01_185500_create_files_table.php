<?php

use App\Models\File;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create((new File)->getTable(), static function (Blueprint $table) {
            $table->id();
            $table->char(File::path);
            $table->char(File::name);
            $table->char(File::mime_type);
            $table->char(File::original_name);
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists((new File)->getTable());
    }
};
