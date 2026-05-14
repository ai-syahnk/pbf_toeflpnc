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
        Schema::create('hasil_tes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_tes_id')
                ->unique()
                ->constrained('pendaftaran_tes')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('listening')->comment('Score 31-68');
            $table->unsignedTinyInteger('structure')->comment('Score 31-68');
            $table->unsignedTinyInteger('reading')->comment('Score 31-68');

            $table->unsignedSmallInteger('total_skor')->comment('Calculated: round(((L+S+R)*10)/3)');
            $table->enum('status_kelulusan', ['lulus', 'tidak_lulus'])->default('tidak_lulus');

            $table->timestamp('diinput_pada')->nullable()->useCurrent();

            $table->timestamps();

            $table->index('status_kelulusan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_tes');
    }
};
