<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\JadwalTesController;
use App\Http\Controllers\PesertaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('contents.web.beranda');
});

Route::get('/tentang', function () {
    return view('contents.web.tentang');
})->name('tentang');

Route::get('/jadwal-tes', function () {
    return view('contents.web.jadwal');
})->name('jadwal');

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
        return view('contents.web.beranda');
    })->name('beranda');

    Route::get('/profil', function () {
        return view('contents.pendaftar.profil.index');
    })->name('profil');

    Route::get('/profil/edit', function () {
        return view('contents.pendaftar.profil.edit');
    })->name('profil.edit');

    Route::get('/transaksi/riwayat', function () {
        return view('contents.pendaftar.transaksi.riwayat');
    })->name('transaksi.riwayat');

    Route::get('/transaksi/detail', function () {
        return view('contents.pendaftar.transaksi.detail');
    })->name('transaksi.detail');

    Route::get('/transaksi/kartu-tes', function () {
        return view('contents.pendaftar.kartu-tes.show');
    })->name('transaksi.kartu-tes');

    Route::get('/pendaftaran/step-1', function () {
        return view('contents.pendaftar.pendaftaran.step1-data-diri');
    })->name('pendaftaran.step1');

    Route::get('/pendaftaran/step-2', function () {
        return view('contents.pendaftar.pendaftaran.step2-konfirmasi');
    })->name('pendaftaran.step2');

    Route::get('/pendaftaran/step-3', function () {
        return view('contents.pendaftar.pendaftaran.step3-pembayaran');
    })->name('pendaftaran.step3');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroyAdmin'])->name('logout');

    Route::get('/dashboard', function () {
        return view('contents.admin.dashboard');
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
