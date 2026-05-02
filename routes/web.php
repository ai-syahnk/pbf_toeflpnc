<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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
        return view('contents.pendaftar.kartu_tes.show');
    })->name('transaksi.kartu-tes');
});
