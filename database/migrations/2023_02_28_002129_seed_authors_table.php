<?php

use App\Models\Author;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{

    public function up(): void
    {
        if(Author::whereSlug(config('author.default.slug'))->doesntExist()){
            Author::unguard();
            Author::firstOrCreate(config('author.default'));
        }
    }

    public function down(): void
    {
        Author::whereSlug(config('author.default.slug'))->first()?->forceDelete();
    }
};
