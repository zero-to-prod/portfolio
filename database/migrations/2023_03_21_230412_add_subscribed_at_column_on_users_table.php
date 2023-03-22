<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table((new User)->getTable(), static function (Blueprint $table) {
            $table->timestamp(User::subscribed_at)->after(User::github_refresh_token)->nullable();
            $table->string(User::stripe_id)->after(User::github_id)->nullable();
            $table->string(User::name)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table((new User)->getTable(), static function (Blueprint $table) {
            $table->dropColumn(User::subscribed_at);
            $table->dropColumn(User::stripe_id);
            $table->string(User::name)->nullable(false)->change();
        });
    }
};
