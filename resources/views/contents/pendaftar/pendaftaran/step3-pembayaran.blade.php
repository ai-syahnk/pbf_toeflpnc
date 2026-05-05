@extends('layouts.web.main')

@section('content')
    @php
        $isLunas = $pendaftaranTes->status === \App\Models\PendaftaranTes::STATUS_LUNAS;
        $expiresAtIso = optional($pendaftaranTes->hold_expires_at)->toIso8601String();
    @endphp

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
                                <img src="{{ asset('icons/pesanan2.png') }}" alt="Konfirmasi Pesanan" class="reg-step-icon">
                            </div>
                            <div class="step-label">Konfirmasi Pesanan</div>
                        </div>
                        <div class="step-item active">
                            <div class="reg-step-icon-wrapper">
                                <img src="{{ asset('icons/walet2.png') }}" alt="Pembayaran"
                                    class="reg-step-icon active-icon">
                            </div>
                            <div class="step-label">Pembayaran</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mb-4">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                        <div
                            class="card-body p-4 d-flex flex-column flex-md-row justify-content-between gap-3 align-items-md-center">
                            <div>
                                <div class="text-muted small text-uppercase">Nomor Pendaftaran</div>
                                <h4 class="fw-bold mb-0">{{ $pendaftaranTes->nomor_pendaftaran }}</h4>
                            </div>
                            <div class="text-md-end">
                                <div class="text-muted small text-uppercase">Total Pembayaran</div>
                                <div class="fw-bold text-purple fs-4">
                                    @if ((float) $pendaftaranTes->harga_tes <= 0)
                                        GRATIS
                                    @else
                                        Rp {{ number_format((float) $pendaftaranTes->harga_tes, 0, ',', '.') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center g-4">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 20px;">
                        <div class="card-header section-header" style="border-top-left-radius: 20px; border-top-right-radius: 20px;">Petunjuk Pembayaran QRIS</div>
                        <div class="card-body p-4">
                            @if ($isLunas)
                                <div class="alert alert-success mb-0">Pembayaran Anda sudah dikonfirmasi. Silakan lanjut ke
                                    detail transaksi atau kartu tes.</div>
                            @elseif ((float) $pendaftaranTes->harga_tes <= 0)
                                <div class="alert alert-info mb-0">Jadwal ini gratis. Klik tombol konfirmasi di bawah untuk
                                    menyelesaikan pendaftaran.</div>
                            @else
                                <ol class="mb-0 ps-3 text-muted" style="line-height: 1.9;">
                                    <li>Screenshot Kode QR yang ditampilkan pada halaman pembayaran.</li>
                                    <li>Buka aplikasi Mobile Banking atau e-wallet yang ditampilkan pada halaman pembayaran.</li>
                                    <li>Pilih menu Scan QR atau QRIS pada aplikasi.</li>
                                    <li>Scan kode QR yang tertampil pada halaman pembayaran.</li>
                                    <li>Periksa kembali jumlah pembayaran, kemudian lakukan konfirmasi pembayaran.</li>
                                    <li>Setelah pembayaran berhasil, simpan bukti transaksi sebagai arsip pribadi.</li>
                                    <li>Kembali ke halaman website dan klik tombol “Saya Sudah Bayar” setelah pembayaran selesai.</li>
                                    <li>Jika waktu habis, ulangi proses konfirmasi pesanan dari langkah sebelumnya.</li>
                                </ol>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                        <div class="card-header section-header" style="border-top-left-radius: 20px; border-top-right-radius: 20px;">Status Pembayaran</div>
                        <div class="card-body p-4 text-center">
                            @if ($isLunas)
                                <div class="status-pill status-success mb-3">LUNAS</div>
                                <p class="text-muted mb-0">Pembayaran diterima pada
                                    {{ optional($pendaftaranTes->dibayar_pada)->format('d M Y H:i') }}</p>
                            @else
                                <div class="status-pill status-warning mb-3">MENUNGGU PEMBAYARAN</div>
                                <div class="text-muted small text-uppercase">Bayar Dalam</div>
                                <div class="fw-bold fs-3" id="countdown" data-expires-at="{{ $expiresAtIso }}">--:--:--
                                </div>
                            @endif
                        </div>
                    </div>

                    @unless ($isLunas)
                        <div class="card border-0 shadow-sm mt-4" style="border-radius: 20px;">
                            <div class="card-body p-4 text-center">
                                <img src="{{ asset('images/qris.png') }}" alt="QRIS" class="img-fluid mb-3"
                                    style="max-height: 54px;">
                                <img src="{{ asset('images/qris_code.png') }}" alt="QRIS Code" class="img-fluid rounded border">
                            </div>
                        </div>
                    @endunless
                </div>
            </div>

            <div class="row justify-content-center mt-4">
                <div class="col-lg-10">
                    <div class="d-flex flex-column flex-sm-row justify-content-end gap-3">
                        @if (!$isLunas)
                            <a href="{{ route('pendaftaran.step2', $pendaftaranTes) }}"
                                class="btn btn-outline-custom px-4 py-3" style="display: none;">Kembali ke Konfirmasi</a>
                            <form action="{{ route('pendaftaran.bayar', $pendaftaranTes) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-auth px-4 py-3">Saya Sudah Bayar</button>
                            </form>
                        @else
                            <a href="{{ route('transaksi.detail', $pendaftaranTes) }}"
                                class="btn btn-outline-custom px-4 py-3">Lihat Detail Transaksi</a>
                            <a href="{{ route('transaksi.kartu-tes', $pendaftaranTes) }}"
                                class="btn btn-auth px-4 py-3">Lihat Kartu Tes</a>
                        @endif
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
                background-color: var(--color-primary);
                color: #fff;
                font-weight: 700;
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

            .btn-auth {
                background-color: var(--color-primary) !important;
                border-color: var(--color-primary) !important;
                color: #fff !important;
            }

            .btn-outline-purple {
                border: 1.5px solid var(--color-primary);
                color: var(--color-primary);
            }

            .status-pill {
                display: inline-block;
                padding: 0.5rem 1rem;
                border-radius: 999px;
                font-weight: 700;
            }

            .status-success {
                background-color: #dff5e9;
                color: #0a7b45;
            }

            .status-warning {
                background-color: #fff3cd;
                color: #9a6700;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const countdown = document.getElementById('countdown');

                if (!countdown || !countdown.dataset.expiresAt) {
                    return;
                }

                const expiresAt = new Date(countdown.dataset.expiresAt).getTime();

                const tick = () => {
                    const distance = expiresAt - Date.now();

                    if (distance <= 0) {
                        countdown.textContent = '00:00:00';
                        return;
                    }

                    const hours = String(Math.floor(distance / (1000 * 60 * 60))).padStart(2, '0');
                    const minutes = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2,
                    '0');
                    const seconds = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');

                    countdown.textContent = `${hours}:${minutes}:${seconds}`;
                };

                tick();
                setInterval(tick, 1000);
            });
        </script>
    @endpush
@endsection
