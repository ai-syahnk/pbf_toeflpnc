@extends('layouts.web.main')

@section('content')
    <section class="detail-transaksi-section py-5">
        <div class="container">
            <div class="detail-card-wrapper mb-4">
                <div class="detail-card-header">
                    <h5>Informasi Pendaftaran</h5>
                </div>
                <div class="detail-card-body">
                    <div class="detail-item">
                        <div class="detail-label">Nomor Pendaftaran</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">{{ $pendaftaranTes->nomor_pendaftaran ?: '-' }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Tanggal Daftar</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">{{ tanggal_panjang($pendaftaranTes->created_at) }} {{ $pendaftaranTes->created_at->format('H:i') }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Status Bayar</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value text-uppercase">{{ str_replace('_', ' ', $pendaftaranTes->status) }}</div>
                    </div>
                </div>
            </div>

            <div class="detail-card-wrapper mb-4">
                <div class="detail-card-header">
                    <h5>Informasi Tes</h5>
                </div>
                <div class="detail-card-body">
                    <div class="detail-item">
                        <div class="detail-label">Nama Tes</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">{{ $pendaftaranTes->jadwalTes->judul_tes }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Jenis Tes</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">{{ $pendaftaranTes->jadwalTes->jenis_tes }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Tanggal Tes</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">{{ tanggal_panjang($pendaftaranTes->jadwalTes->tanggal_tes) }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Waktu</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">{{ $pendaftaranTes->jadwalTes->waktu }}</div>
                    </div>
                    <div class="detail-item mb-0">
                        <div class="detail-label">Lokasi</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">{{ $pendaftaranTes->jadwalTes->lokasi }}</div>
                    </div>
                </div>
            </div>

            <div class="detail-card-wrapper mb-4">
                <div class="detail-card-header">
                    <h5>Data Peserta</h5>
                </div>
                <div class="detail-card-body">
                    <div class="detail-item">
                        <div class="detail-label">Nama Peserta</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">{{ $pendaftaranTes->nama_peserta }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Jenis Kelamin</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">{{ $pendaftaranTes->jenis_kelamin }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Status</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value text-capitalize">{{ $pendaftaranTes->status_pendaftar }}</div>
                    </div>
                    @if ($pendaftaranTes->nim)
                        <div class="detail-item">
                            <div class="detail-label">NIM</div>
                            <div class="detail-colon">:</div>
                            <div class="detail-value">{{ $pendaftaranTes->nim }}</div>
                        </div>
                    @endif
                    @if ($pendaftaranTes->program_studi)
                        <div class="detail-item">
                            <div class="detail-label">Program Studi</div>
                            <div class="detail-colon">:</div>
                            <div class="detail-value">{{ $pendaftaranTes->program_studi }}</div>
                        </div>
                    @endif
                    @if ($pendaftaranTes->tahun_lulus)
                        <div class="detail-item">
                            <div class="detail-label">Tahun Lulus</div>
                            <div class="detail-colon">:</div>
                            <div class="detail-value">{{ $pendaftaranTes->tahun_lulus }}</div>
                        </div>
                    @endif
                    @if ($pendaftaranTes->no_ktp)
                        <div class="detail-item">
                            <div class="detail-label">Nomor KTP</div>
                            <div class="detail-colon">:</div>
                            <div class="detail-value">{{ $pendaftaranTes->no_ktp }}</div>
                        </div>
                    @endif
                    <div class="detail-item">
                        <div class="detail-label">Nomor WhatsApp</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">{{ $pendaftaranTes->no_wa }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Email</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">{{ $pendaftaranTes->email_peserta }}</div>
                    </div>
                    <div class="detail-item mb-0">
                        <div class="detail-label">Keperluan Tes</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">{{ $pendaftaranTes->keperluan_tes }}</div>
                    </div>
                </div>
            </div>

            <div class="detail-card-wrapper mb-5">
                <div class="detail-card-header">
                    <h5>Informasi Pembayaran</h5>
                </div>
                <div class="detail-card-body">
                    <div class="detail-item">
                        <div class="detail-label">Total Biaya</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">
                            @if ((float) $pendaftaranTes->harga_tes <= 0)
                                GRATIS
                            @else
                                Rp {{ number_format((float) $pendaftaranTes->harga_tes, 0, ',', '.') }}
                            @endif
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Metode Pembayaran</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">{{ $pendaftaranTes->pembayaran?->metode ?? '-' }}</div>
                    </div>
                    <div class="detail-item mb-0">
                        <div class="detail-label">Dibayar Pada</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">
                            {{ tanggal_panjang($pendaftaranTes->dibayar_pada) }} {{ optional($pendaftaranTes->dibayar_pada)->format('H:i') ?? '-' }}</div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-3 mb-5 flex-wrap">
                <a href="{{ route('transaksi.riwayat') }}" class="btn-kartu-tes">Kembali ke Riwayat</a>
                @if ($pendaftaranTes->canShowKartuTes())
                    <a href="{{ route('transaksi.kartu-tes', $pendaftaranTes) }}"
                        class="btn-kartu-tes btn-kartu-tes-primary">Lihat Kartu Tes</a>
                @endif
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
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
            margin-bottom: 18px;
            font-size: 1rem;
        }

        .detail-item:last-child {
            margin-bottom: 0;
        }

        .detail-label {
            width: 220px;
            font-weight: 700;
        }

        .detail-colon {
            width: 30px;
        }

        .detail-value {
            flex: 1;
        }

        .btn-kartu-tes {
            background-color: transparent;
            color: var(--color-primary);
            border: 1.5px solid var(--color-primary);
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 700;
            text-decoration: none;
        }

        .btn-kartu-tes-primary {
            background-color: var(--color-primary);
            color: #fff;
        }
    </style>
@endpush
