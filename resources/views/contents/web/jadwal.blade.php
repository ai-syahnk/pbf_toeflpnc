@extends('layouts.web.main')

@section('content')
    <!-- Jadwal Tes Section -->
    <section class="jadwaltes-section" style="padding-top: 50px; padding-bottom: 50px;">
        <div class="container">
            <div class="row g-4 justify-content-center">
                
                <div class="col-lg-6 col-md-6">
                    <div class="jadwal-card h-100">
                        <div class="jadwal-card-header">Free For Alumni - EPT-P</div>
                        <div class="jadwal-card-body d-flex flex-column">
                            <div class="jadwal-price text-center mb-4">
                                <span class="old-price">Rp 100.000</span>
                                <span class="new-price">GRATIS</span>
                            </div>
                            <div class="jadwal-info flex-grow-1">
                                <div class="jadwal-item">
                                    <span class="label"><img src="{{ asset('icons/date.png') }}" width="18">
                                        Tanggal</span>
                                    <span class="text-description">: 6 Maret 2026</span>
                                </div>
                                <div class="jadwal-item">
                                    <span class="label"><img src="{{ asset('icons/time.png') }}" width="18">
                                        Waktu</span>
                                    <span class="text-description">: 09:00 - 11:00 WIB</span>
                                </div>
                                <div class="jadwal-item">
                                    <span class="label"><img src="{{ asset('icons/location.png') }}" width="18">
                                        Lokasi</span>
                                    <span class="text-description">: Lab. Bahasa GKB Lantai 2</span>
                                </div>
                                <div class="jadwal-item">
                                    <span class="label"><img src="{{ asset('icons/quota.png') }}" width="18">
                                        Kouta</span>
                                    <span class="text-description">: 24 Peserta</span>
                                </div>
                            </div>
                            <div class="mt-auto pt-4 text-center">
                                <a href="#" class="btn btn-daftar w-100">Daftar Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="jadwal-card h-100">
                        <div class="jadwal-card-header">Special Ramadhan Batch 1 - EPT-P</div>
                        <div class="jadwal-card-body d-flex flex-column">
                            <div class="jadwal-price text-center mb-4">
                                <span class="new-price">Rp 100.000</span>
                            </div>
                            <div class="jadwal-info flex-grow-1">
                                <div class="jadwal-item">
                                    <span class="label"><img src="{{ asset('icons/date.png') }}" width="18">
                                        Tanggal</span>
                                    <span class="text-description">: 9 Maret 2026</span>
                                </div>
                                <div class="jadwal-item">
                                    <span class="label"><img src="{{ asset('icons/time.png') }}" width="18">
                                        Waktu</span>
                                    <span class="text-description">: 09:00 - 11:00 WIB</span>
                                </div>
                                <div class="jadwal-item">
                                    <span class="label"><img src="{{ asset('icons/location.png') }}" width="18">
                                        Lokasi</span>
                                    <span class="text-description">: Lab. Bahasa GKB Lantai 2</span>
                                </div>
                                <div class="jadwal-item">
                                    <span class="label"><img src="{{ asset('icons/quota.png') }}" width="18">
                                        Kouta</span>
                                    <span class="text-description">: 32 Peserta</span>
                                </div>
                            </div>
                            <div class="mt-auto pt-4 text-center">
                                <a href="#" class="btn btn-daftar w-100">Daftar Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="jadwal-card h-100">
                        <div class="jadwal-card-header">Special Ramadhan Batch 2 - EPT-P</div>
                        <div class="jadwal-card-body d-flex flex-column">
                            <div class="jadwal-price text-center mb-4">
                                <span class="new-price">Rp 100.000</span>
                            </div>
                            <div class="jadwal-info flex-grow-1">
                                <div class="jadwal-item">
                                    <span class="label"><img src="{{ asset('icons/date.png') }}" width="18">
                                        Tanggal</span>
                                    <span class="text-description">: 9 Maret 2026</span>
                                </div>
                                <div class="jadwal-item">
                                    <span class="label"><img src="{{ asset('icons/time.png') }}" width="18">
                                        Waktu</span>
                                    <span class="text-description">: 13:30 - 15:30 WIB</span>
                                </div>
                                <div class="jadwal-item">
                                    <span class="label"><img src="{{ asset('icons/location.png') }}" width="18">
                                        Lokasi</span>
                                    <span class="text-description">: Lab. Bahasa GKB Lantai 2</span>
                                </div>
                                <div class="jadwal-item">
                                    <span class="label"><img src="{{ asset('icons/quota.png') }}" width="18">
                                        Kouta</span>
                                    <span class="text-description">: 32 Peserta</span>
                                </div>
                            </div>
                            <div class="mt-auto pt-4 text-center">
                                <a href="#" class="btn btn-daftar w-100">Daftar Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="jadwal-card h-100">
                        <div class="jadwal-card-header">Special Kemerdekaan - ITP</div>
                        <div class="jadwal-card-body d-flex flex-column">
                            <div class="jadwal-price text-center mb-4">
                                <span class="new-price">Rp 81.000</span>
                            </div>
                            <div class="jadwal-info flex-grow-1">
                                <div class="jadwal-item">
                                    <span class="label"><img src="{{ asset('icons/date.png') }}" width="18">
                                        Tanggal</span>
                                    <span class="text-description">: 18 Agustus 2026</span>
                                </div>
                                <div class="jadwal-item">
                                    <span class="label"><img src="{{ asset('icons/time.png') }}" width="18">
                                        Waktu</span>
                                    <span class="text-description">: 13:30 - 15:30 WIB</span>
                                </div>
                                <div class="jadwal-item">
                                    <span class="label"><img src="{{ asset('icons/location.png') }}" width="18">
                                        Lokasi</span>
                                    <span class="text-description">: Lab. Bahasa GKB Lantai 2</span>
                                </div>
                                <div class="jadwal-item">
                                    <span class="label"><img src="{{ asset('icons/quota.png') }}" width="18">
                                        Kouta</span>
                                    <span class="text-description">: 24 Peserta</span>
                                </div>
                            </div>
                            <div class="mt-auto pt-4 text-center">
                                <a href="#" class="btn btn-daftar w-100">Daftar Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
