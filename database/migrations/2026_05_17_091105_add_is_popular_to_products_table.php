<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('products', 'is_popular')) {
            Schema::table('products', function (Blueprint $table) {
                $table->boolean('is_popular')->default(false)->after('stock');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('products', 'is_popular')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('is_popular');
            });
        }
    }
};
