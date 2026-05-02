@extends('layouts.web.main')

@section('content')
    <!-- Transaction History Section -->
    <section class="riwayattes-section">
        <div class="container">
            <div class="section-title">
                <h2>Riwayat Transaksi</h2>
            </div>

            <div class="table-responsive shadow-sm" style="border-radius: 20px; margin-bottom: 8rem !important;">
                <table class="table table-borderless table-riwayat">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Pendaftaran</th>
                            <th>Jenis Tes</th>
                            <th>Tanggal Daftar</th>
                            <th>Total Biaya</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>TOEFL-101-260226-013</td>
                            <td>TOEFL EPT-P</td>
                            <td>26 Februari 2026</td>
                            <td>Rp 100.000</td>
                            <td>
                                <span class="badge badge-status-lulus badge-riwayat">SELESAI</span>
                            </td>
                            <td>
                                <a href="{{ route('transaksi.detail') }}" class="btn-detail">DETAIL</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>TOEFL-102-250701-020</td>
                            <td>TOEFL ITP</td>
                            <td>1 Juli 2025</td>
                            <td>Rp 100.000</td>
                            <td>
                                <span class="badge badge-status-lulus badge-riwayat">SELESAI</span>
                            </td>
                            <td>
                                <a href="{{ route('transaksi.detail') }}" class="btn-detail">DETAIL</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .btn-detail {
            background-color: #E7EDFF;
            color: #4A89FF;
            padding: 8px 30px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-detail:hover {
            background-color: #D6E0FF;
            color: #4A89FF;
        }
    </style>
@endpush
