<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Kontak darurat & penjamin
            $table->string('emergency_contact_phone')->nullable()->after('notes');
            $table->string('emergency_contact_relation')->nullable()->after('emergency_contact_phone');

            // Path file dokumen (disimpan di storage)
            $table->string('doc_ktp')->nullable()->after('emergency_contact_relation');
            $table->string('doc_kk')->nullable()->after('doc_ktp');
            $table->string('doc_npwp')->nullable()->after('doc_kk');
            $table->string('doc_ktp_penjamin')->nullable()->after('doc_npwp');
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn([
                'emergency_contact_phone',
                'emergency_contact_relation',
                'doc_ktp',
                'doc_kk',
                'doc_npwp',
                'doc_ktp_penjamin',
            ]);
        });
    }
};
