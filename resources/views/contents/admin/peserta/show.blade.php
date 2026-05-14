@extends('layouts.admin.main')

@section('title', 'Detail Peserta Tes')

@push('styles')
    {{-- badge-status-lulus --}}
    <style>
        .badge-status-lulus {
            background-color: #28a745;
            color: #fff;
            padding: 0.25em 0.75em;
            border-radius: 12px;
            font-size: 0.875rem;
        }

        .badge-status-tidak-lulus {
            background-color: #dc3545;
            color: #fff;
            padding: 0.25em 0.75em;
            border-radius: 12px;
            font-size: 0.875rem;
        }
    </style>
@endpush

@section('content')
    <div class="row g-4">
        {{-- Informasi Pendaftaran --}}
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header card-custom-header">
                    <h5 class="card-custom-title">Informasi Pendaftaran</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold text-secondary">Nomor Pendaftaran</div>
                        <div class="col-md-9">: {{ $peserta->nomor_pendaftaran }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold text-secondary">Tanggal Daftar</div>
                        <div class="col-md-9">: {{ $peserta->tanggal_daftar }}</div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-3 fw-bold text-secondary">Status Bayar</div>
                        <div class="col-md-9">: {{ $peserta->status_bayar }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Informasi Tes --}}
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header card-custom-header">
                    <h5 class="card-custom-title">Informasi Tes</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold text-secondary">Nama Tes</div>
                        <div class="col-md-9">: {{ $peserta->tes->nama }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold text-secondary">Jenis Tes</div>
                        <div class="col-md-9">: {{ $peserta->tes->jenis }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold text-secondary">Tanggal Tes</div>
                        <div class="col-md-9">: {{ $peserta->tes->tanggal }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold text-secondary">Waktu</div>
                        <div class="col-md-9">: {{ $peserta->tes->waktu }}</div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-3 fw-bold text-secondary">Lokasi</div>
                        <div class="col-md-9">: {{ $peserta->tes->lokasi }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Data Peserta --}}
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header card-custom-header">
                    <h5 class="card-custom-title">Data Peserta</h5>
                </div>
                <div class="card-body">
                    @php
                        $statusPeserta = strtolower((string) $peserta->peserta->status);
                    @endphp

                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold text-secondary">Nama Peserta</div>
                        <div class="col-md-9">: {{ $peserta->peserta->nama }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold text-secondary">Jenis Kelamin</div>
                        <div class="col-md-9">: {{ $peserta->peserta->jenis_kelamin }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold text-secondary">Status</div>
                        <div class="col-md-9">: {{ ucfirst(strtolower((string) $peserta->peserta->status)) }}</div>
                    </div>

                    @if ($statusPeserta === 'umum')
                        <div class="row mb-3">
                            <div class="col-md-3 fw-bold text-secondary">No KTP</div>
                            <div class="col-md-9">: {{ $peserta->peserta->no_ktp }}</div>
                        </div>
                    @else
                        <div class="row mb-3">
                            <div class="col-md-3 fw-bold text-secondary">NIM</div>
                            <div class="col-md-9">: {{ $peserta->peserta->nim }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 fw-bold text-secondary">Program Studi</div>
                            <div class="col-md-9">: {{ $peserta->peserta->program_studi }}</div>
                        </div>

                        @if ($statusPeserta === 'alumni')
                            <div class="row mb-3">
                                <div class="col-md-3 fw-bold text-secondary">Tahun Lulus</div>
                                <div class="col-md-9">: {{ $peserta->peserta->tahun_lulus }}</div>
                            </div>
                        @endif
                    @endif

                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold text-secondary">Nomor WhatsApp</div>
                        <div class="col-md-9">: {{ $peserta->peserta->no_wa }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold text-secondary">Email</div>
                        <div class="col-md-9">: {{ $peserta->peserta->email }}</div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-3 fw-bold text-secondary">Keperluan Tes</div>
                        <div class="col-md-9">: {{ $peserta->peserta->keperluan }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Informasi Pembayaran --}}
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header card-custom-header">
                    <h5 class="card-custom-title">Informasi Pembayaran</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold text-secondary">Total Biaya</div>
                        <div class="col-md-9">: Rp {{ number_format($peserta->pembayaran->total, 0, ',', '.') }}</div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-3 fw-bold text-secondary">Metode Pembayaran</div>
                        <div class="col-md-9">: {{ $peserta->pembayaran->metode }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Hasil Tes --}}
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header card-custom-header d-flex justify-content-between align-items-center">
                    <h5 class="card-custom-title mb-0">Hasil Tes</h5>
                    <a href="{{ route('admin.peserta.score', $peserta->id) }}" class="btn btn-sm btn-primary"
                        style="background-color: #5D16A6; border: none;">
                        <i class="fas fa-edit me-1"></i> {{ $peserta->hasil ? 'Edit Skor' : 'Input Skor' }}
                    </a>
                </div>
                <div class="card-body">
                    @if ($peserta->hasil)
                        <div class="row mb-3">
                            <div class="col-md-3 fw-bold text-secondary">Listening</div>
                            <div class="col-md-9">: {{ $peserta->hasil->listening ?? '-' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 fw-bold text-secondary">Structure</div>
                            <div class="col-md-9">: {{ $peserta->hasil->structure ?? '-' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 fw-bold text-secondary">Reading</div>
                            <div class="col-md-9">: {{ $peserta->hasil->reading ?? '-' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 fw-bold text-secondary">Total Skor</div>
                            <div class="col-md-9">: <strong>{{ $peserta->hasil->total_skor ?? '-' }}</strong></div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-3 fw-bold text-secondary">Status Kelulusan</div>
                            <div class="col-md-9">
                                :
                                @if ($peserta->hasil && $peserta->hasil->status_kelulusan)
                                    <span
                                        class="badge {{ $peserta->hasil->status_kelulusan === 'lulus' ? 'badge-status-lulus' : 'badge-status-tidak-lulus' }}">
                                        {{ str_replace('_', ' ', strtoupper($peserta->hasil->status_kelulusan)) }}
                                    </span>
                                @else
                                    <span>-</span>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Belum Ada Hasil Tes</strong>
                            <p class="mb-0 mt-2">Hasil tes untuk peserta ini belum diinput.
                                <a href="{{ route('admin.peserta.score', $peserta->id) }}" class="alert-link">Klik di
                                    sini untuk input skor.</a>
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12 mt-2 mb-5">
            <a href="{{ route('admin.peserta') }}" class="btn btn-sm btn-outline-secondary px-4 py-2 fw-bold"
                style="border-radius: 25px;">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar
            </a>
        </div>
    </div>
@endsection
