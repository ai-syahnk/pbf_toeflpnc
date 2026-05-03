@extends('layouts.admin.main')

@section('title', 'Tambah Jadwal Baru')

@section('content')
    <div class="row">
        <div class="col-12">
            <h5 class="fw-bold mb-4">Tambah Jadwal Baru</h5>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Terjadi kesalahan.</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('admin.jadwal-tes.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="judul_tes" class="form-label fw-bold">Judul Tes</label>
                    <input type="text" class="form-control @error('judul_tes') is-invalid @enderror" id="judul_tes"
                        name="judul_tes" value="{{ old('judul_tes') }}"
                        style="border-color: #6D28D9; border-radius: 12px; padding: 6px 12px;">
                    @error('judul_tes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="jenis_tes" class="form-label fw-bold">Jenis Tes</label>
                    <select class="form-select @error('jenis_tes') is-invalid @enderror" id="jenis_tes" name="jenis_tes"
                        style="border-color: #6D28D9; border-radius: 12px; padding: 6px 12px; background-image: url('data:image/svg+xml,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 16 16%27%3e%3cpath fill=%27none%27 stroke=%27%236D28D9%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%272%27 d=%27m2 5 6 6 6-6%27/%3e%3c/svg%3e');">
                        <option value="" {{ old('jenis_tes') ? '' : 'selected' }}>Pilih Jenis Tes</option>
                        <option value="EPT-P" {{ old('jenis_tes') === 'EPT-P' ? 'selected' : '' }}>EPT-P</option>
                        <option value="ITP" {{ old('jenis_tes') === 'ITP' ? 'selected' : '' }}>ITP</option>
                    </select>
                    @error('jenis_tes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tanggal_tes" class="form-label fw-bold">Tanggal Tes</label>
                    <input type="date" class="form-control @error('tanggal_tes') is-invalid @enderror" id="tanggal_tes"
                        name="tanggal_tes" value="{{ old('tanggal_tes') }}"
                        style="border-color: #6D28D9;border-radius: 12px; padding: 6px 12px;">
                    @error('tanggal_tes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="waktu" class="form-label fw-bold">Waktu</label>
                    <input type="text" class="form-control @error('waktu') is-invalid @enderror" id="waktu"
                        name="waktu" value="{{ old('waktu') }}"
                        style="border-color: #6D28D9;border-radius: 12px; padding: 6px 12px;">
                    @error('waktu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="lokasi" class="form-label fw-bold">Lokasi</label>
                    <input type="text" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi"
                        name="lokasi" value="{{ old('lokasi') }}"
                        style="border-color: #6D28D9;border-radius: 12px; padding: 6px 12px;">
                    @error('lokasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kuota" class="form-label fw-bold">Kuota</label>
                    <input type="number" class="form-control @error('kuota') is-invalid @enderror" id="kuota"
                        name="kuota" min="1" value="{{ old('kuota') }}"
                        style="border-color: #6D28D9;border-radius: 12px; padding: 6px 12px;">
                    @error('kuota')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="harga" class="form-label fw-bold">Harga</label>
                    <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga"
                        name="harga" min="0" value="{{ old('harga', 0) }}"
                        style="border-color: #6D28D9;border-radius: 12px; padding: 6px 12px;">
                    @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2 mt-5">
                    <a href="{{ route('admin.jadwal-tes') }}" class="btn btn-outline-secondary py-2 px-4"
                        style="border-radius: 30px; font-size: 1rem;">
                        Kembali ke Daftar
                    </a>

                    <button type="submit" class="btn text-white py-2 px-4 fw-bold"
                        style="background-color: #6D28D9; border-radius: 30px; font-size: 1rem;">
                        Simpan Jadwal
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
