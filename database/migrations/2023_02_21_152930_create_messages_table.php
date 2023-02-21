<?php

use App\Models\Contact;
use App\Models\Message;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create((new Message)->getTable(), static function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Contact::class)->constrained();
            $table->char(Message::subject)->nullable();
            $table->text(Message::body)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new Message)->getTable());
    }
};
