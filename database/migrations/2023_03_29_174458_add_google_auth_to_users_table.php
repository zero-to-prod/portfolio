<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table((new User)->getTable(), static function (Blueprint $table) {
            $table->char(User::google_id, 255)->nullable()->after(User::github_id);
            $table->char(User::google_refresh_token, 255)->nullable()->after(User::github_refresh_token);
            $table->char(User::google_token, 255)->nullable()->after(User::github_refresh_token);
        });
    }

    public function down(): void
    {
        Schema::table((new User)->getTable(), static function (Blueprint $table) {
            $table->dropColumn(User::google_id);
            $table->dropColumn(User::google_refresh_token);
            $table->dropColumn(User::google_token);
        });
    }
};
