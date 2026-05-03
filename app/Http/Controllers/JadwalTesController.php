<?php

namespace App\Http\Controllers;

use App\Models\JadwalTes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class JadwalTesController extends Controller
{
    public function index(): View
    {
        $jadwalTes = JadwalTes::query()
            ->orderBy('tanggal_tes', 'asc')
            ->orderBy('waktu', 'asc')
            ->get();

        return view('contents.admin.jadwal-tes.index', compact('jadwalTes'));
    }

    public function create(): View
    {
        return view('contents.admin.jadwal-tes.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul_tes' => ['required', 'string', 'max:255'],
            'jenis_tes' => ['required', 'in:EPT-P,ITP'],
            'tanggal_tes' => ['required', 'date'],
            'waktu' => ['required', 'string', 'max:100'],
            'lokasi' => ['required', 'string', 'max:255'],
            'kuota' => ['required', 'integer', 'min:1'],
            'harga' => ['required', 'numeric', 'min:0'],
        ], [
            'judul_tes.required' => 'Judul tes harus diisi.',
            'judul_tes.max' => 'Judul tes maksimal 255 karakter.',
            'jenis_tes.required' => 'Jenis tes harus dipilih.',
            'jenis_tes.in' => 'Jenis tes yang dipilih tidak valid.',
            'tanggal_tes.required' => 'Tanggal tes harus diisi.',
            'tanggal_tes.date' => 'Format tanggal tes tidak valid.',
            'waktu.required' => 'Waktu tes harus diisi.',
            'waktu.max' => 'Waktu tes maksimal 100 karakter.',
            'lokasi.required' => 'Lokasi tes harus diisi.',
            'lokasi.max' => 'Lokasi tes maksimal 255 karakter.',
            'kuota.required' => 'Kuota harus diisi.',
            'kuota.integer' => 'Kuota harus berupa angka bulat.',
            'kuota.min' => 'Kuota minimal 1 peserta.',
            'harga.required' => 'Harga harus diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh kurang dari 0.',
        ]);

        try {
            JadwalTes::create($validated);
        } catch (Throwable) {
            return back()
                ->withInput()
                ->with('error', 'Data jadwal gagal disimpan. Silakan coba lagi.');
        }

        return redirect()
            ->route('admin.jadwal-tes')
            ->with('success', 'Data jadwal tes berhasil ditambahkan.');
    }
}
