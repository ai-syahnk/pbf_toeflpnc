<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index()
    {
        // Dummy data to match the UI design
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
}
