@extends('layouts.web.main')

@section('content')
    <section class="pendaftaran-section py-5" style="background-color: #f8f4ff; min-height: 80vh;">
        <div class="container">
            <!-- Progress Bar -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8">
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
                                <img src="{{ asset('icons/pesanan.png') }}" alt="Konfirmasi Pesanan"
                                    class="reg-step-icon active-icon">
                            </div>
                            <div class="step-label">Konfirmasi Pesanan</div>
                        </div>
                        <div class="step-item">
                            <div class="reg-step-icon-wrapper">
                                <img src="{{ asset('icons/walet.png') }}" alt="Pembayaran" class="reg-step-icon">
                            </div>
                            <div class="step-label">Pembayaran</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nomor Pendaftaran Banner -->
            <div class="row justify-content-center mb-4">
                <div class="col-lg-10">
                    <div class="p-4" style="background-color: #f0e8ff; border-radius: 20px;">
                        <span class="text-uppercase fw-bold text-purple"
                            style="font-size: 0.85rem; letter-spacing: 1px;">Nomor Pendaftaran</span>
                        <h4 class="fw-bold mb-0 mt-1">TOEFL-101-260226-013</h4>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row g-4">
                        <!-- Left Column: Informasi Jadwal & Data Peserta -->
                        <div class="col-md-6">
                            <!-- Informasi Jadwal TOEFL -->
                            <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                                <div class="card-header py-3 px-4 d-flex align-items-center"
                                    style="border-top-left-radius: 20px; border-top-right-radius: 20px; background-color: #f0e8ff; border-bottom: 2px solid #F7B801;">
                                    <div class="text-purple me-2">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                    <h6 class="fw-bold text-purple mb-0">Informasi Jadwal TOEFL</h6>
                                </div>
                                <div class="card-body p-4" style="font-size: 0.8rem;">
                                    <div class="row mb-3">
                                        <div class="col-4 text-muted">Nama Tes</div>
                                        <div class="col-8" style="font-weight: 400;">: Special Ramadhan Batch 1 - EPT-P
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-4 text-muted">Tanggal Tes</div>
                                        <div class="col-8" style="font-weight: 400;">: 9 Maret 2026</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-4 text-muted">Waktu</div>
                                        <div class="col-8" style="font-weight: 400;">: 09:00 - 11:00 WIB</div>
                                    </div>
                                    <div class="row mb-0">
                                        <div class="col-4 text-muted">Lokasi</div>
                                        <div class="col-8" style="font-weight: 400;">: Lab. Bahasa GKB Lantai 2</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Peserta -->
                            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                                <div class="card-header py-3 px-4 d-flex align-items-center"
                                    style="border-top-left-radius: 20px; border-top-right-radius: 20px; background-color: #f0e8ff; border-bottom: 2px solid #F7B801;">
                                    <div class="text-purple me-2">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <h6 class="fw-bold text-purple mb-0">Data Peserta</h6>
                                </div>
                                <div class="card-body p-4" style="font-size: 0.8rem;">
                                    <div class="row mb-3">
                                        <div class="col-4 text-muted">Nama Lengkap</div>
                                        <div class="col-8 fw-medium">: Aika Eva Darlene</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-4 text-muted">Jenis Kelamin</div>
                                        <div class="col-8 fw-medium">: Perempuan</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-4 text-muted">Status</div>
                                        <div class="col-8 fw-medium">: {{ request('status', 'mahasiswa') }}</div>
                                    </div>

                                    @if (request('status') == 'mahasiswa' || !request('status'))
                                        <div class="row mb-3">
                                            <div class="col-4 text-muted">NIM</div>
                                            <div class="col-8 fw-medium">: 250132102</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-4 text-muted">Program Studi</div>
                                            <div class="col-8 fw-medium">: D3 Teknik Informatika</div>
                                        </div>
                                    @endif

                                    @if (request('status') == 'alumni')
                                        <div class="row mb-3">
                                            <div class="col-4 text-muted">NIM</div>
                                            <div class="col-8 fw-medium">: 250132102</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-4 text-muted">Program Studi</div>
                                            <div class="col-8 fw-medium">: D3 Teknik Informatika</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-4 text-muted">Tahun Lulus</div>
                                            <div class="col-8 fw-medium">: 2024</div>
                                        </div>
                                    @endif

                                    @if (request('status') == 'umum')
                                        <div class="row mb-3">
                                            <div class="col-4 text-muted">Nomor KTP</div>
                                            <div class="col-8 fw-medium">: 3501784612069999</div>
                                        </div>
                                    @endif

                                    <div class="row mb-3">
                                        <div class="col-4 text-muted">Nomor WhatsApp</div>
                                        <div class="col-8 fw-medium">: 081234567890</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-4 text-muted">Email</div>
                                        <div class="col-8 fw-medium">: aikaeva_darlene.stu@pnc.ac.id</div>
                                    </div>
                                    <div class="row mb-0">
                                        <div class="col-4 text-muted">Keperluan Tes</div>
                                        <div class="col-8 fw-medium">: Syarat Kelulusan</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Ringkasan Pembayaran & Metode Pembayaran -->
                        <div class="col-md-6">
                            <!-- Ringkasan Pembayaran -->
                            <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                                <div class="card-header py-3 px-4 d-flex align-items-center"
                                    style="border-top-left-radius: 20px; border-top-right-radius: 20px; background-color: #f0e8ff; border-bottom: 2px solid #F7B801;">
                                    <div class="text-purple me-2">
                                        <i class="fas fa-wallet"></i>
                                    </div>
                                    <h6 class="fw-bold text-purple mb-0">Ringkasan Pembayaran</h6>
                                </div>
                                <div class="card-body p-4" style="font-size: 0.8rem;">
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="text-muted">Biaya Tes</div>
                                        <div class="fw-medium">Rp 100.000</div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="text-muted">Biaya Admin</div>
                                        <div class="fw-medium">Rp 0</div>
                                    </div>
                                    <hr class="my-3" style="border-style: dashed; border-width: 1.6px; color: #999999;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="text-muted">Total Pembayaran</div>
                                        <div class="fw-bold text-purple" style="font-size: 1.1rem;">Rp 100.000</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Metode Pembayaran -->
                            <div class="card border-0 shadow-sm mb-5" style="border-radius: 20px;">
                                <div class="card-header py-3 px-4 d-flex align-items-center"
                                    style="border-top-left-radius: 20px; border-top-right-radius: 20px; background-color: #f0e8ff; border-bottom: 2px solid #F7B801;">
                                    <div class="text-purple me-2">
                                        <i class="fas fa-mobile-alt"></i>
                                    </div>
                                    <h6 class="fw-bold text-purple mb-0">Metode Pembayaran</h6>
                                </div>
                                <div class="card-body p-4">
                                    <span class="text-muted" style="font-size: 0.8rem;">QRIS</span>
                                    <div class="text-left">
                                        <img src="{{ asset('images/qris.png') }}" alt="QRIS" class="img-fluid"
                                            style="max-height: 70px;">
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row g-3">
                                <div class="col-5">
                                    <a href="{{ route('pendaftaran.step1') }}" class="btn btn-outline-purple w-100 py-2"
                                        style="border-radius: 50px; font-weight: 700;">Ubah Data</a>
                                </div>
                                <div class="col-7">
                                    <a href="#" class="btn btn-auth w-100 py-2 m-0"
                                        style="border-radius: 50px; font-weight: 700;">Lanjut ke Pembayaran</a>
                                </div>
                            </div>
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
                top: 25px;
                left: 50px;
                right: 50px;
                height: 2px;
                background-color: #e0e0e0;
                z-index: -1;
            }

            .step-item {
                display: flex;
                flex-direction: column;
                align-items: center;
                background-color: #f8f4ff;
                padding: 0 10px;
            }

            .reg-step-icon-wrapper {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                background-color: #e0e0e0;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 10px;
                transition: all 0.3s ease;
            }

            .step-item.active .reg-step-icon-wrapper {
                background-color: var(--color-primary);
            }

            .reg-step-icon {
                width: 22px;
                height: 22px;
                object-fit: contain;
                filter: grayscale(100%) opacity(0.5);
            }

            .step-item.active .reg-step-icon {
                filter: brightness(0) invert(1);
            }

            .step-label {
                font-size: 0.85rem;
                font-weight: 500;
                color: #999;
            }

            .step-item.active .step-label {
                color: var(--color-primary);
                font-weight: 700;
            }

            .text-purple {
                color: var(--color-primary);
            }

            .btn-outline-purple {
                border: 2px solid var(--color-primary);
                color: var(--color-primary);
            }

            .btn-outline-purple:hover {
                background-color: var(--color-primary);
                color: white;
            }
        </style>
    @endpush
@endsection
