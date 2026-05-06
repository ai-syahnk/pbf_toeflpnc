<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranTes;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $query = PendaftaranTes::query()
            ->with([
                'jadwalTes:id,judul_tes,jenis_tes',
                'pembayaran:id,pendaftaran_tes_id,total_tagihan,status',
            ])
            ->latest();

        if ($search !== '') {
            $query->where(function ($builder) use ($search): void {
                $builder->where('nama_peserta', 'like', '%'.$search.'%')
                    ->orWhere('nomor_pendaftaran', 'like', '%'.$search.'%');
            });
        }

        $peserta = $query->get()->map(static function (PendaftaranTes $item): object {
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

        return view('contents.admin.peserta.index', compact('peserta'));
    }

    public function show($id)
    {
        $peserta = (object) [
            'id' => $id,
            'nomor_pendaftaran' => 'TOEFL-101-260226-013',
            'tanggal_daftar' => '26 Februari 2026',
            'status_bayar' => 'LUNAS',
            'tes' => (object) [
                'nama' => 'Special Ramadhan Batch 1 - EPT-P',
                'jenis' => 'TOEFL EPT-P',
                'tanggal' => '9 Maret 2026',
                'waktu' => '09:00 - 11:00 WIB',
                'lokasi' => 'Lab. Bahasa GKB Lantai 2',
            ],
            'peserta' => (object) [
                'nama' => 'Aika Eva Darlene',
                'jenis_kelamin' => 'Perempuan',
                'status' => 'Mahasiswa',
                'nim' => '250132102',
                'program_studi' => 'D3 Teknik Informatika',
                'no_wa' => '081234567890',
                'email' => 'aikaeva_darlene.stu@pnc.ac.id',
                'keperluan' => 'Syarat Kelulusan',
            ],
            'pembayaran' => (object) [
                'total' => 100000,
                'metode' => 'QRIS',
            ],
            'hasil' => (object) [
                'listening' => 52,
                'structure' => 50,
                'reading' => 56,
                'total_skor' => 523,
                'status' => 'LULUS',
            ],
        ];

        return view('contents.admin.peserta.show', compact('peserta'));
    }

    public function editScore($id)
    {
        $peserta = (object) [
            'id' => $id,
            'nomor_pendaftaran' => 'TOEFL-101-260226-013',
            'nama_peserta' => 'Aika Eva Darlene',
        ];

        return view('contents.admin.peserta.score', compact('peserta'));
    }
}
