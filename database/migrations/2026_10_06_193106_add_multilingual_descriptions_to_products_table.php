<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('description_hy')->nullable()->after('description');
            $table->text('description_ru')->nullable()->after('description_hy');
            $table->text('description_en')->nullable()->after('description_ru');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'description_hy',
                'description_ru',
                'description_en',
            ]);
        });
    }
};
