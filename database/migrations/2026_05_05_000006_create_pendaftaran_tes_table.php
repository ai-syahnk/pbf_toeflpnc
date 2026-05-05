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
        Schema::create('pendaftaran_tes', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('jadwal_tes_id')->constrained('jadwal_tes')->restrictOnDelete();
            $table->string('nomor_pendaftaran')->nullable()->unique();
            $table->unsignedTinyInteger('current_step')->default(1);
            $table->enum('status', ['draft', 'menunggu_pembayaran', 'lunas', 'kedaluwarsa', 'dibatalkan'])
                ->default('draft');
            $table->decimal('harga_tes', 12, 2)->default(0);
            $table->timestamp('hold_expires_at')->nullable();
            $table->timestamp('dibayar_pada')->nullable();
            $table->string('nomor_kursi', 50)->nullable();
            $table->string('nama_peserta');
            $table->string('email_peserta');
            $table->string('jenis_kelamin', 20)->nullable();
            $table->string('status_pendaftar', 20)->nullable();
            $table->string('nim', 50)->nullable();
            $table->string('program_studi')->nullable();
            $table->string('tahun_lulus', 4)->nullable();
            $table->string('no_ktp', 30)->nullable();
            $table->string('no_wa', 30)->nullable();
            $table->string('keperluan_tes')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'jadwal_tes_id']);
            $table->index(['jadwal_tes_id', 'status', 'hold_expires_at'], 'pendaftaran_tes_jadwal_status_hold_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_tes');
    }
};
