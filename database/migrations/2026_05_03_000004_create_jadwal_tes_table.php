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
        Schema::create('jadwal_tes', function (Blueprint $table): void {
            $table->id();
            $table->string('judul_tes');
            $table->enum('jenis_tes', ['EPT-P', 'ITP']);
            $table->date('tanggal_tes');
            $table->string('waktu', 100);
            $table->string('lokasi');
            $table->unsignedInteger('kuota');
            $table->decimal('harga', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_tes');
    }
};
