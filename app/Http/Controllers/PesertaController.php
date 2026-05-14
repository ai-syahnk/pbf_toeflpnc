<?php

namespace App\Http\Controllers;

use App\Models\HasilTes;
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
                'hasilTes',
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
            'hasil' => $item->hasilTes ? (object) [
                'listening' => (int) $item->hasilTes->listening,
                'structure' => (int) $item->hasilTes->structure,
                'reading' => (int) $item->hasilTes->reading,
                'total_skor' => (int) $item->hasilTes->total_skor,
                'status_kelulusan' => (string) $item->hasilTes->status_kelulusan,
            ] : null,
        ];

        return view('contents.admin.peserta.show', compact('peserta'));
    }

    public function editScore($id)
    {
        $item = PendaftaranTes::query()
            ->with(['hasilTes'])
            ->findOrFail($id);

        $peserta = (object) [
            'id' => $item->id,
            'nomor_pendaftaran' => $item->nomor_pendaftaran ?? '-',
            'nama_peserta' => $item->nama_peserta,
            'hasil' => $item->hasilTes ? (object) [
                'listening' => $item->hasilTes->listening,
                'structure' => $item->hasilTes->structure,
                'reading' => $item->hasilTes->reading,
                'total_skor' => $item->hasilTes->total_skor,
                'status_kelulusan' => $item->hasilTes->status_kelulusan,
            ] : null,
        ];

        return view('contents.admin.peserta.score', compact('peserta'));
    }

    public function storeScore(Request $request, $id)
    {
        $pendaftaran = PendaftaranTes::findOrFail($id);

        $validated = $request->validate([
            'listening' => 'required|integer|min:31|max:68',
            'structure' => 'required|integer|min:31|max:68',
            'reading' => 'required|integer|min:31|max:68',
        ], [
            'listening.required' => 'Skor Listening harus diisi',
            'listening.integer' => 'Skor Listening harus berupa angka',
            'listening.min' => 'Skor Listening minimal 31',
            'listening.max' => 'Skor Listening maksimal 68',
            'structure.required' => 'Skor Structure harus diisi',
            'structure.integer' => 'Skor Structure harus berupa angka',
            'structure.min' => 'Skor Structure minimal 31',
            'structure.max' => 'Skor Structure maksimal 68',
            'reading.required' => 'Skor Reading harus diisi',
            'reading.integer' => 'Skor Reading harus berupa angka',
            'reading.min' => 'Skor Reading minimal 31',
            'reading.max' => 'Skor Reading maksimal 68',
        ]);

        $listening = (int) $validated['listening'];
        $structure = (int) $validated['structure'];
        $reading = (int) $validated['reading'];

        $totalSkor = HasilTes::calculateTotalSkor($listening, $structure, $reading);
        $statusKelulusan = HasilTes::determineStatus($totalSkor);

        HasilTes::updateOrCreate(
            ['pendaftaran_tes_id' => $id],
            [
                'listening' => $listening,
                'structure' => $structure,
                'reading' => $reading,
                'total_skor' => $totalSkor,
                'status_kelulusan' => $statusKelulusan,
                'diinput_pada' => now(),
            ]
        );

        return redirect()
            ->route('admin.peserta.show', $id)
            ->with('success', 'Skor peserta berhasil disimpan. Status kelulusan: ' . str_replace('_', ' ', strtoupper($statusKelulusan)));
    }
}
