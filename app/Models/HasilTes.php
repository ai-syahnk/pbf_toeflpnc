<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilTes extends Model
{
    const STATUS_LULUS = 'lulus';
    const STATUS_TIDAK_LULUS = 'tidak_lulus';
    const PASS_THRESHOLD = 400;

    protected $table = 'hasil_tes';

    protected $fillable = [
        'pendaftaran_tes_id',
        'listening',
        'structure',
        'reading',
        'total_skor',
        'status_kelulusan',
        'diinput_pada',
    ];

    protected $casts = [
        'listening' => 'integer',
        'structure' => 'integer',
        'reading' => 'integer',
        'total_skor' => 'integer',
        'diinput_pada' => 'datetime',
    ];

    public function pendaftaranTes()
    {
        return $this->belongsTo(PendaftaranTes::class, 'pendaftaran_tes_id');
    }

    /**
     * Calculate total score from component scores
     * Formula: round(((listening + structure + reading) * 10) / 3)
     */
    public static function calculateTotalSkor($listening, $structure, $reading)
    {
        return (int) round((($listening + $structure + $reading) * 10) / 3);
    }

    /**
     * Determine pass/fail status based on total score
     */
    public static function determineStatus($totalSkor)
    {
        return $totalSkor > self::PASS_THRESHOLD ? self::STATUS_LULUS : self::STATUS_TIDAK_LULUS;
    }

    /**
     * Check if result is passing
     */
    public function isLulus()
    {
        return $this->status_kelulusan === self::STATUS_LULUS;
    }
}
