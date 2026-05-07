<?php

namespace App\Http\Controllers;

use App\Models\JadwalTes;
use App\Models\PembayaranPendaftaran;
use App\Models\PendaftaranTes;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $statistikPendaftaran = $this->buildStatistikPendaftaran();
        $totalPendapatan = $this->buildTotalPendapatan();
        $totalPeserta = $this->buildTotalPeserta();
        $totalJadwalAktif = $this->buildTotalJadwalAktif();
        $distribusiTes = $this->buildDistribusiTes();
        $statusPeserta = $this->buildStatusPeserta();
        $pendaftaranTerbaru = $this->buildPendaftaranTerbaru();

        return view('contents.admin.dashboard', compact(
            'statistikPendaftaran',
            'totalPendapatan',
            'totalPeserta',
            'totalJadwalAktif',
            'pendaftaranTerbaru',
            'distribusiTes',
            'statusPeserta'
        ));
    }

    /**
     * @return array{labels: array<int, string>, data: array<int, int>}
     */
    private function buildStatistikPendaftaran(): array
    {
        $statistik = ['labels' => [], 'data' => []];

        if (! Schema::hasTable('pendaftaran_tes')) {
            return $statistik;
        }

        $bulanIndonesia = [
            1 => 'JANUARI',
            2 => 'FEBRUARI',
            3 => 'MARET',
            4 => 'APRIL',
            5 => 'MEI',
            6 => 'JUNI',
            7 => 'JULI',
            8 => 'AGUSTUS',
            9 => 'SEPTEMBER',
            10 => 'OKTOBER',
            11 => 'NOVEMBER',
            12 => 'DESEMBER',
        ];

        $pendaftaranByMonth = PendaftaranTes::query()
            ->get(['created_at'])
            ->filter(fn ($item) => $item->created_at?->year === now()->year)
            ->groupBy(fn ($item) => (int) ($item->created_at?->format('n') ?? 0))
            ->map->count();

        $labels = array_values($bulanIndonesia);
        $values = [];
        foreach (range(1, 12) as $bulan) {
            $values[] = (int) ($pendaftaranByMonth[$bulan] ?? 0);
        }

        return [
            'labels' => $labels,
            'data' => $values,
        ];
    }

    private function buildTotalPendapatan(): float
    {
        if (! Schema::hasTable('pembayaran_pendaftaran')) {
            return 0;
        }

        return (float) PembayaranPendaftaran::query()
            ->where('status', PembayaranPendaftaran::STATUS_PAID)
            ->sum('total_tagihan');
    }

    private function buildTotalPeserta(): int
    {
        if (! Schema::hasTable('pendaftaran_tes')) {
            return 0;
        }

        return PendaftaranTes::query()->count('*');
    }

    private function buildTotalJadwalAktif(): int
    {
        if (! Schema::hasTable('jadwal_tes')) {
            return 0;
        }

        return JadwalTes::query()
            ->whereDate('tanggal_tes', '>=', now()->toDateString(), 'and')
            ->count('*');
    }

    /**
     * @return array{labels: array<int, string>, data: array<int, int>, colors: array<int, string>}
     */
    private function buildDistribusiTes(): array
    {
        $default = ['labels' => [], 'data' => [], 'colors' => []];

        if (! Schema::hasTable('pendaftaran_tes') || ! Schema::hasTable('jadwal_tes')) {
            return $default;
        }

        $counts = PendaftaranTes::query()
            ->with('jadwalTes:id,jenis_tes')
            ->get()
            ->groupBy(fn ($item) => $item->jadwalTes?->jenis_tes ?? 'Lainnya')
            ->map->count();

        return [
            'labels' => ['TOEFL ITP', 'TOEFL EPT-P'],
            'data' => [(int) ($counts['ITP'] ?? 0), (int) ($counts['EPT-P'] ?? 0)],
            'colors' => ['#6D28D9', '#F59E0B'],
        ];
    }

    /**
     * @return array{labels: array<int, string>, data: array<int, int>, colors: array<int, string>}
     */
    private function buildStatusPeserta(): array
    {
        $default = ['labels' => [], 'data' => [], 'colors' => []];

        if (! Schema::hasTable('pendaftaran_tes')) {
            return $default;
        }

        $counts = PendaftaranTes::query()
            ->whereNotNull('status_pendaftar', 'and')
            ->get()
            ->groupBy(fn ($item) => strtolower((string) $item->status_pendaftar))
            ->map->count();

        return [
            'labels' => ['Mahasiswa', 'Alumni', 'Umum'],
            'data' => [
                (int) ($counts['mahasiswa'] ?? 0),
                (int) ($counts['alumni'] ?? 0),
                (int) ($counts['umum'] ?? 0),
            ],
            'colors' => ['#6D28D9', '#C4B5FD', '#F59E0B'],
        ];
    }

    private function buildPendaftaranTerbaru(int $limit = 5)
    {
        if (! Schema::hasTable('pendaftaran_tes') || ! Schema::hasTable('jadwal_tes')) {
            return collect();
        }

        return PendaftaranTes::query()
            ->with([
                'jadwalTes:id,judul_tes,jenis_tes',
                'pembayaran:id,pendaftaran_tes_id,total_tagihan,status',
            ])
            ->latest()
            ->limit($limit)
            ->get()
            ->map(static function (PendaftaranTes $item): object {
                $isLunas = $item->status === PendaftaranTes::STATUS_LUNAS
                    || $item->pembayaran?->status === 'paid';

                return (object) [
                    'id' => $item->id,
                    'nomor_pendaftaran' => $item->nomor_pendaftaran ?? '-',
                    'nama_peserta' => $item->nama_peserta,
                    'judul_tes' => $item->jadwalTes?->judul_tes ?? '-',
                    'jenis_tes' => $item->jadwalTes?->jenis_tes ?? '-',
                    'tanggal_daftar' => tanggal_panjang($item->created_at),
                    'total_biaya' => (float) ($item->pembayaran?->total_tagihan ?? $item->harga_tes),
                    'status_bayar' => $isLunas ? 'LUNAS' : 'BELUM LUNAS',
                ];
            });
    }
}
