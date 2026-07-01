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
        Schema::table('alternatif', function (Blueprint $table) {
            $table->dropColumn('kode_hex');
            $table->string('kode_warna')->nullable()->after('nama_warna');
            $table->string('gambar_warna')->nullable()->after('kode_warna');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alternatif', function (Blueprint $table) {
            $table->string('kode_hex')->nullable();
            $table->dropColumn(['kode_warna', 'gambar_warna']);
        });
    }
};
