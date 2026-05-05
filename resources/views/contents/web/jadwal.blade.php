@extends('layouts.web.main')

@section('content')
    <!-- Jadwal Tes Section -->
    <section class="jadwaltes-section" style="padding-top: 50px; padding-bottom: 50px;">
        <div class="container">
            <div class="row g-4 justify-content-center">
                @forelse ($jadwalTes as $item)
                    <div class="col-lg-6 col-md-6">
                        <div class="jadwal-card h-100">
                            <div class="jadwal-card-header">{{ $item->judul_tes }} - {{ $item->jenis_tes }}</div>
                            <div class="jadwal-card-body d-flex flex-column">
                                <div class="jadwal-price text-center mb-4">
                                    @if ((float) $item->harga <= 0)
                                        <span class="old-price">Rp 100.000</span>
                                        <span class="new-price">GRATIS</span>
                                    @else
                                        <span class="new-price">Rp
                                            {{ number_format((float) $item->harga, 0, ',', '.') }}</span>
                                    @endif
                                </div>
                                <div class="jadwal-info flex-grow-1">
                                    <div class="jadwal-item">
                                        <span class="label"><img src="{{ asset('icons/date.png') }}" width="18">
                                            Tanggal</span>
                                        <span class="text-description">: {{ tanggal_panjang($item->tanggal_tes) }}</span>
                                    </div>
                                    <div class="jadwal-item">
                                        <span class="label"><img src="{{ asset('icons/time.png') }}" width="18">
                                            Waktu</span>
                                        <span class="text-description">: {{ $item->waktu }}</span>
                                    </div>
                                    <div class="jadwal-item">
                                        <span class="label"><img src="{{ asset('icons/location.png') }}" width="18">
                                            Lokasi</span>
                                        <span class="text-description">: {{ $item->lokasi }}</span>
                                    </div>
                                    <div class="jadwal-item">
                                        <span class="label"><img src="{{ asset('icons/quota.png') }}" width="18">
                                            Kuota</span>
                                        <span class="text-description">: {{ $item->kuota }} Peserta</span>
                                    </div>
                                </div>
                                <div class="mt-auto pt-4 text-center">
                                    <a href="{{ auth()->check() ? route('pendaftaran.step1') : route('login') }}"
                                        class="btn btn-daftar w-100">
                                        Daftar Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-light border text-center mb-0" role="alert">
                            Jadwal tes belum tersedia. Silakan cek kembali nanti.
                        </div>
                    </div>
                @endforelse

            </div>
        </div>
    </section>
@endsection
