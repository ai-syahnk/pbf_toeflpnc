@extends('layouts.admin.main')

@section('title', 'Tambah Jadwal Baru')

@section('content')
    <div class="row">
        <div class="col-12">
            <h5 class="fw-bold mb-4">Tambah Jadwal Baru</h5>

            <form action="#" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="judul_tes" class="form-label fw-bold">Judul Tes</label>
                    <input type="text" class="form-control" id="judul_tes" name="judul_tes" style="border-color: #6D28D9; border-radius: 12px; padding: 6px 12px;">
                </div>

                <div class="mb-3">
                    <label for="jenis_tes" class="form-label fw-bold">Jenis Tes</label>
                    <select class="form-select" id="jenis_tes" name="jenis_tes" style="border-color: #6D28D9; border-radius: 12px; padding: 6px 12px; background-image: url('data:image/svg+xml,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 16 16%27%3e%3cpath fill=%27none%27 stroke=%27%236D28D9%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%272%27 d=%27m2 5 6 6 6-6%27/%3e%3c/svg%3e');">
                        <option value="" selected>Pilih Jenis Tes</option>
                        <option value="EPT-P">EPT-P</option>
                        <option value="ITP">ITP</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tanggal_tes" class="form-label fw-bold">Tanggal Tes</label>
                    <input type="date" class="form-control" id="tanggal_tes" name="tanggal_tes" style="border-color: #6D28D9;border-radius: 12px; padding: 6px 12px;">
                </div>

                <div class="mb-3">
                    <label for="waktu" class="form-label fw-bold">Waktu</label>
                    <input type="text" class="form-control" id="waktu" name="waktu" style="border-color: #6D28D9;border-radius: 12px; padding: 6px 12px;">
                </div>

                <div class="mb-3">
                    <label for="lokasi" class="form-label fw-bold">Lokasi</label>
                    <input type="text" class="form-control" id="lokasi" name="lokasi" style="border-color: #6D28D9;border-radius: 12px; padding: 6px 12px;">
                </div>

                <div class="mb-3">
                    <label for="kouta" class="form-label fw-bold">Kuota</label>
                    <input type="text" class="form-control" id="kouta" name="kouta" style="border-color: #6D28D9;border-radius: 12px; padding: 6px 12px;">
                </div>

                <div class="mb-4">
                    <label for="harga" class="form-label fw-bold">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="0" style="border-color: #6D28D9;border-radius: 12px; padding: 6px 12px;">
                </div>

                <div class="d-grid mt-5">
                    <button type="submit" class="btn text-white py-2 fw-bold" style="background-color: #6D28D9; border-radius: 30px; font-size: 1.1rem;">
                        Simpan Jadwal
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
