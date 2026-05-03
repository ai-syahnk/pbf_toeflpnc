@extends('layouts.admin.main')

@section('title', 'Jadwal Tes')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Daftar Jadwal Tes</h5>
        <button class="btn btn-sm text-white px-4 py-2 fw-bold" style="background-color: #6D28D9; border-radius: 25px;">
            <i class="fas fa-plus me-2"></i> Tambah Jadwal
        </button>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-admin align-middle">
                    <thead>
                        <tr>
                            <th class="py-3 px-4">No</th>
                            <th class="py-3">Judul Tes</th>
                            <th class="py-3">Jenis Tes</th>
                            <th class="py-3">Tanggal Tes</th>
                            <th class="py-3">Waktu</th>
                            <th class="py-3">Lokasi</th>
                            <th class="py-3">Kouta</th>
                            <th class="py-3">Harga</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr>
                            <td class="px-4 text-center">1</td>
                            <td>Free For Alumni – EPT–P</td>
                            <td>TOEFL EPT-P</td>
                            <td>6 Maret 2026</td>
                            <td>09:00 – 11:00</td>
                            <td>Lab. Bahasa GKB Lantai 2</td>
                            <td class="text-center">24</td>
                            <td>Rp 0</td>
                            <td class="text-center">
                                <button class="btn btn-detail px-4">DETAIL</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
