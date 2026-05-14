<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranTes;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

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

    public function unduhSuratPengambilanPdf(Request $request): Response
    {
        $user = $request->user();
        abort_unless($user !== null, 403);

        $pendaftaran = PendaftaranTes::query()
            ->where('user_id', $user->id)
            ->whereHas('hasilTes')
            ->latest('created_at')
            ->first();

        abort_unless($pendaftaran !== null, 404);

        $identitasPengambil = $user->nim ?: $user->no_ktp;
        $identitasPeserta = $pendaftaran->nim ?: $pendaftaran->no_ktp;
        $statusPeserta = $pendaftaran->status_pendaftar
            ? ucfirst(strtolower($pendaftaran->status_pendaftar))
            : null;

        $tahunSurat = now()->year;
        $nomorUrutSurat = $this->generateNomorSuratPengambilan($pendaftaran, $tahunSurat);
        $nomorSurat = sprintf('%03d/SP-TOEFL/UPA PNC/%d', $nomorUrutSurat, $tahunSurat);

        $pdf = Pdf::loadView('contents.pendaftar.surat.pengambilan-sertifikat.pdf', [
            'logoPath' => public_path('images/logo_pnc_3.png'),
            'nomorSurat' => $nomorSurat,
            'namaPengambil' => $user->name,
            'identitasPengambil' => $identitasPengambil,
            'namaPeserta' => $pendaftaran->nama_peserta,
            'statusPeserta' => $statusPeserta,
            'identitasPeserta' => $identitasPeserta,
        ])->setPaper('a4');

        return $pdf->download(sprintf('surat-pengambilan-sertifikat-%s.pdf', strtolower($user->name)));
    }

    public function unduhSuratKuasaPdf(Request $request): Response
    {
        $user = $request->user();
        abort_unless($user !== null, 403);

        $pendaftaran = PendaftaranTes::query()
            ->where('user_id', $user->id)
            ->whereHas('hasilTes')
            ->with('jadwalTes')
            ->latest('created_at')
            ->first();

        abort_unless($pendaftaran !== null, 404);

        $identitasPeserta = $pendaftaran->nim ?: $pendaftaran->no_ktp;
        $statusPeserta = $pendaftaran->status_pendaftar
            ? ucfirst(strtolower($pendaftaran->status_pendaftar))
            : null;
        $namaTes = $pendaftaran->jadwalTes?->jenis_tes;
        $tanggalTes = $pendaftaran->jadwalTes?->tanggal_tes
            ? tanggal_panjang($pendaftaran->jadwalTes->tanggal_tes)
            : null;

        $tahunSurat = now()->year;
        $nomorUrutSurat = $this->generateNomorSuratPengambilan($pendaftaran, $tahunSurat);
        $nomorSurat = sprintf('%03d/SK-TOEFL/UPA PNC/%d', $nomorUrutSurat, $tahunSurat);

        $pdf = Pdf::loadView('contents.pendaftar.surat.kuasa.pdf', [
            'logoPath' => public_path('images/logo_pnc_3.png'),
            'nomorSurat' => $nomorSurat,
            'namaPeserta' => $pendaftaran->nama_peserta,
            'statusPeserta' => $statusPeserta,
            'identitasPeserta' => $identitasPeserta,
            'namaPenerimaKuasa' => null,
            'identitasPenerimaKuasa' => null,
            'namaTes' => $namaTes,
            'tanggalTes' => $tanggalTes,
        ])->setPaper('a4');

        return $pdf->download(sprintf('surat-kuasa-pengambilan-sertifikat-%s.pdf', strtolower($user->name)));
    }

    private function generateNomorSuratPengambilan(PendaftaranTes $pendaftaran, int $tahunSurat): int
    {
        return DB::transaction(function () use ($pendaftaran, $tahunSurat): int {
            $pendaftaranLocked = PendaftaranTes::query()
                ->lockForUpdate()
                ->find($pendaftaran->id);

            abort_unless($pendaftaranLocked !== null, 404);

            if (
                $pendaftaranLocked->nomor_surat_pengambilan !== null
                && (int) $pendaftaranLocked->nomor_surat_pengambilan_tahun === $tahunSurat
            ) {
                return (int) $pendaftaranLocked->nomor_surat_pengambilan;
            }

            $nomorTerakhir = (int) PendaftaranTes::query()
                ->lockForUpdate()
                ->where('nomor_surat_pengambilan_tahun', $tahunSurat)
                ->max('nomor_surat_pengambilan');

            $nomorBaru = $nomorTerakhir + 1;

            abort_if(
                $nomorBaru > 999,
                422,
                'Nomor surat pengambilan untuk tahun ini sudah mencapai batas maksimal 999.'
            );

            $pendaftaranLocked->forceFill([
                'nomor_surat_pengambilan' => $nomorBaru,
                'nomor_surat_pengambilan_tahun' => $tahunSurat,
            ])->save();

            return $nomorBaru;
        });
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
