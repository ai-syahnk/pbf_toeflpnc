@extends('layouts.web.main')

@section('content')
    <section class="pendaftaran-section py-5" style="background-color: #f8f4ff; min-height: 80vh;">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-10">
                    <div class="d-flex justify-content-between position-relative registration-steps">
                        <div class="step-line"></div>
                        <div class="step-item active">
                            <div class="reg-step-icon-wrapper">
                                <img src="{{ asset('icons/datadiri.png') }}" alt="Isi Data Diri"
                                    class="reg-step-icon active-icon">
                            </div>
                            <div class="step-label">Isi Data Diri</div>
                        </div>
                        <div class="step-item">
                            <div class="reg-step-icon-wrapper">
                                <img src="{{ asset('icons/pesanan.png') }}" alt="Konfirmasi Pesanan" class="reg-step-icon">
                            </div>
                            <div style="color: #999999;">Konfirmasi Pesanan</div>
                        </div>
                        <div class="step-item">
                            <div class="reg-step-icon-wrapper">
                                <img src="{{ asset('icons/walet.png') }}" alt="Pembayaran" class="reg-step-icon">
                            </div>
                            <div style="color: #999999;">Pembayaran</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mb-4">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                        <div class="card-body p-4">
                            <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 align-items-lg-center">
                                <div>
                                    <div class="text-muted small text-uppercase">Jadwal Dipilih</div>
                                    <h4 class="mb-2 text-purple fw-bold">
                                        {{ $pendaftaranTes->jadwalTes->judul_tes }} -
                                        {{ $pendaftaranTes->jadwalTes->jenis_tes }}
                                    </h4>
                                    <div class="text-muted small">
                                        {{ tanggal_panjang($pendaftaranTes->jadwalTes->tanggal_tes) }}
                                        | {{ $pendaftaranTes->jadwalTes->waktu }}
                                        | {{ $pendaftaranTes->jadwalTes->lokasi }}
                                    </div>
                                </div>
                                <div class="text-lg-end">
                                    <div class="text-muted small text-uppercase">Biaya Tes</div>
                                    <div class="fw-bold text-purple fs-4">
                                        @if ((float) $pendaftaranTes->jadwalTes->harga <= 0)
                                            GRATIS
                                        @else
                                            Rp {{ number_format((float) $pendaftaranTes->jadwalTes->harga, 0, ',', '.') }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                        <div class="card-body p-4 p-lg-5">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="fw-bold text-purple mb-0">Data Diri Pendaftar</h5>
                                @if ($pendaftaranTes->nomor_pendaftaran)
                                    <span
                                        class="badge bg-light text-dark border">{{ $pendaftaranTes->nomor_pendaftaran }}</span>
                                @endif
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('pendaftaran.step1.store', $pendaftaranTes) }}" method="POST">
                                @csrf

                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-medium">Nama Lengkap</label>
                                        <input type="text" class="form-control form-control-custom" name="nama_peserta"
                                            value="{{ old('nama_peserta', $pendaftaranTes->nama_peserta) }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-medium">Email</label>
                                        <input type="email" class="form-control form-control-custom" name="email_peserta"
                                            value="{{ old('email_peserta', $pendaftaranTes->email_peserta) }}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium d-block">Jenis Kelamin</label>
                                        @php($jenisKelamin = old('jenis_kelamin', $pendaftaranTes->jenis_kelamin))
                                        <div class="form-check form-check-inline me-4">
                                            <input class="form-check-input custom-radio" type="radio" name="jenis_kelamin"
                                                id="laki" value="Laki-laki" @checked($jenisKelamin === 'Laki-laki') required>
                                            <label class="form-check-label" for="laki">Laki-laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input custom-radio" type="radio" name="jenis_kelamin"
                                                id="perempuan" value="Perempuan" @checked($jenisKelamin === 'Perempuan') required>
                                            <label class="form-check-label" for="perempuan">Perempuan</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium">Status</label>
                                        @php($statusPendaftar = old('status_pendaftar', $pendaftaranTes->status_pendaftar))
                                        <select class="form-select form-control-custom" name="status_pendaftar"
                                            id="statusSelect" required>
                                            <option value="" disabled @selected($statusPendaftar === null)>Pilih Status
                                            </option>
                                            <option value="mahasiswa" @selected($statusPendaftar === 'mahasiswa')>Mahasiswa</option>
                                            <option value="alumni" @selected($statusPendaftar === 'alumni')>Alumni</option>
                                            <option value="umum" @selected($statusPendaftar === 'umum')>Umum</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 status-fields" id="nimFields" style="display: none;">
                                        <label class="form-label fw-medium">NIM</label>
                                        <input type="number" class="form-control form-control-custom" name="nim"
                                            value="{{ old('nim', $pendaftaranTes->nim) }}">
                                    </div>

                                    <div class="col-md-6 status-fields" id="prodiFields" style="display: none;">
                                        <label class="form-label fw-medium">Program Studi</label>
                                        @php($programStudi = old('program_studi', $pendaftaranTes->program_studi))
                                        <select class="form-select form-control-custom" name="program_studi">
                                            <option value="" disabled @selected($programStudi === null)>Pilih Program Studi</option>
                                            <option value="D3 Teknik Mesin" @selected($programStudi === 'D3 Teknik Mesin')>D3 Teknik Mesin</option>
                                            <option value="D3 Teknik Listrik" @selected($programStudi === 'D3 Teknik Listrik')>D3 Teknik Listrik</option>
                                            <option value="D3 Teknik Elektronika" @selected($programStudi === 'D3 Teknik Elektronika')>D3 Teknik Elektronika</option>
                                            <option value="D3 Teknik Informatika" @selected($programStudi === 'D3 Teknik Informatika')>D3 Teknik Informatika</option>
                                            <option value="D4 Teknik Pengendalian Pencemaran Lingkungan" @selected($programStudi === 'D4 Teknik Pengendalian Pencemaran Lingkungan')>D4 Teknik
                                                Pengendalian Pencemaran Lingkungan</option>
                                            <option value="D4 Akutansi Lembaga Keuangan Syariah" @selected($programStudi === 'D4 Akutansi Lembaga Keuangan Syariah')>D4 Akutansi Lembaga
                                                Keuangan Syariah</option>
                                            <option value="D4 Rekayasa Keamanan Siber" @selected($programStudi === 'D4 Rekayasa Keamanan Siber')>D4 Rekayasa Keamanan Siber</option>
                                            <option value="D4 Pengembangan Produk Agroindustri" @selected($programStudi === 'D4 Pengembangan Produk Agroindustri')>D4 Pengembangan Produk
                                                Agroindustri</option>
                                            <option value="D4 Teknologi Rekayasa Multimedia" @selected($programStudi === 'D4 Teknologi Rekayasa Multimedia')>D4 Teknologi Rekayasa
                                                Multimedia</option>
                                            <option value="D4 Teknologi Rekayasa Perangkat Lunak" @selected($programStudi === 'D4 Teknologi Rekayasa Perangkat Lunak')>D4 Teknologi Rekayasa
                                                Perangkat Lunak</option>
                                            <option value="D4 Teknologi Rekayasa Energi Terbarukan" @selected($programStudi === 'D4 Teknologi Rekayasa Energi Terbarukan')>D4 Teknologi Rekayasa
                                                Energi Terbarukan</option>
                                            <option value="D4 Teknologi Rekayasa Kimia Industri" @selected($programStudi === 'D4 Teknologi Rekayasa Kimia Industri')>D4 Teknologi Rekayasa Kimia
                                                Industri</option>
                                            <option value="D4 Teknologi Rekayasa Mekatronika" @selected($programStudi === 'D4 Teknologi Rekayasa Mekatronika')>D4 Teknologi Rekayasa
                                                Mekatronika</option>
                                        </select>
                                        {{-- <input type="text" class="form-control form-control-custom"
                                            name="program_studi"
                                            value="{{ old('program_studi', $pendaftaranTes->program_studi) }}"> --}}
                                    </div>

                                    <div class="col-md-6 status-fields" id="tahunLulusFields" style="display: none;">
                                        <label class="form-label fw-medium">Tahun Lulus</label>
                                        <input type="number" class="form-control form-control-custom" name="tahun_lulus"
                                            value="{{ old('tahun_lulus', $pendaftaranTes->tahun_lulus) }}"
                                            maxlength="4">
                                    </div>

                                    <div class="col-md-6 status-fields" id="ktpFields" style="display: none;">
                                        <label class="form-label fw-medium">Nomor KTP</label>
                                        <input type="number" class="form-control form-control-custom" name="no_ktp"
                                            value="{{ old('no_ktp', $pendaftaranTes->no_ktp) }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium">Nomor WhatsApp</label>
                                        <input type="number" class="form-control form-control-custom" name="no_wa"
                                            value="{{ old('no_wa', $pendaftaranTes->no_wa) }}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium">Keperluan Tes</label>
                                        @php($keperluanTes = old('keperluan_tes', $pendaftaranTes->keperluan_tes))
                                        <select class="form-select form-control-custom" name="keperluan_tes" required>
                                            <option value="" disabled @selected($keperluanTes === null)>Pilih Keperluan
                                            </option>
                                            <option value="Syarat Kelulusan" @selected($keperluanTes === 'Syarat Kelulusan')>Syarat Kelulusan
                                            </option>
                                            <option value="Pendaftaran Kerja" @selected($keperluanTes === 'Pendaftaran Kerja')>Pendaftaran
                                                Kerja</option>
                                            <option value="Pendaftaran Studi Lanjut" @selected($keperluanTes === 'Pendaftaran Studi Lanjut')>
                                                Pendaftaran Studi Lanjut</option>
                                            <option value="Persyaratan Beasiswa" @selected($keperluanTes === 'Persyaratan Beasiswa')>Persyaratan
                                                Beasiswa</option>
                                            <option value="Lainnya" @selected($keperluanTes === 'Lainnya')>Lainnya</option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check custom-checkbox-wrapper">
                                            <input class="form-check-input custom-checkbox" type="checkbox"
                                                id="agree" name="agree" value="1"
                                                @checked(old('agree')) required>
                                            <label class="form-check-label ms-2" for="agree">
                                                Saya menyetujui <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#termsModal" class="text-decoration-none fw-bold"
                                                    style="color: #5D16A6;">Syarat & Ketentuan</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end gap-3 mt-5">
                                    <a href="{{ route('jadwal') }}" class="btn btn-outline-custom py-3">Kembali ke
                                        Jadwal</a>
                                    <button type="submit" class="btn btn-simpan py-3">Simpan dan
                                        Lanjutkan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Syarat & Ketentuan -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 p-3" style="border-radius: 24px;">
                <div class="modal-body p-4">
                    <h5 class="fw-bold text-purple mb-4" id="termsModalLabel">Syarat & Ketentuan</h5>
                    <div class="terms-content mb-4" style="font-size: 0.85rem; color: #333; line-height: 1.6;">
                        <ol class="ps-3">
                            <li class="mb-2">Peserta wajib membawa kartu tes yang telah dicetak saat pelaksanaan ujian.
                            </li>
                            <li class="mb-2">Peserta wajib hadir 30 menit sebelum tes dimulai. Keterlambatan dapat
                                menyebabkan peserta tidak diperbolehkan mengikuti tes.</li>
                            <li class="mb-2">Peserta wajib membawa identitas diri yang berlaku (KTP/KTM).</li>
                            <li class="mb-2">Pembayaran tidak dapat dilakukan setelah tanggal 25 setiap bulan.</li>
                            <li class="mb-2">Biaya pendaftaran yang telah dibayarkan tidak dapat dikembalikan.</li>
                            <li class="mb-2">Peserta yang berhalangan hadir tidak dapat memindahkan jadwal tes tanpa
                                konfirmasi kepada admin TOEFL sebelum hari H.</li>
                        </ol>
                    </div>
                    <button type="button" class="btn btn-auth w-100 py-2" data-bs-dismiss="modal"
                        style="border-radius: 50px; font-weight: 600;">Saya Mengerti</button>
                </div>
            </div>
        </div>
    </div>

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
                background-color: #d6c8ef;
                color: #5d16a6;
                font-weight: 700;
            }

            .step-item.active .reg-step-icon-wrapper {
                background-color: var(--color-primary);
                color: #fff;
            }

            .step-label {
                color: #7f6a9b;
                font-size: 0.9rem;
                font-weight: 600;
            }

            .step-item.active .step-label,
            .text-purple {
                color: var(--color-primary);
            }

            .form-control-custom {
                background-color: #ffffff !important;
                border: 1.5px solid #d1d1d1 !important;
                min-height: 48px;
            }

            .form-control-custom:focus {
                border-color: var(--color-primary) !important;
                box-shadow: 0 0 0 0.25rem rgba(93, 22, 166, 0.1) !important;
            }

            .custom-radio,
            .custom-checkbox {
                border-color: var(--color-primary) !important;
            }

            .custom-radio:checked,
            .custom-checkbox:checked {
                background-color: var(--color-primary) !important;
                border-color: var(--color-primary) !important;
                color: #fff !important;
            }

            .btn-simpan {
                background-color: var(--color-primary, #5D16A6);
                color: white;
                border: none;
                border-radius: 50px;
                padding: 10px 40px;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .btn-simpan:hover {
                background-color: var(--color-dark-purple, #4A1185);
                transform: translateY(-2px);
                color: white;
            }

            .btn-outline-purple {
                border: 1.5px solid var(--color-primary);
                color: var(--color-primary);
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const statusSelect = document.getElementById('statusSelect');
                const nimFields = document.getElementById('nimFields');
                const prodiFields = document.getElementById('prodiFields');
                const tahunLulusFields = document.getElementById('tahunLulusFields');
                const ktpFields = document.getElementById('ktpFields');

                function toggleFields() {
                    const status = statusSelect.value;

                    [nimFields, prodiFields, tahunLulusFields, ktpFields].forEach(field => {
                        field.style.display = 'none';
                        field.querySelector('input')?.removeAttribute('required');
                    });

                    if (status === 'mahasiswa' || status === 'alumni') {
                        nimFields.style.display = 'block';
                        prodiFields.style.display = 'block';
                        nimFields.querySelector('input')?.setAttribute('required', 'required');
                        prodiFields.querySelector('input')?.setAttribute('required', 'required');
                    }

                    if (status === 'alumni') {
                        tahunLulusFields.style.display = 'block';
                        tahunLulusFields.querySelector('input')?.setAttribute('required', 'required');
                    }

                    if (status === 'umum') {
                        ktpFields.style.display = 'block';
                        ktpFields.querySelector('input')?.setAttribute('required', 'required');
                    }
                }

                statusSelect.addEventListener('change', toggleFields);
                toggleFields();
            });
        </script>
    @endpush
@endsection
