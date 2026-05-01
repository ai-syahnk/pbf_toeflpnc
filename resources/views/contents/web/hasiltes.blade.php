@extends('layouts.web.main')

@section('content')
    <!-- Hasil Tes Section -->
    <section class="hasiltes-section">
        <div class="container">
            {{-- <div class="section-title">
                <h2>Hasil Tes</h2>
            </div> --}}
            <!-- Kartu Hasil Utama -->
            <div class="hasil-utama-card mb-5">
                <div class="hasil-header">
                    <img src="{{ asset('icons/paper.png') }}" width="24">
                    <h4 class="mb-0">Hasil Tes</h4>
                </div>
                <div class="hasil-body">
                    <div class="d-flex align-items-center mb-4">
                        <div class="badge-icon">
                            <img src="{{ asset('icons/test.png') }}">
                        </div>
                        <div>
                            <div class="d-flex align-items-center gap-3">
                                <h4 class="mb-0 fw-bold" style="color: #333333;">TOEFL EPT-P</h4>
                                <span class="badge badge-status-lulus">LULUS</span>
                            </div>
                            <p class="text-muted mb-0" style="font-size: 12px;">Tanggal Tes: 9 Maret 2026</p>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-3 col-6">
                            <div class="skor-box text-center">
                                <h5 class="mb-3">Listening</h5>
                                <h2 class="fw-bold mb-0">52</h2>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="skor-box text-center">
                                <h5 class="mb-3">Structure</h5>
                                <h2 class="fw-bold mb-0">50</h2>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="skor-box text-center">
                                <h5 class="mb-3">Reading</h5>
                                <h2 class="fw-bold mb-0">56</h2>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="skor-box text-center total-skor">
                                <h5 class="mb-3">Total Skor</h5>
                                <h2 class="fw-bold mb-0">523</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Riwayat Hasil Tes Section -->
    <section class="riwayattes-section">
        <div class="container">
            <div class="section-title">
                <h2>Riwayat Hasil Tes</h2>
            </div>

            <div class="table-responsive" style="margin-bottom: 8rem !important;">
                <table class="table table-borderless table-riwayat">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Tes</th>
                            <th>Tanggal Tes</th>
                            <th>Listening</th>
                            <th>Structure</th>
                            <th>Reading</th>
                            <th>Total Skor</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>TOEFL ITP</td>
                            <td>18 Agustus 2025</td>
                            <td>37</td>
                            <td>32</td>
                            <td>40</td>
                            <td>363</td>
                            <td><span class="badge badge-status-tidak-lulus badge-riwayat">TIDAK LULUS</span></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>TOEFL EPT-P</td>
                            <td>9 Maret 2026</td>
                            <td>52</td>
                            <td>50</td>
                            <td>56</td>
                            <td>523</td>
                            <td><span class="badge badge-status-lulus badge-riwayat">LULUS</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Informasi Pengambilan Sertifikat -->
            <div class="info-sertifikat-card">
                <div class="info-sertifikat-header">
                    <h4 class="text-center fw-bold">Informasi Pengambilan Sertifikat</h4>
                </div>
                <div class="info-sertifikat-body">
                    <div class="row">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <p class="info-sertifikat-desc">Sertifikat dapat diambil setelah skor TOEFL muncul pada platform
                                TOEFL PNC.</p>

                            <div class="d-flex mb-4">
                                <div class="info-icon-wrapper">
                                    <img src="{{ asset('icons/location.png') }}">
                                </div>
                                <div class="info-detail">
                                    <h6 class="fw-bold mb-1">Lokasi Pengambilan</h6>
                                    <p class="text-muted mb-0">Ruang UPA Bahasa, Lantai 2 GKB,<br>Politeknik Negeri Cilacap.
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex mb-4">
                                <div class="info-icon-wrapper">
                                    <img src="{{ asset('icons/time.png') }}">
                                </div>
                                <div class="info-detail">
                                    <h6 class="fw-bold mb-1">Jam Kerja</h6>
                                    <p class="text-muted mb-0">Senin - Jum'at<br>08.00 - 15.30 WIB</p>
                                </div>
                            </div>

                            <div class="d-flex gap-3 flex-wrap mt-4">
                                <a href="#" class="btn btn-outline-custom d-flex align-items-center gap-2">
                                    <img src="{{ asset('icons/paper.png') }}" width="14"> Unduh Surat Pengambilan
                                </a>
                                <a href="#" class="btn btn-outline-custom d-flex align-items-center gap-2">
                                    <img src="{{ asset('icons/paper.png') }}" width="14"> Unduh Surat Kuasa
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="catatan-box">
                                <h6 class="fw-bold mb-3 d-flex align-items-center gap-2 catatan-title">
                                    <span class="catatan-icon">i</span>
                                    Catatan Penting
                                </h6>
                                <ul class="catatan-list">
                                    <li>Sertifikat dapat dicetak dengan minimal skor TOEFL ITP atau EPT-P adalah 400.</li>
                                    <li>Peserta membawa kartu tes saat pengambilan.</li>
                                    <li>Khusus untuk TOEFL EPT-P, jika peserta tidak bisa mengambil sendiri, dapat
                                        diwakilkan
                                        dengan membawa <strong>Surat Pernyataan Pengambilan Sertifikat</strong> (diisi oleh
                                        yang
                                        mewakili) dan <strong>Surat Kuasa Pengambilan Sertifikat</strong> (diisi oleh orang
                                        yang
                                        namanya tertera di sertifikat).</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
