@extends('layouts.web.main')

@section('content')
    <!-- Transaction History Section -->
    <section class="riwayattes-section">
        <div class="container">
            <div class="section-title">
                <h2>Riwayat Transaksi</h2>
            </div>

            <div class="table-responsive shadow-sm" style="border-radius: 20px; margin-bottom: 8rem !important;">
                <table class="table table-borderless table-riwayat">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Pendaftaran</th>
                            <th>Jenis Tes</th>
                            <th>Tanggal Daftar</th>
                            <th>Total Biaya</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($riwayatPendaftaran as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nomor_pendaftaran ?: '-' }}</td>
                                <td>{{ $item->jadwalTes->jenis_tes }}</td>
                                <td>{{ tanggal_panjang($item->created_at) }}</td>
                                <td>
                                    @if ((float) $item->harga_tes <= 0)
                                        GRATIS
                                    @else
                                        Rp {{ number_format((float) $item->harga_tes, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-status badge-status-{{ $item->status }}">
                                        {{ str_replace('_', ' ', strtoupper($item->status)) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('transaksi.detail', $item) }}" class="btn-detail">DETAIL</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-5">Belum ada transaksi pendaftaran yang
                                    tersimpan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .btn-detail {
            background-color: #e7edff;
            color: #4a89ff;
            padding: 8px 24px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.85rem;
            text-decoration: none;
            display: inline-block;
        }

        .badge-status {
            padding: 0.55rem 0.9rem;
            border-radius: 999px;
            font-size: 0.75rem;
        }

        .badge-status-draft {
            background-color: #e2e3e5;
            color: #41464b;
        }

        .badge-status-menunggu_pembayaran {
            background-color: #fff3cd;
            color: #9a6700;
        }

        .badge-status-lunas {
            background-color: #dff5e9;
            color: #0a7b45;
        }

        .badge-status-kedaluwarsa,
        .badge-status-dibatalkan {
            background-color: #f8d7da;
            color: #842029;
        }
    </style>
@endpush
