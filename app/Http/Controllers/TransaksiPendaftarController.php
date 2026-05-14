<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PendaftaranTes;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\View\View;

class TransaksiPendaftarController extends Controller
{
    public function riwayat(Request $request): View
    {
        $user = $request->user();

        abort_unless($user !== null, 403);

        $riwayatPendaftaran = PendaftaranTes::query()
            ->ownedBy($user)
            ->forHistory()
            ->get();

        return view('contents.pendaftar.transaksi.riwayat', compact('riwayatPendaftaran'));
    }

    public function detail(Request $request, PendaftaranTes $pendaftaranTes): View
    {
        $this->ensureOwnedByCurrentUser($request, $pendaftaranTes);

        $pendaftaranTes->loadMissing(['jadwalTes', 'pembayaran']);
        // dd($pendaftaranTes);
        return view('contents.pendaftar.transaksi.detail', compact('pendaftaranTes'));
    }

    public function kartuTes(Request $request, PendaftaranTes $pendaftaranTes): View
    {
        $this->ensureOwnedByCurrentUser($request, $pendaftaranTes);
        abort_unless($pendaftaranTes->canShowKartuTes(), 403);

        $pendaftaranTes->loadMissing(['jadwalTes', 'pembayaran']);

        return view('contents.pendaftar.kartu-tes.show', compact('pendaftaranTes'));
    }

    public function unduhKartuTesPdf(Request $request, PendaftaranTes $pendaftaranTes): Response
    {
        $this->ensureOwnedByCurrentUser($request, $pendaftaranTes);
        abort_unless($pendaftaranTes->canShowKartuTes(), 403);

        $pendaftaranTes->loadMissing(['jadwalTes', 'pembayaran']);

        $pdf = Pdf::loadView('contents.pendaftar.kartu-tes.pdf', [
            'pendaftaranTes' => $pendaftaranTes,
            'logoPath' => public_path('images/logo_pnc_2.png'),
        ])->setPaper('a4');

        return $pdf->download(sprintf('kartu-tes-%s.pdf', $pendaftaranTes->nomor_pendaftaran));
    }

    private function ensureOwnedByCurrentUser(Request $request, PendaftaranTes $pendaftaranTes): void
    {
        abort_unless($request->user()?->id === $pendaftaranTes->user_id, 404);
    }
}
