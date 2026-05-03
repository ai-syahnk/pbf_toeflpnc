<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index()
    {
        $peserta = [
            (object) [
                'id' => 1,
                'nomor_pendaftaran' => 'TOEFL-101-260226-013',
                'nama_peserta' => 'Aika Eva Darlene',
                'jenis_tes' => 'TOEFL EPT-P',
                'tanggal_daftar' => '26 Februari 2026',
                'total_biaya' => 100000,
                'status_bayar' => 'LUNAS',
            ],
            (object) [
                'id' => 2,
                'nomor_pendaftaran' => 'TOEFL-102-250701-020',
                'nama_peserta' => 'Aika Eva Darlene',
                'jenis_tes' => 'TOEFL ITP',
                'tanggal_daftar' => '1 Juli 2025',
                'total_biaya' => 100000,
                'status_bayar' => 'LUNAS',
            ],
        ];

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
