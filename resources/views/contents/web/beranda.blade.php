@extends('layouts.web.main')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h1>Sistem Pendaftaran TOEFL<br>Politeknik Negeri Cilacap</h1>
                    <p>Layanan resmi pengukuran kemampuan bahasa Inggris mahasiswa.</p>
                    <a href="#" class="btn-lihat-jadwal">
                        Lihat Jadwal <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Program Tes Section -->
    <section class="programtes-section">
        <div class="container">
            <div class="section-title">
                <h2>Program Tes</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="program-card">
                        <img src="{{ asset('icons/doc_1.png') }}" alt="TOEFL ITP">
                        <h3>TOEFL ITP</h3>
                        <p>TOEFL ITP merupakan tes kemampuan bahasa Inggris yang diselenggarakan secara institusional untuk
                            memenuhi persyaratan kelulusan di Politeknik Negeri Cilacap.</p>
                        <a href="#">Lihat Selengkapnya</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="program-card">
                        <img src="{{ asset('icons/doc_2.png') }}" alt="TOEFL Prediction">
                        <h3>TOEFL PREDICTION</h3>
                        <p>TOEFL EPT-P merupakan tes prediksi yang dirancang untuk mengukur kemampuan bahasa Inggris
                            mahasiswa sebagai persiapan menghadapi tes TOEFL resmi.</p>
                        <a href="#">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jadwal Tes Section -->
    <section class="jadwaltes-section">
        <div class="container">
            <div class="section-title">
                <h2>Jadwal Tes</h2>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-5 col-md-6">
                    <div class="jadwal-card">
                        <div class="jadwal-card-header">Free For Alumni - EPT-P</div>
                        <div class="jadwal-card-body">
                            <div class="jadwal-price">
                                <span class="old-price">Rp 100.000</span>
                                <span class="new-price">GRATIS</span>
                            </div>
                            <div class="jadwal-info">
                                <div class="jadwal-item">
                                    <span class="label"><img src="{{ asset('icons/date.png') }}" width="18">
                                        Tanggal</span>
                                    <span class="text-description">: 6 Maret 2026</span>
                                </div>
                                <div class="jadwal-item">
                                    <span class="label"><img src="{{ asset('icons/time.png') }}" width="18">
                                        Waktu</span>
                                    <span class="text-description">: (Sesi Pagi) 09:00 - 11:00 WIB</span>
                                </div>
                                <div class="jadwal-item">
                                    <span class="label"><img src="{{ asset('icons/location.png') }}" width="18">
                                        Lokasi</span>
                                    <span class="text-description">: Lab. Bahasa GKB Lantai 2</span>
                                </div>
                                <div class="jadwal-item">
                                    <span class="label"><img src="{{ asset('icons/quota.png') }}" width="18">
                                        Kuota</span>
                                    <span class="text-description">: 24 Peserta</span>
                                </div>
                            </div>
                            <a href="#" class="btn btn-daftar">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="jadwal-card">
                        <div class="jadwal-card-header">Special Ramadhan Batch 1 - EPT-P</div>
                        <div class="jadwal-card-body">
                            <div class="jadwal-price">
                                <span class="new-price">Rp 100.000</span>
                            </div>
                            <div class="jadwal-info">
                                <div class="jadwal-item">
                                    <span class="label"><img src="{{ asset('icons/date.png') }}" width="18">
                                        Tanggal</span>
                                    <span class="text-description">: 9 Maret 2026</span>
                                </div>
                                <div class="jadwal-item">
                                    <span class="label"><img src="{{ asset('icons/time.png') }}" width="18">
                                        Waktu</span>
                                    <span class="text-description">: (Sesi Pagi) 09:00 - 11:00 WIB</span>
                                </div>
                                <div class="jadwal-item">
                                    <span class="label"><img src="{{ asset('icons/location.png') }}" width="18">
                                        Lokasi</span>
                                    <span class="text-description">: Lab. Bahasa GKB Lantai 2</span>
                                </div>
                                <div class="jadwal-item">
                                    <span class="label"><img src="{{ asset('icons/quota.png') }}" width="18">
                                        Kuota</span>
                                    <span class="text-description">: 32 Peserta</span>
                                </div>
                            </div>
                            <a href="#" class="btn btn-daftar">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="#" class="lihat-semua-link">Lihat Semua</a>
            </div>
        </div>
    </section>

    <!-- Cara Mendaftar Section -->
    <section class="caradaftar-section">
        <div class="container">
            <div class="section-title">
                <h2>Cara Mendaftar</h2>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6">
                    <div class="step-card">
                        <div class="step-icon">
                            <img src="{{ asset('icons/jadwal.png') }}" alt="Pilih Jadwal">
                        </div>
                        <h4>Pilih Jadwal Tes</h4>
                        <p>Peserta memilih jadwal tes TOEFL ITP atau EPT-P yang tersedia sesuai kebutuhan.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="step-card">
                        <div class="step-icon">
                            <img src="{{ asset('icons/person.png') }}" alt="Isi Data">
                        </div>
                        <h4>Isi Data Diri</h4>
                        <p>Peserta mengisi data diri pada form yang tersedia.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="step-card">
                        <div class="step-icon">
                            <img src="{{ asset('icons/form.png') }}" alt="Konfirmasi">
                        </div>
                        <h4>Konfirmasi Pendaftaran</h4>
                        <p>Peserta memeriksa kembali seluruh informasi pendaftaran.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="step-card">
                        <div class="step-icon">
                            <img src="{{ asset('icons/bayar.png') }}" alt="Pembayaran">
                        </div>
                        <h4>Pembayaran</h4>
                        <p>Peserta melakukan pembayaran biaya tes melalui metode QRIS dalam batas waktu yang telah
                            ditentukan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Konsultasi Section -->
    <section class="konsultasi-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-4">Layanan Konsultasi</h2>
                    <p class="mb-4">Silahkan hubungi Admin UPA Bahasa PNC untuk<br> konsultasi dan bantuan terkait
                        pelaksanaan tes TOEFL.<br> Kami siap membantu Anda.</p>
                    <a href="#" class="btn btn-chat-admin">
                        <img src="{{ asset('icons/whatsapp.png') }}" alt="WhatsApp" width="24"
                            style="filter: brightness(0) invert(1);">
                        Chat Admin
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
