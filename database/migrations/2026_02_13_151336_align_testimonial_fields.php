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
        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('occupation')->nullable()->after('name');
            $table->renameColumn('message', 'content');
            $table->boolean('is_active')->default(true)->after('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn('occupation');
            $table->renameColumn('content', 'message');
            $table->dropColumn('is_active');
        });
    }
};
