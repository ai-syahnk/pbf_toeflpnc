@extends('layouts.admin.main')

@section('title', 'Dashboard')

@section('content')
    <div class="row mb-2">
        <div class="col-12">
            <h5 class="fw-bold">Overview Data</h5>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Total Pendapatan -->
        <div class="col-md-4">
            <div class="card card-overview p-3">
                <div class="d-flex align-items-center mb-2">
                    <div class="rounded-circle bg-light me-3 d-flex align-items-center justify-content-center"
                        style="width: 45px; height: 45px; border: 2px solid #10B981;">
                        <i class="fas fa-wallet text-success"></i>
                    </div>
                    <div>
                        <span class="card-title text-success">TOTAL PENDAPATAN</span>
                        <div class="card-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Peserta -->
        <div class="col-md-4">
            <div class="card card-overview p-3">
                <div class="d-flex align-items-center mb-2">
                    <div class="rounded-circle bg-light me-3 d-flex align-items-center justify-content-center"
                        style="width: 45px; height: 45px; border: 2px solid #F59E0B;">
                        <i class="fas fa-users text-warning"></i>
                    </div>
                    <div>
                        <span class="card-title text-warning">TOTAL PESERTA</span>
                        <div class="card-value">{{ number_format($totalPeserta, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jadwal Aktif -->
        <div class="col-md-4">
            <div class="card card-overview p-3">
                <div class="d-flex align-items-center mb-2">
                    <div class="rounded-circle bg-light me-3 d-flex align-items-center justify-content-center"
                        style="width: 45px; height: 45px; border: 2px solid #6D28D9;">
                        <i class="fas fa-calendar-alt" style="color: #6D28D9;"></i>
                    </div>
                    <div>
                        <span class="card-title" style="color: #6D28D9;">JADWAL AKTIF</span>
                        <div class="card-value">{{ number_format($totalJadwalAktif, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Statistik Pendaftaran -->
        <div class="col-12">
            <div class="card card-chart">
                <h5 class="fw-bold mb-4">Statistik Pendaftaran Peserta</h5>
                <canvas id="registrationChart" style="max-height: 300px;"></canvas>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Distribusi Tes -->
        <div class="col-md-6">
            <div class="card card-chart h-100">
                <h5 class="fw-bold mb-4">Distribusi Tes</h5>
                <div class="d-flex justify-content-center">
                    <div style="width: 250px;">
                        <canvas id="distributionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Status Peserta -->
        <div class="col-md-6">
            <div class="card card-chart h-100">
                <h5 class="fw-bold mb-4">Status Peserta</h5>
                <div class="d-flex justify-content-center">
                    <div style="width: 250px;">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h5 class="fw-bold mb-3">Pendaftaran Peserta Terbaru</h5>
            <div class="table-responsive">
                <table class="table table-admin align-middle">
                    <thead>
                        <tr>
                            <th class="py-3 px-4">No</th>
                            <th class="py-3">Nomor Pendaftaran</th>
                            <th class="py-3">Nama Peserta</th>
                            <th class="py-3">Judul Tes</th>
                            <th class="py-3">Jenis Tes</th>
                            <th class="py-3">Tanggal Daftar</th>
                            <th class="py-3">Total Biaya</th>
                            <th class="py-3">Status Bayar</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @forelse ($pendaftaranTerbaru as $item)
                            <tr>
                                <td class="px-4">{{ $loop->iteration }}</td>
                                <td>{{ $item->nomor_pendaftaran }}</td>
                                <td>{{ $item->nama_peserta }}</td>
                                <td>{{ $item->judul_tes }}</td>
                                <td>{{ $item->jenis_tes }}</td>
                                <td>{{ $item->tanggal_daftar }}</td>
                                <td>Rp {{ number_format($item->total_biaya, 0, ',', '.') }}</td>
                                <td><span class="badge-lunas small">{{ $item->status_bayar }}</span></td>
                                <td class="text-center">
                                    <a href="{{ route('admin.peserta.show', $item->id) }}"
                                        class="btn btn-detail">DETAIL</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">Belum ada data pendaftaran peserta.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function() {
            const statistikPendaftaran = @json($statistikPendaftaran);
            const distribusiTes = @json($distribusiTes);
            const statusPeserta = @json($statusPeserta);

            // Statistik Pendaftaran Peserta (Bar Chart)
            const registrationEl = document.getElementById('registrationChart');
            if (registrationEl && statistikPendaftaran.labels.length) {
                new Chart(registrationEl.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: statistikPendaftaran.labels,
                        datasets: [{
                            label: 'Pendaftaran',
                            data: statistikPendaftaran.data,
                            backgroundColor: '#F59E0B',
                            borderRadius: 5,
                        }],
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            },
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1,
                                    precision: 0,
                                },
                            },
                        },
                    },
                });
            }

            // Distribusi Tes (Pie Chart)
            const distributionEl = document.getElementById('distributionChart');
            if (distributionEl && distribusiTes.labels.length) {
                new Chart(distributionEl.getContext('2d'), {
                    type: 'pie',
                    data: {
                        labels: distribusiTes.labels,
                        datasets: [{
                            label: 'Jml',
                            data: distribusiTes.data,
                            backgroundColor: distribusiTes.colors,
                        }],
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 20,
                                    usePointStyle: true,
                                    pointStyle: 'circle'
                                },
                            },
                        },
                    },
                });
            }

            // Status Peserta (Pie Chart)
            const statusEl = document.getElementById('statusChart');
            if (statusEl && statusPeserta.labels.length) {
                new Chart(statusEl.getContext('2d'), {
                    type: 'pie',
                    data: {
                        labels: statusPeserta.labels,
                        datasets: [{
                            label: 'Jml',
                            data: statusPeserta.data,
                            backgroundColor: statusPeserta.colors,
                        }],
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 15,
                                    usePointStyle: true,
                                    pointStyle: 'circle'
                                },
                            },
                        },
                    },
                });
            }
        })();
    </script>
@endpush
