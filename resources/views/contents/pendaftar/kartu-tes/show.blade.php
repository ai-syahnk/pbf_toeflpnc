@extends('layouts.web.main')

@section('content')
    <section class="kartu-tes-section">
        <div class="container py-5">
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
                    <div class="row">
                        <div class="col-lg-10">
                            <!-- Informasi Peserta -->
                            <div class="info-group mb-5">
                                <h6 class="info-title">INFORMASI PESERTA</h6>
                                <div class="info-content">
                                    <div class="info-item">
                                        <div class="info-label">NOMOR PENDAFTARAN</div>
                                        <div class="info-colon">:</div>
                                        <div class="info-value">TOEFL-101-260226-013</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">NAMA PESERTA</div>
                                        <div class="info-colon">:</div>
                                        <div class="info-value">Aika Eva Darlene</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">STATUS</div>
                                        <div class="info-colon">:</div>
                                        <div class="info-value text-capitalize">{{ request('status', 'Mahasiswa') }}</div>
                                    </div>

                                    @if (request('status') == 'mahasiswa' || request('status') == 'alumni' || !request('status'))
                                        <div class="info-item">
                                            <div class="info-label">NIM</div>
                                            <div class="info-colon">:</div>
                                            <div class="info-value">250132102</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">PROGRAM STUDI</div>
                                            <div class="info-colon">:</div>
                                            <div class="info-value">D3 Teknik Informatika</div>
                                        </div>
                                    @endif

                                    @if (request('status') == 'umum')
                                        <div class="info-item">
                                            <div class="info-label">NOMOR KTP</div>
                                            <div class="info-colon">:</div>
                                            <div class="info-value">3501784612069999</div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Informasi Tes -->
                            <div class="info-group mb-5">
                                <h6 class="info-title">INFORMASI TES</h6>
                                <div class="info-content">
                                    <div class="info-item">
                                        <div class="info-label">NAMA TES</div>
                                        <div class="info-colon">:</div>
                                        <div class="info-value">Special Ramadhan Batch 1 - EPT-P</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">TANGGAL TES</div>
                                        <div class="info-colon">:</div>
                                        <div class="info-value">9 Maret 2026</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">WAKTU</div>
                                        <div class="info-colon">:</div>
                                        <div class="info-value">09:00 – 11:00 WIB</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">LOKASI</div>
                                        <div class="info-colon">:</div>
                                        <div class="info-value">Lab. Bahasa GKB Lantai 2</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tata Tertib -->
                            <div class="info-group">
                                <h6 class="info-title">TATA TERTIB PESERTA</h6>
                                <ol class="tata-tertib-list">
                                    <li>Peserta wajib hadir 30 menit sebelum tes dimulai.</li>
                                    <li>Peserta wajib membawa kartu tes yang telah dicetak.</li>
                                    <li>Peserta tidak diperkenankan membawa alat komunikasi ke dalam ruang tes.</li>
                                    <li>Peserta yang terlambat lebih dari 15 menit tidak diperkenankan mengikuti tes.</li>
                                </ol>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="nomor-kursi-box">
                                <div class="kursi-label">NOMOR KURSI</div>
                                <div class="kursi-value">A-013</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kartu-footer"></div>
            </div>

            <div class="d-flex justify-content-end gap-3 mt-5">
                <a href="{{ route('beranda') }}" class="btn-kembali">Kembali ke Beranda</a>
                <a href="#" class="btn-unduh">
                    <i class="fas fa-download me-2"></i>
                    Unduh PDF
                </a>
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
            max-width: 100%;
            background-color: var(--color-white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .kartu-header {
            background-color: var(--color-primary);
            color: var(--color-white);
            padding: 25px 40px;
        }

        .kartu-logo {
            height: 60px;
            /* background: white; */
            border-radius: 50%;
            /* padding: 5px; */
        }

        .kartu-header h5 {
            font-size: 1.3rem;
            letter-spacing: 1px;
        }

        .kartu-body {
            padding: 40px;
            border-top: 5px solid #F7B801;
            min-height: 500px;
        }

        .info-title {
            color: var(--color-primary);
            font-weight: 700;
            margin-bottom: 20px;
            font-size: 1.1rem;
        }

        .info-item {
            display: flex;
            margin-bottom: 12px;
            font-size: 0.95rem;
        }

        .info-label {
            width: 200px;
            font-weight: 500;
            color: var(--color-black);
        }

        .info-colon {
            width: 20px;
            color: var(--color-black);
        }

        .info-value {
            flex: 1;
            font-weight: 500;
            color: var(--color-text);
        }

        .tata-tertib-list {
            padding-left: 1.2rem;
            color: var(--color-text);
            font-size: 0.95rem;
        }

        .tata-tertib-list li {
            margin-bottom: 8px;
        }

        .nomor-kursi-box {
            background-color: var(--color-primary);
            color: var(--color-white);
            padding: 14px;
            border-radius: 15px;
            text-align: center;
        }

        .kursi-label {
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 3px;
        }

        .kursi-value {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .kartu-footer {
            height: 40px;
            background-color: var(--color-primary);
            border-top: 5px solid #F7B801;
        }

        .btn-kembali {
            background-color: transparent;
            color: var(--color-primary);
            border: 2px solid var(--color-primary);
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-kembali:hover {
            background-color: var(--color-primary);
            color: var(--color-white);
        }

        .btn-unduh {
            background-color: var(--color-primary);
            color: var(--color-white);
            border: 2px solid var(--color-primary);
            padding: 10px 32px;
            border-radius: 50px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .btn-unduh:hover {
            background-color: #4a148c; /* Darker purple */
            border-color: #4a148c;
        }

        @media (max-width: 992px) {
            .nomor-kursi-box {
                margin-top: 30px;
                max-width: 200px;
            }
        }

        @media (max-width: 768px) {
            .kartu-header {
                padding: 20px;
            }
            .kartu-header h5 {
                font-size: 1.1rem;
            }
            .kartu-logo {
                height: 50px;
            }
            .info-item {
                flex-direction: column;
            }
            .info-label {
                width: 100%;
                margin-bottom: 2px;
            }
            .info-colon {
                display: none;
            }
        }
    </style>
@endpush
