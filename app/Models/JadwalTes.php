<?php

namespace App\Models;

use App\Models\PendaftaranTes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class JadwalTes extends Model
{
    use HasFactory;

    public const JENIS_EPTP = 'EPT-P';
    public const JENIS_ITP = 'ITP';

    protected $table = 'jadwal_tes';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'judul_tes',
        'jenis_tes',
        'tanggal_tes',
        'waktu',
        'lokasi',
        'kuota',
        'harga',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggal_tes' => 'date',
            'kuota' => 'integer',
            'harga' => 'decimal:2',
        ];
    }

    public function pendaftaranTes(): HasMany
    {
        return $this->hasMany(PendaftaranTes::class);
    }

    public function activePendaftaran(): HasMany
    {
        return $this->pendaftaranTes()->where(function (Builder $query): void {
            $query->where('status', PendaftaranTes::STATUS_LUNAS)
                ->orWhere(function (Builder $holdQuery): void {
                    $holdQuery->where('status', PendaftaranTes::STATUS_MENUNGGU_PEMBAYARAN)
                        ->where('hold_expires_at', '>', now());
                });
        });
    }

    public function activeSlotCount(): int
    {
        return $this->activePendaftaran()->count();
    }

    public function hasAvailableSlot(): bool
    {
        return $this->activeSlotCount() < $this->kuota;
    }

    public function isClosed(): bool
    {
        return $this->tanggal_tes !== null && $this->tanggal_tes->isPast();
    }
}
