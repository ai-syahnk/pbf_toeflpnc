<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kartu Tes {{ $pendaftaranTes->nomor_pendaftaran }}</title>
    <style>
        @page {
            margin: 24px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #1f2937;
            font-size: 12px;
            line-height: 1.5;
        }

        .kartu-wrapper {
            border: 1px solid #d1d5db;
            border-radius: 18px;
            overflow: hidden;
        }

        .kartu-header,
        .kartu-footer,
        .nomor-kursi-box {
            background-color: #233d8f;
            color: #ffffff;
        }

        .kartu-header {
            padding: 24px 28px;
        }

        .header-table,
        .content-table,
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-title {
            text-align: center;
        }

        .header-title h1,
        .header-title h2 {
            margin: 0;
        }

        .header-title h1 {
            font-size: 18px;
        }

        .header-title h2 {
            font-size: 17px;
            margin-top: 4px;
        }

        .kartu-logo {
            height: 58px;
        }

        .kartu-body {
            padding: 28px;
            border-top: 5px solid #f7b801;
        }

        .content-left {
            width: 72%;
            vertical-align: top;
            padding-right: 24px;
        }

        .content-right {
            width: 28%;
            vertical-align: top;
        }

        .info-group {
            margin-bottom: 24px;
        }

        .info-title {
            color: #233d8f;
            font-size: 14px;
            font-weight: 700;
            margin: 0 0 12px;
        }

        .info-table td {
            padding: 5px 0;
            vertical-align: top;
        }

        .info-label {
            width: 180px;
            font-weight: 700;
        }

        .info-colon {
            width: 14px;
        }

        .nomor-kursi-box {
            border-radius: 16px;
            padding: 20px 16px;
            text-align: center;
        }

        .kursi-label {
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        .kursi-value {
            font-size: 28px;
            font-weight: 700;
            margin-top: 8px;
        }

        .tata-tertib-list {
            margin: 0;
            padding-left: 18px;
        }

        .tata-tertib-list li {
            margin-bottom: 6px;
        }

        .kartu-footer {
            height: 18px;
            border-top: 5px solid #f7b801;
        }
    </style>
</head>

<body>
    <div class="kartu-wrapper">
        <div class="kartu-header">
            <table class="header-table">
                <tr>
                    <td style="width: 90px;">
                        @if (file_exists($logoPath))
                            <img src="{{ $logoPath }}" alt="Logo PNC" class="kartu-logo">
                        @endif
                    </td>
                    <td class="header-title">
                        <h1>KARTU TANDA PESERTA TES TOEFL</h1>
                        <h2>POLITEKNIK NEGERI CILACAP</h2>
                    </td>
                    <td style="width: 90px;"></td>
                </tr>
            </table>
        </div>

        <div class="kartu-body">
            <table class="content-table">
                <tr>
                    <td class="content-left">
                        <div class="info-group">
                            <h3 class="info-title">INFORMASI PESERTA</h3>
                            <table class="info-table">
                                <tr>
                                    <td class="info-label">NOMOR PENDAFTARAN</td>
                                    <td class="info-colon">:</td>
                                    <td>{{ $pendaftaranTes->nomor_pendaftaran }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">NAMA PESERTA</td>
                                    <td class="info-colon">:</td>
                                    <td>{{ $pendaftaranTes->nama_peserta }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">STATUS</td>
                                    <td class="info-colon">:</td>
                                    <td>{{ str($pendaftaranTes->status_pendaftar)->title() }}</td>
                                </tr>
                                @if ($pendaftaranTes->nim)
                                    <tr>
                                        <td class="info-label">NIM</td>
                                        <td class="info-colon">:</td>
                                        <td>{{ $pendaftaranTes->nim }}</td>
                                    </tr>
                                @endif
                                @if ($pendaftaranTes->program_studi)
                                    <tr>
                                        <td class="info-label">PROGRAM STUDI</td>
                                        <td class="info-colon">:</td>
                                        <td>{{ $pendaftaranTes->program_studi }}</td>
                                    </tr>
                                @endif
                                @if ($pendaftaranTes->no_ktp)
                                    <tr>
                                        <td class="info-label">NOMOR KTP</td>
                                        <td class="info-colon">:</td>
                                        <td>{{ $pendaftaranTes->no_ktp }}</td>
                                    </tr>
                                @endif
                            </table>
                        </div>

                        <div class="info-group">
                            <h3 class="info-title">INFORMASI TES</h3>
                            <table class="info-table">
                                <tr>
                                    <td class="info-label">NAMA TES</td>
                                    <td class="info-colon">:</td>
                                    <td>{{ $pendaftaranTes->jadwalTes->judul_tes }} -
                                        {{ $pendaftaranTes->jadwalTes->jenis_tes }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">TANGGAL TES</td>
                                    <td class="info-colon">:</td>
                                    <td>{{ tanggal_panjang($pendaftaranTes->jadwalTes->tanggal_tes) }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">WAKTU</td>
                                    <td class="info-colon">:</td>
                                    <td>{{ $pendaftaranTes->jadwalTes->waktu }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">LOKASI</td>
                                    <td class="info-colon">:</td>
                                    <td>{{ $pendaftaranTes->jadwalTes->lokasi }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="info-group" style="margin-bottom: 0;">
                            <h3 class="info-title">TATA TERTIB PESERTA</h3>
                            <ol class="tata-tertib-list">
                                <li>Peserta wajib hadir 30 menit sebelum tes dimulai.</li>
                                <li>Peserta wajib membawa kartu tes ini saat pelaksanaan ujian.</li>
                                <li>Peserta wajib membawa identitas diri yang masih berlaku.</li>
                                <li>Peserta yang terlambat lebih dari 15 menit tidak diperkenankan mengikuti tes.</li>
                            </ol>
                        </div>
                    </td>
                    <td class="content-right">
                        <div class="nomor-kursi-box">
                            <div class="kursi-label">NOMOR KURSI</div>
                            <div class="kursi-value">{{ $pendaftaranTes->nomor_kursi ?: 'Akan Diatur' }}</div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="kartu-footer"></div>
    </div>
</body>

</html>
