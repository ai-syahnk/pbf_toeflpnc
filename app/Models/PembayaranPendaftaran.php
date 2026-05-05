<?php

namespace App\Models;

use App\Models\PendaftaranTes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PembayaranPendaftaran extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';
    public const STATUS_PAID = 'paid';
    public const STATUS_EXPIRED = 'expired';
    public const STATUS_CANCELLED = 'cancelled';

    protected $table = 'pembayaran_pendaftaran';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'pendaftaran_tes_id',
        'metode',
        'total_tagihan',
        'status',
        'paid_at',
        'expired_at',
        'gateway_reference',
        'qr_payload',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'total_tagihan' => 'decimal:2',
            'paid_at' => 'datetime',
            'expired_at' => 'datetime',
        ];
    }

    public function pendaftaranTes(): BelongsTo
    {
        return $this->belongsTo(PendaftaranTes::class);
    }

    public function isExpired(): bool
    {
        return $this->status === self::STATUS_PENDING
            && $this->expired_at !== null
            && $this->expired_at->isPast();
    }
}
