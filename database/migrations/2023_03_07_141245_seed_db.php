<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {

    public function up(): void
    {
        Artisan::call('db:seed', [
            '--class' => 'AdminSeeder',
        ]);
        Artisan::call('db:seed', [
            '--class' => 'TagSeeder',
        ]);
    }
};
