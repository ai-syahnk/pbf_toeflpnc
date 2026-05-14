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
        Schema::table('pendaftaran_tes', function (Blueprint $table): void {
            $table->unsignedSmallInteger('nomor_surat_pengambilan')->nullable()->after('nomor_kursi');
            $table->unsignedSmallInteger('nomor_surat_pengambilan_tahun')->nullable()->after('nomor_surat_pengambilan');

            $table->unique(
                ['nomor_surat_pengambilan_tahun', 'nomor_surat_pengambilan'],
                'pendaftaran_tes_nomor_surat_pengambilan_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran_tes', function (Blueprint $table): void {
            $table->dropUnique('pendaftaran_tes_nomor_surat_pengambilan_unique');
            $table->dropColumn([
                'nomor_surat_pengambilan_tahun',
                'nomor_surat_pengambilan',
            ]);
        });
    }
};
