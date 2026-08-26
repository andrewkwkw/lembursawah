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
        Schema::table('agendas', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false)->after('id');
            $table->string('category')->nullable()->after('is_featured');
            $table->string('status')->nullable()->after('location');
            $table->string('registration_url')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agendas', function (Blueprint $table) {
            $table->dropColumn(['is_featured', 'category', 'status', 'registration_url']);
        });
    }
};
