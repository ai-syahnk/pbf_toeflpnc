@extends('layouts.admin.main')

@section('title', 'Peserta Tes')

@section('content')
    <div class="search-container">
        <i class="fas fa-search"></i>
        <input type="text" class="form-control search-input" placeholder="Cari nama atau kode peserta...">
    </div>

    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-admin align-middle">
                    <thead>
                        <tr>
                            <th class="py-3 px-4">No</th>
                            <th class="py-3">Nomor Pendaftaran</th>
                            <th class="py-3">Nama Peserta</th>
                            <th class="py-3">Jenis Tes</th>
                            <th class="py-3">Tanggal Daftar</th>
                            <th class="py-3">Total Biaya</th>
                            <th class="py-3">Status Bayar</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @forelse ($peserta as $item)
                            <tr>
                                <td class="px-4 text-center">{{ $loop->iteration }}</td>
                                <td class="fw-bold">{{ $item->nomor_pendaftaran }}</td>
                                <td>{{ $item->nama_peserta }}</td>
                                <td>{{ $item->jenis_tes }}</td>
                                <td>{{ $item->tanggal_daftar }}</td>
                                <td>Rp {{ number_format($item->total_biaya, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge-lunas">{{ $item->status_bayar }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="#" class="btn-score">INPUT SKOR</a>
                                        <a href="{{ route('admin.peserta.show', $item->id) }}" class="btn-detail">DETAIL</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">Belum ada data peserta tes.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
