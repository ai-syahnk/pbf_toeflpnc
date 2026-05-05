<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranTes;
use Illuminate\Http\Request;
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

    private function ensureOwnedByCurrentUser(Request $request, PendaftaranTes $pendaftaranTes): void
    {
        abort_unless($request->user()?->id === $pendaftaranTes->user_id, 404);
    }
}
