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
        Schema::create('pembayaran_pendaftaran', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('pendaftaran_tes_id')
                ->constrained('pendaftaran_tes')
                ->cascadeOnDelete();
            $table->string('metode', 50)->default('QRIS');
            $table->decimal('total_tagihan', 12, 2)->default(0);
            $table->enum('status', ['pending', 'paid', 'expired', 'cancelled'])->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->string('gateway_reference')->nullable();
            $table->text('qr_payload')->nullable();
            $table->timestamps();

            $table->unique('pendaftaran_tes_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_pendaftaran');
    }
};
