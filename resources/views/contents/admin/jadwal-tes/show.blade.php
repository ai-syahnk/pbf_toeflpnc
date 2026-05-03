@extends('layouts.admin.main')

@section('title', 'Detail Jadwal Tes')

@section('content')
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
                        <div class="col-md-9">: {{ $jadwalTes->tanggal_tes->format('d M Y') }}</div>
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
                <button class="btn btn-sm text-white px-5 py-2 fw-bold"
                    style="background-color: #6D28D9; border-radius: 25px;">
                    Edit
                </button>
                <button class="btn btn-sm btn-danger px-5 py-2 fw-bold" style="border-radius: 25px;">
                    Hapus
                </button>
            </div>
        </div>
    </div>
@endsection
