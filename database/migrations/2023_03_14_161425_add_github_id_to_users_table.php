<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::table((new User)->getTable(), static function (Blueprint $table) {
            $table->char(User::github_id)->nullable()->after(User::id)->unique();
            $table->char(User::github_refresh_token)->nullable()->after(User::remember_token)->unique();
            $table->char(User::github_token)->nullable()->after(User::remember_token)->unique();
            $table->char(User::email)->nullable()->change();
            $table->char(User::password)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table((new User)->getTable(), static function (Blueprint $table) {
            $table->dropUnique([User::github_id]);
            $table->dropColumn(User::github_id);
            $table->dropColumn(User::github_token);
            $table->dropColumn(User::github_refresh_token);
            $table->char(User::email)->nullable(false)->change();
        });
    }
};
