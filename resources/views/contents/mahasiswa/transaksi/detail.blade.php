@extends('layouts.web.main')

@section('content')
    <section class="detail-transaksi-section">
        <div class="container py-5">
            <!-- Informasi Pendaftaran -->
            <div class="detail-card-wrapper mb-5">
                <div class="detail-card-header">
                    <h5>Informasi Pendaftaran</h5>
                </div>
                <div class="detail-card-body">
                    <div class="detail-item">
                        <div class="detail-label">Nomor Pendaftaran</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">TOEFL-101-260226-013</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Tanggal Daftar</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">26 Februari 2026</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Status Bayar</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">LUNAS</div>
                    </div>
                </div>
            </div>

            <!-- Informasi Tes -->
            <div class="detail-card-wrapper mb-5">
                <div class="detail-card-header">
                    <h5>Informasi Tes</h5>
                </div>
                <div class="detail-card-body">
                    <div class="detail-item">
                        <div class="detail-label">Nama Tes</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">Special Ramadhan Batch 1 - EPT-P</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Jenis Tes</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">TOEFL EPT-P</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Tanggal Tes</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">9 Maret 2026</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Waktu</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">09:00 – 11:00 WIB</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Lokasi</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">Lab. Bahasa GKB Lantai 2</div>
                    </div>
                </div>
            </div>

            <!-- Data Peserta -->
            <div class="detail-card-wrapper mb-5">
                <div class="detail-card-header">
                    <h5>Data Peserta</h5>
                </div>
                <div class="detail-card-body">
                    <div class="detail-item">
                        <div class="detail-label">Nama Peserta</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">Aika Eva Darlene</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Jenis Kelamin</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">Perempuan</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Status</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">Mahasiswa</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">NIM</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">250132102</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Program Studi</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">D3 Teknik Informatika</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Nomor WhatsApp</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">081234567890</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Email</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">aikaeva_darlene.stu@pnc.ac.id</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Keperluan Tes</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">Syarat Kelulusan</div>
                    </div>
                </div>
            </div>

            <!-- Informasi Pembayaran -->
            <div class="detail-card-wrapper mb-5">
                <div class="detail-card-header">
                    <h5>Informasi Pembayaran</h5>
                </div>
                <div class="detail-card-body">
                    <div class="detail-item">
                        <div class="detail-label">Total Biaya</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">Rp 100.000</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Metode Pembayaran</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">QRIS</div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mb-5">
                <a href="{{ route('transaksi.kartu-tes') }}" class="btn-kartu-tes">Lihat Kartu Tes</a>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .detail-transaksi-section {
            background-color: var(--color-white);
        }

        .detail-card-wrapper {
            background-color: transparent;
        }

        .detail-card-header {
            background-color: #EBE5FF;
            padding: 15px 30px;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .detail-card-header h5 {
            color: var(--color-primary);
            margin: 0;
            font-weight: 700;
            font-size: 1.15rem;
        }

        .detail-card-body {
            background-color: var(--color-white);
            padding: 30px;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border-top: 3px solid #F7B801;
        }

        .detail-item {
            display: flex;
            margin-bottom: 20px;
            font-size: 1rem;
        }

        .detail-item:last-child {
            margin-bottom: 0;
        }

        .detail-label {
            width: 220px;
            font-weight: 700;
            color: var(--color-black);
        }

        .detail-colon {
            width: 30px;
            color: var(--color-black);
        }

        .detail-value {
            flex: 1;
            color: var(--color-text);
            font-weight: 500;
        }

        .btn-kartu-tes {
            background-color: transparent;
            color: var(--color-primary);
            border: 1.5px solid var(--color-primary);
            padding: 10px 45px;
            border-radius: 50px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-kartu-tes:hover {
            background-color: var(--color-primary);
            color: var(--color-white);
        }

        @media (max-width: 768px) {
            .detail-item {
                flex-direction: column;
            }
            .detail-label {
                width: 100%;
                margin-bottom: 5px;
            }
            .detail-colon {
                display: none;
            }
        }
    </style>
@endpush
