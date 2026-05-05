@extends('layouts.web.main')

@section('content')
    <section class="pendaftaran-section py-5" style="background-color: #f8f4ff; min-height: 80vh;">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-10">
                    <div class="d-flex justify-content-between position-relative registration-steps">
                        <div class="step-line"></div>
                        <div class="step-item active">
                            <div class="reg-step-icon-wrapper">
                                <img src="{{ asset('icons/datadiri.png') }}" alt="Isi Data Diri" class="reg-step-icon">
                            </div>
                            <div class="step-label">Isi Data Diri</div>
                        </div>
                        <div class="step-item active">
                            <div class="reg-step-icon-wrapper">
                                <img src="{{ asset('icons/pesanan2.png') }}" alt="Konfirmasi Pesanan"
                                    class="reg-step-icon active-icon">
                            </div>
                            <div class="step-label">Konfirmasi Pesanan</div>
                        </div>
                        <div class="step-item">
                            <div class="reg-step-icon-wrapper">
                                <img src="{{ asset('icons/walet.png') }}" alt="Pembayaran" class="reg-step-icon">
                            </div>
                            <div style="color: #999999;">Pembayaran</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mb-4">
                <div class="col-lg-10">
                    <div class="alert alert-light border shadow-sm mb-0" style="border-radius: 20px;">
                        <div class="text-muted small text-uppercase">Nomor Pendaftaran</div>
                        <div class="fw-bold fs-4">
                            {{ $pendaftaranTes->nomor_pendaftaran ?: 'TOEFL-XXX-XXXXXX-XXX' }}</div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px;">
                                <div class="card-header section-header"
                                    style="border-top-left-radius: 20px; border-top-right-radius: 20px;">Informasi Jadwal
                                    Tes</div>
                                <div class="card-body p-4">
                                    <div class="detail-row"><span>Nama
                                            Tes</span><strong>{{ $pendaftaranTes->jadwalTes->judul_tes }}</strong></div>
                                    <div class="detail-row"><span>Jenis
                                            Tes</span><strong>{{ $pendaftaranTes->jadwalTes->jenis_tes }}</strong></div>
                                    <div class="detail-row"><span>Tanggal
                                            Tes</span><strong>{{ tanggal_panjang($pendaftaranTes->jadwalTes->tanggal_tes) }}</strong>
                                    </div>
                                    <div class="detail-row">
                                        <span>Waktu</span><strong>{{ $pendaftaranTes->jadwalTes->waktu }}</strong>
                                    </div>
                                    <div class="detail-row mb-0">
                                        <span>Lokasi</span><strong>{{ $pendaftaranTes->jadwalTes->lokasi }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px;">
                                <div class="card-header section-header"
                                    style="border-top-left-radius: 20px; border-top-right-radius: 20px;">Data Peserta</div>
                                <div class="card-body p-4">
                                    <div class="detail-row"><span>Nama
                                            Lengkap</span><strong>{{ $pendaftaranTes->nama_peserta }}</strong></div>
                                    <div class="detail-row"><span>Jenis
                                            Kelamin</span><strong>{{ $pendaftaranTes->jenis_kelamin }}</strong></div>
                                    <div class="detail-row"><span>Status</span><strong
                                            class="text-capitalize">{{ $pendaftaranTes->status_pendaftar }}</strong></div>
                                    @if ($pendaftaranTes->nim)
                                        <div class="detail-row"><span>NIM</span><strong>{{ $pendaftaranTes->nim }}</strong>
                                        </div>
                                    @endif
                                    @if ($pendaftaranTes->program_studi)
                                        <div class="detail-row"><span>Program
                                                Studi</span><strong>{{ $pendaftaranTes->program_studi }}</strong></div>
                                    @endif
                                    @if ($pendaftaranTes->tahun_lulus)
                                        <div class="detail-row"><span>Tahun
                                                Lulus</span><strong>{{ $pendaftaranTes->tahun_lulus }}</strong></div>
                                    @endif
                                    @if ($pendaftaranTes->no_ktp)
                                        <div class="detail-row"><span>Nomor
                                                KTP</span><strong>{{ $pendaftaranTes->no_ktp }}</strong></div>
                                    @endif
                                    <div class="detail-row"><span>Nomor
                                            WhatsApp</span><strong>{{ $pendaftaranTes->no_wa }}</strong></div>
                                    <div class="detail-row">
                                        <span>Email</span><strong>{{ $pendaftaranTes->email_peserta }}</strong>
                                    </div>
                                    <div class="detail-row mb-0"><span>Keperluan
                                            Tes</span><strong>{{ $pendaftaranTes->keperluan_tes }}</strong></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                                <div class="card-header section-header"
                                    style="border-top-left-radius: 20px; border-top-right-radius: 20px;">Ringkasan
                                    Pembayaran</div>
                                <div class="card-body p-4">
                                    <div class="detail-row" style="border-bottom: none;"><span>Biaya Tes</span><strong>
                                            @if ((float) $pendaftaranTes->jadwalTes->harga <= 0)
                                                GRATIS
                                            @else
                                                Rp
                                                {{ number_format((float) $pendaftaranTes->jadwalTes->harga, 0, ',', '.') }}
                                            @endif
                                        </strong></div>
                                    <div class="detail-row"><span>Biaya Admin</span><strong>
                                            Rp {{ number_format(0, 0, ',', '.') }}
                                        </strong></div>
                                    <div class="detail-row mb-0"><span>Total Pembayaran</span><strong
                                            class="text-purple fs-5">
                                            @if ((float) $pendaftaranTes->jadwalTes->harga <= 0)
                                                GRATIS
                                            @else
                                                Rp
                                                {{ number_format((float) $pendaftaranTes->jadwalTes->harga, 0, ',', '.') }}
                                            @endif
                                        </strong></div>
                                </div>
                            </div>
                        </div>

                        {{-- Metode Pembayaran = QRIS --}}
                        <div class="col-lg-6">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px;">
                                <div class="card-header section-header"
                                    style="border-top-left-radius: 20px; border-top-right-radius: 20px;">Metode
                                    Pembayaran</div>
                                <div class="card-body p-4 d-flex flex-column align-items-center">
                                    <img src="{{ asset('images/qris.png') }}" alt="QRIS" width="120">
                                    <div class="text-muted mt-3">Pembayaran akan dilakukan melalui QRIS pada langkah
                                        selanjutnya.</div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-lg-6 d-flex align-items-end">
                            <div class="w-100 d-flex flex-column flex-sm-row gap-3">
                                <a href="{{ route('pendaftaran.step1', $pendaftaranTes) }}"
                                    class="btn btn-outline-purple w-100 py-3">Ubah Data</a>
                                <form action="{{ route('pendaftaran.konfirmasi', $pendaftaranTes) }}" method="POST"
                                    class="w-100">
                                    @csrf
                                    <button type="submit" class="btn btn-auth w-100 py-3">Konfirmasi dan Lanjutkan
                                        Pembayaran</button>
                                </form>
                            </div>
                        </div> --}}

                        <div class="d-flex justify-content-end gap-3 mt-5">
                            <a href="{{ route('pendaftaran.step1', $pendaftaranTes) }}"
                                class="btn btn-outline-custom py-3">Ubah Data</a>
                            <form action="{{ route('pendaftaran.konfirmasi', $pendaftaranTes) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-simpan py-3">Konfirmasi dan Lanjutkan
                                    Pembayaran</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('styles')
        <style>
            .registration-steps {
                z-index: 1;
            }

            .step-line {
                position: absolute;
                top: 24px;
                left: 10%;
                right: 10%;
                height: 2px;
                background-color: #ded6ef;
                z-index: -1;
            }

            .step-item {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 10px;
                background-color: #f8f4ff;
                padding: 0 8px;
            }

            .reg-step-icon-wrapper {
                width: 48px;
                height: 48px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: #d6c8ef;
                color: #5d16a6;
                font-weight: 700;
            }

            .step-item.active .reg-step-icon-wrapper {
                background-color: var(--color-primary) !important;
                color: #fff !important;
                border-color: var(--color-primary) !important;
            }

            .step-label,
            .text-purple,
            .section-header {
                color: var(--color-primary);
            }

            .section-header {
                background-color: #f0e8ff;
                font-weight: 700;
                padding: 1rem 1.25rem;
                border-bottom: 2px solid #f7b801;
            }

            .detail-row {
                display: flex;
                justify-content: space-between;
                gap: 16px;
                padding: 0.75rem 0;
                border-bottom: 1px dashed #d9d1ea;
            }

            .detail-row:last-child {
                border-bottom: 0;
            }

            .btn-simpan {
                background-color: var(--color-primary, #5D16A6);
                color: white;
                border: none;
                border-radius: 50px;
                padding: 10px 40px;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .btn-simpan:hover {
                background-color: var(--color-dark-purple, #4A1185);
                transform: translateY(-2px);
                color: white;
            }
        </style>
    @endpush
@endsection
