<?php

namespace App\Models;

use App\Models\PembayaranPendaftaran;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

class PendaftaranTes extends Model
{
    use HasFactory;

    public const STATUS_DRAFT = 'draft';
    public const STATUS_MENUNGGU_PEMBAYARAN = 'menunggu_pembayaran';
    public const STATUS_LUNAS = 'lunas';
    public const STATUS_KEDALUWARSA = 'kedaluwarsa';
    public const STATUS_DIBATALKAN = 'dibatalkan';

    protected $table = 'pendaftaran_tes';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'jadwal_tes_id',
        'nomor_pendaftaran',
        'current_step',
        'status',
        'harga_tes',
        'hold_expires_at',
        'dibayar_pada',
        'nomor_kursi',
        'nama_peserta',
        'email_peserta',
        'jenis_kelamin',
        'status_pendaftar',
        'nim',
        'program_studi',
        'tahun_lulus',
        'no_ktp',
        'no_wa',
        'keperluan_tes',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'current_step' => 'integer',
            'harga_tes' => 'decimal:2',
            'hold_expires_at' => 'datetime',
            'dibayar_pada' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jadwalTes(): BelongsTo
    {
        return $this->belongsTo(JadwalTes::class);
    }

    public function pembayaran(): HasOne
    {
        return $this->hasOne(PembayaranPendaftaran::class);
    }

    public function isExpired(): bool
    {
        return $this->status === self::STATUS_MENUNGGU_PEMBAYARAN
            && $this->hold_expires_at !== null
            && $this->hold_expires_at->isPast();
    }

    public function hasBiodata(): bool
    {
        return filled($this->nama_peserta)
            && filled($this->email_peserta)
            && filled($this->status_pendaftar)
            && filled($this->no_wa)
            && filled($this->keperluan_tes);
    }

    public function canAccessStep2(): bool
    {
        return $this->hasBiodata();
    }

    public function canAccessStep3(): bool
    {
        return in_array($this->status, [self::STATUS_MENUNGGU_PEMBAYARAN, self::STATUS_LUNAS], true)
            && filled($this->nomor_pendaftaran);
    }

    public function canShowKartuTes(): bool
    {
        return $this->status === self::STATUS_LUNAS;
    }

    public function markAsExpired(): void
    {
        $this->forceFill([
            'status' => self::STATUS_KEDALUWARSA,
            'current_step' => 2,
            'hold_expires_at' => null,
        ])->save();

        $this->pembayaran()->update([
            'status' => PembayaranPendaftaran::STATUS_EXPIRED,
            'expired_at' => now(),
        ]);
    }

    public function markAsPaid(?Carbon $paidAt = null): void
    {
        $paidAt ??= now();

        $this->forceFill([
            'status' => self::STATUS_LUNAS,
            'dibayar_pada' => $paidAt,
            'hold_expires_at' => null,
            'current_step' => 3,
        ])->save();

        $this->pembayaran()->update([
            'status' => PembayaranPendaftaran::STATUS_PAID,
            'paid_at' => $paidAt,
        ]);
    }

    public function scopeOwnedBy(Builder $query, User $user): Builder
    {
        return $query->where('user_id', $user->id);
    }

    public function scopeForHistory(Builder $query): Builder
    {
        return $query->latest()->with(['jadwalTes', 'pembayaran']);
    }
}
