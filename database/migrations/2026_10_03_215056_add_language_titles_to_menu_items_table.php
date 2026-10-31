<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->string('title_hy')->nullable()->after('title');
            $table->string('title_ru')->nullable()->after('title_hy');
            $table->string('title_en')->nullable()->after('title_ru');
        });
    }

    public function down(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropColumn([
                'title_hy',
                'title_ru',
                'title_en',
            ]);
        });
    }
};
