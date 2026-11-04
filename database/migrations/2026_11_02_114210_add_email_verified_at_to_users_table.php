<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'email_verified_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->timestamp('email_verified_at')->nullable();
            });
        }
    }

    public function down(): void
    {
        // Դաշտը կարող էր գոյություն ունենալ մինչև այս migration-ը։
        // Այդ պատճառով այն չենք ջնջում։
    }
};
