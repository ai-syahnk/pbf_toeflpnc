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
        $item = PendaftaranTes::query()
            ->with([
                'jadwalTes:id,judul_tes,jenis_tes,tanggal_tes,waktu,lokasi',
                'pembayaran:id,pendaftaran_tes_id,metode,total_tagihan,status',
            ])
            ->findOrFail($id);

        $isLunas = $item->status === PendaftaranTes::STATUS_LUNAS
            || $item->pembayaran?->status === 'paid';

        $peserta = (object) [
            'id' => $item->id,
            'nomor_pendaftaran' => $item->nomor_pendaftaran ?? '-',
            'tanggal_daftar' => tanggal_panjang($item->created_at),
            'status_bayar' => $isLunas ? 'LUNAS' : 'BELUM LUNAS',
            'tes' => (object) [
                'nama' => $item->jadwalTes?->judul_tes ?? '-',
                'jenis' => $item->jadwalTes?->jenis_tes ?? '-',
                'tanggal' => $item->jadwalTes?->tanggal_tes ? tanggal_panjang($item->jadwalTes->tanggal_tes) : '-',
                'waktu' => $item->jadwalTes?->waktu ?? '-',
                'lokasi' => $item->jadwalTes?->lokasi ?? '-',
            ],
            'peserta' => (object) [
                'nama' => $item->nama_peserta,
                'jenis_kelamin' => $item->jenis_kelamin ?? '-',
                'status' => $item->status_pendaftar ?? '-',
                'nim' => $item->nim ?? '-',
                'program_studi' => $item->program_studi ?? '-',
                'tahun_lulus' => $item->tahun_lulus ?? '-',
                'no_ktp' => $item->no_ktp ?? '-',
                'no_wa' => $item->no_wa ?? '-',
                'email' => $item->email_peserta,
                'keperluan' => $item->keperluan_tes ?? '-',
            ],
            'pembayaran' => (object) [
                'total' => (float) ($item->pembayaran?->total_tagihan ?? $item->harga_tes),
                'metode' => $item->pembayaran?->metode ?? '-',
            ],
            // Hasil tes belum tersimpan di tabel terpisah pada skema saat ini.
            'hasil' => (object) [
                'listening' => '-',
                'structure' => '-',
                'reading' => '-',
                'total_skor' => '-',
                'status' => '-',
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
