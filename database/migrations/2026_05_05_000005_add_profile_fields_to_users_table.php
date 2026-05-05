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
        Schema::table('users', function (Blueprint $table): void {
            $table->string('jenis_kelamin', 20)->nullable()->after('role');
            $table->string('status_pendaftar', 20)->nullable()->after('jenis_kelamin');
            $table->string('nim', 50)->nullable()->after('status_pendaftar');
            $table->string('program_studi')->nullable()->after('nim');
            $table->string('tahun_lulus', 4)->nullable()->after('program_studi');
            $table->string('no_ktp', 30)->nullable()->after('tahun_lulus');
            $table->string('no_wa', 30)->nullable()->after('no_ktp');
            $table->string('keperluan_tes')->nullable()->after('no_wa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn([
                'jenis_kelamin',
                'status_pendaftar',
                'nim',
                'program_studi',
                'tahun_lulus',
                'no_ktp',
                'no_wa',
                'keperluan_tes',
            ]);
        });
    }
};
