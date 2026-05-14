@extends('layouts.web.main')

@section('content')
    <section class="kartu-tes-section py-5">
        <div class="container">
            <div class="kartu-wrapper mx-auto">
                <div class="kartu-header">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/logo_pnc_2.png') }}" alt="Logo PNC" class="kartu-logo">
                        <div class="ms-4 text-center flex-grow-1">
                            <h5 class="mb-0">KARTU TANDA PESERTA TES TOEFL</h5>
                            <h5 class="mb-0 fw-bold">POLITEKNIK NEGERI CILACAP</h5>
                        </div>
                    </div>
                </div>

                <div class="kartu-body">
                    <div class="row g-4">
                        <div class="col-lg-9">
                            <div class="info-group mb-4">
                                <h6 class="info-title">INFORMASI PESERTA</h6>
                                <div class="info-item">
                                    <div class="info-label">NOMOR PENDAFTARAN</div>
                                    <div class="info-colon">:</div>
                                    <div class="info-value">{{ $pendaftaranTes->nomor_pendaftaran }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">NAMA PESERTA</div>
                                    <div class="info-colon">:</div>
                                    <div class="info-value">{{ $pendaftaranTes->nama_peserta }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">STATUS</div>
                                    <div class="info-colon">:</div>
                                    <div class="info-value text-capitalize">{{ $pendaftaranTes->status_pendaftar }}</div>
                                </div>
                                @if ($pendaftaranTes->nim)
                                    <div class="info-item">
                                        <div class="info-label">NIM</div>
                                        <div class="info-colon">:</div>
                                        <div class="info-value">{{ $pendaftaranTes->nim }}</div>
                                    </div>
                                @endif
                                @if ($pendaftaranTes->program_studi)
                                    <div class="info-item">
                                        <div class="info-label">PROGRAM STUDI</div>
                                        <div class="info-colon">:</div>
                                        <div class="info-value">{{ $pendaftaranTes->program_studi }}</div>
                                    </div>
                                @endif
                                @if ($pendaftaranTes->no_ktp)
                                    <div class="info-item">
                                        <div class="info-label">NOMOR KTP</div>
                                        <div class="info-colon">:</div>
                                        <div class="info-value">{{ $pendaftaranTes->no_ktp }}</div>
                                    </div>
                                @endif
                            </div>

                            <div class="info-group mb-4">
                                <h6 class="info-title">INFORMASI TES</h6>
                                <div class="info-item">
                                    <div class="info-label">NAMA TES</div>
                                    <div class="info-colon">:</div>
                                    <div class="info-value">{{ $pendaftaranTes->jadwalTes->judul_tes }} -
                                        {{ $pendaftaranTes->jadwalTes->jenis_tes }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">TANGGAL TES</div>
                                    <div class="info-colon">:</div>
                                    <div class="info-value">{{ tanggal_panjang($pendaftaranTes->jadwalTes->tanggal_tes) }}
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">WAKTU</div>
                                    <div class="info-colon">:</div>
                                    <div class="info-value">{{ $pendaftaranTes->jadwalTes->waktu }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">LOKASI</div>
                                    <div class="info-colon">:</div>
                                    <div class="info-value">{{ $pendaftaranTes->jadwalTes->lokasi }}</div>
                                </div>
                            </div>

                            <div class="info-group">
                                <h6 class="info-title">TATA TERTIB PESERTA</h6>
                                <ol class="tata-tertib-list mb-0">
                                    <li>Peserta wajib hadir 30 menit sebelum tes dimulai.</li>
                                    <li>Peserta wajib membawa kartu tes ini saat pelaksanaan ujian.</li>
                                    <li>Peserta wajib membawa identitas diri yang masih berlaku.</li>
                                    <li>Peserta yang terlambat lebih dari 15 menit tidak diperkenankan mengikuti tes.</li>
                                </ol>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="nomor-kursi-box">
                                <div class="kursi-label">NOMOR KURSI</div>
                                <div class="kursi-value">{{ $pendaftaranTes->nomor_kursi ?: 'Akan Diatur' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kartu-footer"></div>
            </div>

            <div class="d-flex justify-content-end gap-3 mt-4 flex-wrap">
                <a href="{{ route('transaksi.detail', $pendaftaranTes) }}" class="btn-kembali">Kembali ke Detail</a>
                <a href="{{ route('transaksi.kartu-tes.pdf', $pendaftaranTes) }}" class="btn-unduh"><i
                        class="fas fa-download"></i> Unduh PDF</a>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .kartu-tes-section {
            background-color: var(--bg-color-3);
        }

        .kartu-wrapper {
            background-color: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .kartu-header,
        .kartu-footer,
        .nomor-kursi-box,
        .btn-unduh {
            background-color: var(--color-primary);
            color: #fff;
        }

        .kartu-header {
            padding: 25px 40px;
        }

        .kartu-logo {
            height: 60px;
        }

        .kartu-body {
            padding: 40px;
            border-top: 5px solid #f7b801;
        }

        .info-title {
            color: var(--color-primary);
            font-weight: 700;
            margin-bottom: 20px;
        }

        .info-item {
            display: flex;
            margin-bottom: 12px;
        }

        .info-label {
            width: 210px;
            font-weight: 600;
        }

        .info-colon {
            width: 20px;
        }

        .info-value {
            flex: 1;
        }

        .tata-tertib-list {
            padding-left: 1.2rem;
        }

        .nomor-kursi-box {
            border-radius: 15px;
            padding: 20px;
            text-align: center;
        }

        .kursi-value {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .kartu-footer {
            height: 20px;
            border-top: 5px solid #f7b801;
        }

        .btn-kembali,
        .btn-unduh {
            border: 1.5px solid var(--color-primary);
            border-radius: 50px;
            padding: 10px 24px;
            font-weight: 700;
            text-decoration: none;
        }

        .btn-kembali {
            color: var(--color-primary);
            background-color: transparent;
        }
    </style>
@endpush
