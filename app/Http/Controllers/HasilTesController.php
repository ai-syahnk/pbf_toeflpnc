<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranTes;
use Illuminate\Support\Facades\Auth;

class HasilTesController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get all registered tests with hasil data for the logged-in user
        $pendaftaranList = PendaftaranTes::query()
            ->where('user_id', $user->id)
            ->with(['jadwalTes', 'hasilTes'])
            ->latest('created_at')
            ->get();

        // Filter only those that have hasil data
        $hasilList = $pendaftaranList
            ->filter(fn ($p) => $p->hasilTes !== null)
            ->map(fn ($p) => $this->formatHasil($p))
            ->values();

        // Get the latest/utama result (most recent by jadwal_tes tanggal_tes)
        $hasilUtama = $hasilList
            ->sortByDesc(fn ($h) => $h['jadwal_tanggal_tes'])
            ->first();

        return view('contents.web.hasiltes', compact('hasilList', 'hasilUtama'));
    }

    /**
     * Format pendaftaran data with hasil for display
     */
    private function formatHasil(PendaftaranTes $pendaftaran): array
    {
        $hasil = $pendaftaran->hasilTes;

        return [
            'id' => $pendaftaran->id,
            'nomor_pendaftaran' => $pendaftaran->nomor_pendaftaran ?? '-',
            'tanggal_daftar' => $pendaftaran->created_at,
            'jenis_tes' => $pendaftaran->jadwalTes?->jenis_tes ?? '-',
            'jadwal_tanggal_tes' => $pendaftaran->jadwalTes?->tanggal_tes,
            'jadwal_tanggal_tes_formatted' => $pendaftaran->jadwalTes?->tanggal_tes
                ? tanggal_panjang($pendaftaran->jadwalTes->tanggal_tes)
                : '-',
            'listening' => $hasil->listening,
            'structure' => $hasil->structure,
            'reading' => $hasil->reading,
            'total_skor' => $hasil->total_skor,
            'status_kelulusan' => $hasil->status_kelulusan,
            'diinput_pada' => $hasil->diinput_pada,
        ];
    }
}
