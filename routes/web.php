<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HasilTesController;
use App\Http\Controllers\JadwalTesController;
use App\Http\Controllers\PendaftaranTesController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\TransaksiPendaftarController;
use Illuminate\Support\Facades\Route;

Route::get('/', [JadwalTesController::class, 'beranda']);

Route::get('/tentang', function () {
    return view('contents.web.tentang');
})->name('tentang');

Route::get('/jadwal-tes', [JadwalTesController::class, 'publicIndex'])->name('jadwal');

Route::get('/hasil-tes', [HasilTesController::class, 'index'])->middleware('auth')->name('hasiltes');

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
    Route::get('/beranda', [JadwalTesController::class, 'beranda'])->name('beranda');

    Route::get('/profil', [ProfilController::class, 'show'])->name('profil');
    Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');

    Route::prefix('/transaksi')->name('transaksi.')->group(function () {
        Route::get('/riwayat', [TransaksiPendaftarController::class, 'riwayat'])->name('riwayat');
        Route::get('/{pendaftaranTes}', [TransaksiPendaftarController::class, 'detail'])->name('detail');
        Route::get('/{pendaftaranTes}/kartu-tes', [TransaksiPendaftarController::class, 'kartuTes'])->name('kartu-tes');
        Route::get('/{pendaftaranTes}/kartu-tes/pdf', [TransaksiPendaftarController::class, 'unduhKartuTesPdf'])->name('kartu-tes.pdf');
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

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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
    Route::post('/peserta/{id}/score', [PesertaController::class, 'storeScore'])->name('peserta.score.store');
});
