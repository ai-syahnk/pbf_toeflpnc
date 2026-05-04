@extends('layouts.admin.main')

@section('title', 'Detail Jadwal Tes')

@section('content')
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

    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header card-custom-header py-3 px-4">
                    <h5 class="card-custom-title">Detail Jadwal Tes</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Judul Tes</div>
                        <div class="col-md-9">: {{ $jadwalTes->judul_tes }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Jenis Tes</div>
                        <div class="col-md-9">: {{ $jadwalTes->jenis_tes }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Tanggal Tes</div>
                        <div class="col-md-9">: {{ tanggal_panjang($jadwalTes->tanggal_tes) }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Waktu</div>
                        <div class="col-md-9">: {{ $jadwalTes->waktu }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Lokasi</div>
                        <div class="col-md-9">: {{ $jadwalTes->lokasi }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Kuota</div>
                        <div class="col-md-9">: {{ $jadwalTes->kuota }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Harga</div>
                        <div class="col-md-9">: Rp {{ number_format((float) $jadwalTes->harga, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex gap-3">
                <a href="{{ route('admin.jadwal-tes') }}" class="btn btn-sm btn-outline-secondary px-4 py-2 fw-bold"
                    style="border-radius: 25px;">
                    Kembali ke Daftar
                </a>

                <a href="{{ route('admin.jadwal-tes.edit', $jadwalTes->id) }}"
                    class="btn btn-sm text-white px-5 py-2 fw-bold" style="background-color: #6D28D9; border-radius: 25px;">
                    Edit
                </a>

                <form action="{{ route('admin.jadwal-tes.destroy', $jadwalTes->id) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus jadwal tes ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger px-5 py-2 fw-bold" style="border-radius: 25px;">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
