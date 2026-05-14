<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Kuasa Pengambilan Sertifikat</title>
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
            margin-bottom: 22px;
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
            margin: 0 0 8px;
            text-align: justify;
        }

        .form-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
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
            margin: 6px 0 0;
        }

        .signature {
            width: 100%;
            border-collapse: collapse;
            margin-top: 44px;
        }

        .signature td {
            width: 55%;
        }

        .signature-right {
            width: 45%;
            text-align: center;
            vertical-align: top;
        }

        .signature-line {
            margin: 0 0 14px;
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
            <h3>SURAT KUASA PENGAMBILAN SERTIFIKAT</h3>
            <h4>NOMOR: {{ $nomorSurat }}</h4>
        </div>

        <p class="paragraph">Saya yang bertanda tangan di bawah ini:</p>

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

        <p class="paragraph">Dengan ini memberikan kuasa kepada:</p>

        <table class="form-table">
            <tr>
                <td class="field-label">Nama Lengkap</td>
                <td class="field-colon">:</td>
                <td>{{ $namaPenerimaKuasa ?: '........................................' }}</td>
            </tr>
            <tr>
                <td class="field-label">Nomor Identitas (NIM/KTP)</td>
                <td class="field-colon">:</td>
                <td>{{ $identitasPenerimaKuasa ?: '........................................' }}</td>
            </tr>
        </table>

        <p class="statement">
            Untuk mengambil sertifikat TOEFL saya di Unit Penunjang Akademik (UPA) Bahasa Politeknik Negeri Cilacap.
        </p>
        <p class="statement">Adapun data tes saya sebagai berikut:</p>

        <table class="form-table">
            <tr>
                <td class="field-label">Nama Tes</td>
                <td class="field-colon">:</td>
                <td>{{ $namaTes ?: '........................................' }}</td>
            </tr>
            <tr>
                <td class="field-label">Tanggal Tes</td>
                <td class="field-colon">:</td>
                <td>{{ $tanggalTes ?: '........................................' }}</td>
            </tr>
        </table>

        <p class="statement">
            Demikian surat kuasa ini saya buat dengan sebenar-benarnya untuk dipergunakan sebagaimana mestinya.
        </p>

        <table class="signature">
            <tr>
                <td></td>
                <td class="signature-right">
                    <div class="signature-line">........................................</div>
                    <p class="signature-role">Pemberi Kuasa,</p>
                    <div class="signature-space"></div>
                    <p class="signature-role">(Tanda Tangan)</p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
