<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('bookable_type')->nullable()->change();
            $table->unsignedBigInteger('bookable_id')->nullable()->change();
            $table->string('service_category')->nullable()->after('customer_email');
            $table->string('service_name')->nullable()->after('service_category');
            $table->string('driver_option')->nullable()->after('service_name');
            $table->string('location')->nullable()->after('driver_option');
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['service_category', 'service_name', 'driver_option', 'location']);
            $table->string('bookable_type')->nullable(false)->change();
            $table->unsignedBigInteger('bookable_id')->nullable(false)->change();
        });
    }
};
