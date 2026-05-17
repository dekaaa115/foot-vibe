<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Ubah icon jadi image di tabel categories
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('icon');
            $table->string('image')->nullable()->after('slug');
        });

        // 2. Tambahkan relasi kategori di tabel products
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->string('icon')->default('fa-box');
        });
    }
};
