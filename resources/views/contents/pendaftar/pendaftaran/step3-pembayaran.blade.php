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
                                <img src="{{ asset('icons/pesanan.png') }}" alt="Konfirmasi Pesanan" class="reg-step-icon">
                            </div>
                            <div class="step-label">Konfirmasi Pesanan</div>
                        </div>
                        <div class="step-item active">
                            <div class="reg-step-icon-wrapper">
                                <img src="{{ asset('icons/walet.png') }}" alt="Pembayaran"
                                    class="reg-step-icon active-icon">
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

            <!-- Payment Summary Card -->
            <div class="row justify-content-center mb-4">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="text-muted">Total Pembayaran</div>
                            <div class="fw-bold text-purple" style="font-size: 1.4rem;">Rp 100.000</div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted">Bayar Dalam</div>
                            <div class="fw-bold text-dark" style="font-size: 0.9rem;">00 : 15 : 00</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- QRIS Card -->
            <div class="row justify-content-center mb-4">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-sm p-5 text-center" style="border-radius: 20px;">
                        <div class="mb-4">
                            <img src="{{ asset('images/qris.png') }}" alt="QRIS" class="img-fluid"
                                style="max-height: 40px;">
                        </div>
                        <div class="qris-code-wrapper mx-auto" style="max-width: 250px;">
                            <img src="{{ asset('images/qris_code.png') }}" alt="QRIS Code"
                                class="img-fluid rounded shadow-sm">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Instructions Card -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-10">
                    <div class="card border-0 p-4" style="border-radius: 20px; background-color: #f0e8ff;">
                        <h6 class="fw-bold text-purple mb-3">Petunjuk Pembayaran QRIS</h6>
                        <ol class="text-muted" style="font-size: 0.9rem; line-height: 1.8;">
                            <li>Screenshot Kode QR yang ditampilkan pada halaman pembayaran.</li>
                            <li>Buka aplikasi Mobile Banking atau e-wallet yang ditampilkan pada halaman pembayaran.</li>
                            <li>Pilih menu Scan QR atau QRIS pada aplikasi.</li>
                            <li>Scan kode QR yang tertampil pada halaman pembayaran.</li>
                            <li>Periksa kembali jumlah pembayaran, kemudian lakukan konfirmasi pembayaran.</li>
                            <li>Setelah pembayaran berhasil, simpan bukti transaksi sebagai arsip pribadi.</li>
                            <li>Kembali ke halaman website dan klik tombol <strong>"Saya Sudah Bayar"</strong> setelah
                                pembayaran selesai.</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="d-flex flex-column flex-sm-row justify-content-end gap-3">
                        <div class="col-md-2 col-sm-3">
                            <a href="{{ route('pendaftaran.step2') }}" class="btn btn-outline-purple w-100 py-2"
                                style="border-radius: 50px; font-weight: 700;">Kembali</a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-5">
                            <button type="button" class="btn btn-auth w-100 py-2 m-0"
                                style="border-radius: 50px; font-weight: 700;" data-bs-toggle="modal"
                                data-bs-target="#successModal">Saya Sudah Bayar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Sukses Pendaftaran -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 p-3" style="border-radius: 30px;">
                <div class="modal-body text-center p-4">
                    <div class="success-icon-wrapper mb-5">
                        <div class="success-circle mx-auto">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold text-purple mb-3">Selamat Pendaftaran Berhasil!</h4>
                    <p class="text-muted mb-3" style="font-size: 1rem; line-height: 1.2;">
                        Anda telah berhasil mendaftar Tes TOEFL.<br>
                        Silakan unduh kartu tes dan bawa saat<br>
                        hari pelaksanaan tes.
                    </p>
                    <a href="{{ route('transaksi.kartu-tes') }}" class="btn btn-auth w-100 py-2"
                        style="border-radius: 50px; font-weight: 700; font-size: 1rem;">Lihat Kartu Tes</a>
                </div>
            </div>
        </div>
    </div>

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

            /* Success Modal Styling */
            .success-circle {
                width: 120px;
                height: 120px;
                background-color: #f0e8ff;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--color-primary);
                font-size: 3.5rem;
            }
        </style>
    @endpush
@endsection
