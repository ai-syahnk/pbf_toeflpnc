<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\JadwalTesController;
use App\Http\Controllers\PendaftaranTesController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\TransaksiPendaftarController;
use App\Models\JadwalTes;
use App\Models\PendaftaranTes;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

if (! function_exists('loadLatestJadwalTes')) {
    function loadLatestJadwalTes(int $limit = 2)
    {
        if (! Schema::hasTable('jadwal_tes')) {
            return collect();
        }

        return JadwalTes::query()
            ->orderBy('tanggal_tes', 'asc')
            ->orderBy('waktu', 'asc')
            ->limit($limit)
            ->get();
    }
}

if (! function_exists('loadLatestPendaftaranTerbaru')) {
    function loadLatestPendaftaranTerbaru(int $limit = 5)
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
            ->get();
    }
}

Route::get('/', function () {
    $jadwalTes = loadLatestJadwalTes();

    return view('contents.web.beranda', compact('jadwalTes'));
});

Route::get('/tentang', function () {
    return view('contents.web.tentang');
})->name('tentang');

Route::get('/jadwal-tes', [JadwalTesController::class, 'publicIndex'])->name('jadwal');

Route::get('/hasil-tes', function () {
    return view('contents.web.hasiltes');
})->name('hasiltes');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');

    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

Route::post('/logout', [LoginController::class, 'destroy'])->name('logout')->middleware('auth');

// Protected Routes (Dashboard)
Route::middleware('auth')->group(function () {
    Route::get('/beranda', function () {
        $jadwalTes = loadLatestJadwalTes();

        return view('contents.web.beranda', compact('jadwalTes'));
    })->name('beranda');

    Route::get('/profil', function () {
        return view('contents.pendaftar.profil.index');
    })->name('profil');

    Route::get('/profil/edit', function () {
        return view('contents.pendaftar.profil.edit');
    })->name('profil.edit');

    Route::prefix('/transaksi')->name('transaksi.')->group(function () {
        Route::get('/riwayat', [TransaksiPendaftarController::class, 'riwayat'])->name('riwayat');
        Route::get('/{pendaftaranTes}', [TransaksiPendaftarController::class, 'detail'])->name('detail');
        Route::get('/{pendaftaranTes}/kartu-tes', [TransaksiPendaftarController::class, 'kartuTes'])->name('kartu-tes');
    });

    Route::prefix('/pendaftaran')->name('pendaftaran.')->group(function () {
        Route::get('/mulai/{jadwalTes}', [PendaftaranTesController::class, 'mulai'])->name('mulai');
        Route::get('/{pendaftaranTes}/step-1', [PendaftaranTesController::class, 'step1'])->name('step1');
        Route::post('/{pendaftaranTes}/step-1', [PendaftaranTesController::class, 'simpanStep1'])->name('step1.store');
        Route::get('/{pendaftaranTes}/step-2', [PendaftaranTesController::class, 'step2'])->name('step2');
        Route::post('/{pendaftaranTes}/konfirmasi', [PendaftaranTesController::class, 'konfirmasi'])->name('konfirmasi');
        Route::get('/{pendaftaranTes}/step-3', [PendaftaranTesController::class, 'step3'])->name('step3');
        Route::post('/{pendaftaranTes}/bayar', [PendaftaranTesController::class, 'bayar'])->name('bayar');
    });
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroyAdmin'])->name('logout');

    Route::get('/dashboard', function () {
        $pendaftaranTerbaru = loadLatestPendaftaranTerbaru()->map(static function (PendaftaranTes $item): object {
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

        return view('contents.admin.dashboard', compact('pendaftaranTerbaru'));
    })->name('dashboard');

    Route::get('/jadwal-tes', [JadwalTesController::class, 'index'])->name('jadwal-tes');
    Route::get('/jadwal-tes/create', [JadwalTesController::class, 'create'])->name('jadwal-tes.create');
    Route::post('/jadwal-tes', [JadwalTesController::class, 'store'])->name('jadwal-tes.store');
    Route::get('/jadwal-tes/{jadwalTes}/edit', [JadwalTesController::class, 'edit'])->name('jadwal-tes.edit');
    Route::put('/jadwal-tes/{jadwalTes}', [JadwalTesController::class, 'update'])->name('jadwal-tes.update');
    Route::delete('/jadwal-tes/{jadwalTes}', [JadwalTesController::class, 'destroy'])->name('jadwal-tes.destroy');
    Route::get('/jadwal-tes/{jadwalTes}', [JadwalTesController::class, 'show'])->name('jadwal-tes.show');

    Route::get('/peserta', [PesertaController::class, 'index'])->name('peserta');
    Route::get('/peserta/{id}', [PesertaController::class, 'show'])->name('peserta.show');
    Route::get('/peserta/{id}/score', [PesertaController::class, 'editScore'])->name('peserta.score');
});
