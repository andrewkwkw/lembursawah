<?php

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
        Schema::table('products', function (Blueprint $table) {
            $table->index('category');
            $table->index('is_featured');
        });

        Schema::table('attractions', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
            $table->index('category');
            $table->index('difficulty');
        });

        Schema::table('tour_packages', function (Blueprint $table) {
            $table->index('is_popular');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->index('category');
        });

        Schema::table('agendas', function (Blueprint $table) {
            $table->index('is_featured');
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropIndex(['type']);
        });

        Schema::table('agendas', function (Blueprint $table) {
            $table->dropIndex(['is_featured']);
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropIndex(['category']);
        });

        Schema::table('tour_packages', function (Blueprint $table) {
            $table->dropIndex(['is_popular']);
        });

        Schema::table('attractions', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropIndex(['category']);
            $table->dropIndex(['difficulty']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['category']);
            $table->dropIndex(['is_featured']);
        });
    }
};
