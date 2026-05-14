<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Pengambilan Sertifikat</title>
    <style>
        @page {
            margin-top: 16mm;
            margin-bottom: 16mm;
            margin-left: 18mm;
            margin-right: 18mm;
        }

        body {
            font-family: "Times New Roman", serif;
            color: #111111;
            font-size: 12pt;
            line-height: 1.45;
            margin: 0;
        }

        .container {
            width: 100%;
        }

        .header {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        .header td {
            vertical-align: top;
        }

        .logo-cell {
            width: 150px;
            text-align: center;
        }

        .logo {
            width: 120px;
            margin-top: 0;
        }

        .logo-caption {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.4px;
            margin-top: 4px;
        }

        .instansi {
            text-align: center;
        }

        .instansi h1,
        .instansi h2,
        .instansi p {
            margin: 0;
        }

        .instansi h1 {
            font-size: 14pt;
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        .instansi h2 {
            font-size: 16pt;
            font-weight: 700;
            margin-top: 2px;
            text-transform: uppercase;
        }

        .instansi p {
            font-size: 10.5pt;
            line-height: 1.35;
        }

        .divider {
            border-top: 2px solid #111111;
            margin: 10px 0 22px;
        }

        .judul {
            text-align: center;
            margin-bottom: 20px;
        }

        .judul h3,
        .judul h4 {
            margin: 0;
            font-size: 12pt;
            font-weight: 700;
            text-transform: uppercase;
            line-height: 1.3;
        }

        .judul h4 {
            margin-top: 2px;
        }

        .paragraph {
            margin: 0 0 6px;
            text-align: justify;
        }

        .form-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
        }

        .form-table td {
            padding: 3px 0;
            vertical-align: top;
        }

        .field-label {
            width: 220px;
        }

        .field-colon {
            width: 12px;
        }

        .statement {
            text-align: justify;
            margin: 8px 0 0;
        }

        .spacer-large {
            height: 16px;
        }

        .signature-line {
            text-align: center;
            margin-top: 16px;
            margin-bottom: 38px;
        }

        .signature {
            width: 100%;
            border-collapse: collapse;
        }

        .signature td {
            width: 55%;
        }

        .signature-right {
            width: 45%;
            text-align: center;
            vertical-align: top;
        }

        .signature-role {
            margin: 0;
        }

        .signature-space {
            height: 42px;
        }
    </style>
</head>

<body>
    <div class="container">
        <table class="header">
            <tr>
                <td class="logo-cell">
                    @if (file_exists($logoPath))
                        <img src="{{ $logoPath }}" alt="Logo PNC" class="logo">
                    @endif
                </td>
                <td class="instansi">
                    <h1>UNIT PENUNJANG AKADEMIK BAHASA</h1>
                    <h2>POLITEKNIK NEGERI CILACAP</h2>
                    <p>Jalan Dr. Soetomo No. 1, Sidakaya - Cilacap 53212 Jawa Tengah</p>
                    <p>Telepon: (0282) 532128, Fax: (0282) 532129</p>
                    <p><a href="http://www.upabahasa.pnc.ac.id" target="_blank">www.upabahasa.pnc.ac.id</a>
                        Email: <a href="mailto:upabahasa@pnc.ac.id">upabahasa@pnc.ac.id</a></p>
                </td>
            </tr>
        </table>

        <div class="divider"></div>

        <div class="judul">
            <h3>SURAT PERNYATAAN PENGAMBILAN SERTIFIKAT</h3>
            <h4>NOMOR: {{ $nomorSurat }}</h4>
        </div>

        <p class="paragraph">Saya yang bertanda tangan di bawah ini:</p>

        <table class="form-table">
            <tr>
                <td class="field-label">Nama Lengkap</td>
                <td class="field-colon">:</td>
                <td>{{ '........................................' }}</td>
            </tr>
            <tr>
                <td class="field-label">Nomor Identitas (NIM/KTP)</td>
                <td class="field-colon">:</td>
                <td>{{ '........................................' }}</td>
            </tr>
        </table>

        <p class="paragraph">Dengan ini menyatakan bahwa saya mewakili:</p>

        <table class="form-table">
            <tr>
                <td class="field-label">Nama Peserta</td>
                <td class="field-colon">:</td>
                <td>{{ $namaPeserta ?: '........................................' }}</td>
            </tr>
            <tr>
                <td class="field-label">Status Peserta</td>
                <td class="field-colon">:</td>
                <td>{{ $statusPeserta ?: 'Mahasiswa / Alumni / Umum' }}</td>
            </tr>
            <tr>
                <td class="field-label">Nomor Identitas (NIM / KTP)</td>
                <td class="field-colon">:</td>
                <td>{{ $identitasPeserta ?: '........................................' }}</td>
            </tr>
        </table>

        <p class="statement">
            Untuk mengambil sertifikat TOEFL di Unit Penunjang Akademik (UPA) Bahasa Politeknik Negeri Cilacap.
        </p>
        <p class="statement">
            Saya bertanggung jawab penuh atas pengambilan sertifikat tersebut dan akan menyerahkannya kepada yang
            bersangkutan tanpa penyalahgunaan. Demikian surat pernyataan ini dibuat dengan sebenar-benarnya untuk
            dipergunakan sebagaimana mestinya.
        </p>

        <div class="spacer-large"></div>

        <table class="signature">
            <tr>
                <td></td>
                <td class="signature-right">
                    <div class="signature-line">........................................</div>
                    <p class="signature-role">Yang Membuat Pernyataan,</p>
                    <div class="signature-space"></div>
                    <p class="signature-role">(Tanda Tangan)</p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
