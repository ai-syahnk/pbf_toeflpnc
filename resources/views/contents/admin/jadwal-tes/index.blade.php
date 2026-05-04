@extends('layouts.admin.main')

@section('title', 'Jadwal Tes')

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

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Daftar Jadwal Tes</h5>
        <a href="{{ route('admin.jadwal-tes.create') }}" class="btn btn-sm text-white px-4 py-2 fw-bold"
            style="background-color: #6D28D9; border-radius: 25px;">
            <i class="fas fa-plus me-2"></i> Tambah Jadwal
        </a>
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
                            <th class="py-3">Kuota</th>
                            <th class="py-3">Harga</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @forelse ($jadwalTes as $item)
                            <tr>
                                <td class="px-4 text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->judul_tes }}</td>
                                <td>{{ $item->jenis_tes }}</td>
                                <td>{{ tanggal_panjang($item->tanggal_tes) }}</td>
                                <td>{{ $item->waktu }}</td>
                                <td>{{ $item->lokasi }}</td>
                                <td class="text-center">{{ $item->kuota }}</td>
                                <td>Rp {{ number_format((float) $item->harga, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.jadwal-tes.show', $item->id) }}"
                                        class="btn btn-detail px-4">DETAIL</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">Belum ada data jadwal tes.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
