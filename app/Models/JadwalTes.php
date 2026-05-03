<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTes extends Model
{
    use HasFactory;

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
}
