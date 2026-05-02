@extends('layouts.web.main')

@section('content')
    <section class="pendaftaran-section py-5" style="background-color: #f8f4ff; min-height: 80vh;">
        <div class="container">
            <!-- Progress Bar -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8">
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
                            <div class="step-label">Konfirmasi Pesanan</div>
                        </div>
                        <div class="step-item">
                            <div class="reg-step-icon-wrapper">
                                <img src="{{ asset('icons/walet.png') }}" alt="Pembayaran" class="reg-step-icon">
                            </div>
                            <div class="step-label">Pembayaran</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm p-4" style="border-radius: 24px;">
                        <div class="card-body p-2">
                            <h5 class="fw-bold text-purple mb-4">Data Diri Pendaftar</h5>
                            <form action="{{ route('pendaftaran.step2') }}" method="GET">
                                @csrf
                                <!-- Nama Lengkap -->
                                <div class="mb-4">
                                    <label class="form-label fw-medium">Nama Lengkap <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-custom" name="nama" required>
                                </div>

                                <!-- Jenis Kelamin -->
                                <div class="mb-4">
                                    <label class="form-label fw-medium d-block">Jenis Kelamin <span
                                            class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline me-4">
                                        <input class="form-check-input custom-radio" type="radio" name="jenis_kelamin"
                                            id="laki" value="Laki-laki" required>
                                        <label class="form-check-label" for="laki">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input custom-radio" type="radio" name="jenis_kelamin"
                                            id="perempuan" value="Perempuan" required>
                                        <label class="form-check-label" for="perempuan">Perempuan</label>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="mb-4">
                                    <label class="form-label fw-medium">Status <span class="text-danger">*</span></label>
                                    <div class="select-wrapper position-relative">
                                        <select class="form-select form-control-custom" name="status" id="statusSelect"
                                            required>
                                            <option value="" disabled selected>Pilih Status</option>
                                            <option value="mahasiswa">Mahasiswa</option>
                                            <option value="alumni">Alumni</option>
                                            <option value="umum">Umum</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Conditional Fields: Mahasiswa -->
                                <div id="mahasiswaFields" class="status-fields" style="display: none;">
                                    <div class="mb-4">
                                        <label class="form-label fw-medium">NIM <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-custom" name="nim_mhs">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label fw-medium">Program Studi <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select form-control-custom" name="prodi_mhs">
                                            <option value="" disabled selected>Pilih Program Studi</option>
                                            <option value="D3 Teknik Mesin">D3 Teknik Mesin</option>
                                            <option value="D3 Teknik Listrik">D3 Teknik Listrik</option>
                                            <option value="D3 Teknik Elektronika">D3 Teknik Elektronika</option>
                                            <option value="D3 Teknik Informatika">D3 Teknik Informatika</option>
                                            <option value="D4 Teknik Pengendalian Pencemaran Lingkungan">D4 Teknik
                                                Pengendalian Pencemaran Lingkungan</option>
                                            <option value="D4 Akutansi Lembaga Keuangan Syariah">D4 Akutansi Lembaga
                                                Keuangan Syariah</option>
                                            <option value="D4 Rekayasa Keamanan Siber">D4 Rekayasa Keamanan Siber</option>
                                            <option value="D4 Pengembangan Produk Agroindustri">D4 Pengembangan Produk
                                                Agroindustri</option>
                                            <option value="D4 Teknologi Rekayasa Multimedia">D4 Teknologi Rekayasa
                                                Multimedia</option>
                                            <option value="D4 Teknologi Rekayasa Perangkat Lunak">D4 Teknologi Rekayasa
                                                Perangkat Lunak</option>
                                            <option value="D4 Teknologi Rekayasa Energi Terbarukan">D4 Teknologi Rekayasa
                                                Energi Terbarukan</option>
                                            <option value="D4 Teknologi Rekayasa Kimia Industri">D4 Teknologi Rekayasa Kimia
                                                Industri</option>
                                            <option value="D4 Teknologi Rekayasa Mekatronika">D4 Teknologi Rekayasa
                                                Mekatronika</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Conditional Fields: Alumni -->
                                <div id="alumniFields" class="status-fields" style="display: none;">
                                    <div class="mb-4">
                                        <label class="form-label fw-medium">NIM <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-custom" name="nim_alumni">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label fw-medium">Program Studi <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select form-control-custom" name="prodi_alumni">
                                            <option value="" disabled selected>Pilih Program Studi</option>
                                            <option value="D3 Teknik Mesin">D3 Teknik Mesin</option>
                                            <option value="D3 Teknik Listrik">D3 Teknik Listrik</option>
                                            <option value="D3 Teknik Elektronika">D3 Teknik Elektronika</option>
                                            <option value="D3 Teknik Informatika">D3 Teknik Informatika</option>
                                            <option value="D4 Teknik Pengendalian Pencemaran Lingkungan">D4 Teknik
                                                Pengendalian Pencemaran Lingkungan</option>
                                            <option value="D4 Akutansi Lembaga Keuangan Syariah">D4 Akutansi Lembaga
                                                Keuangan Syariah</option>
                                            <option value="D4 Rekayasa Keamanan Siber">D4 Rekayasa Keamanan Siber</option>
                                            <option value="D4 Pengembangan Produk Agroindustri">D4 Pengembangan Produk
                                                Agroindustri</option>
                                            <option value="D4 Teknologi Rekayasa Multimedia">D4 Teknologi Rekayasa
                                                Multimedia</option>
                                            <option value="D4 Teknologi Rekayasa Perangkat Lunak">D4 Teknologi Rekayasa
                                                Perangkat Lunak</option>
                                            <option value="D4 Teknologi Rekayasa Energi Terbarukan">D4 Teknologi Rekayasa
                                                Energi Terbarukan</option>
                                            <option value="D4 Teknologi Rekayasa Kimia Industri">D4 Teknologi Rekayasa
                                                Kimia Industri</option>
                                            <option value="D4 Teknologi Rekayasa Mekatronika">D4 Teknologi Rekayasa
                                                Mekatronika</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label fw-medium">Tahun Lulus <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select form-control-custom" name="tahun_lulus">
                                            <option value="" disabled selected>Pilih Tahun Lulus</option>
                                            @for ($i = date('Y'); $i >= 2010; $i--)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <!-- Conditional Fields: Umum -->
                                <div id="umumFields" class="status-fields" style="display: none;">
                                    <div class="mb-4">
                                        <label class="form-label fw-medium">Nomor KTP <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-custom" name="no_ktp">
                                    </div>
                                </div>

                                <!-- Common Fields -->
                                <div class="mb-4">
                                    <label class="form-label fw-medium">Nomor WhatsApp <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-custom" name="no_wa"
                                        required>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control form-control-custom" name="email"
                                        required>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-medium">Keperluan Tes <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select form-control-custom" name="keperluan" required>
                                        <option value="" disabled selected>Pilih Keperluan</option>
                                        <option value="Syarat Kelulusan">Syarat Kelulusan</option>
                                        <option value="Pendaftaran Kerja">Pendaftaran Kerja</option>
                                        <option value="Pendaftaran Studi Lanjut">Pendaftaran Studi Lanjut</option>
                                        <option value="Persyaratan Beasiswa">Persyaratan Beasiswa</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <div class="form-check custom-checkbox-wrapper">
                                        <input class="form-check-input custom-checkbox" type="checkbox" id="agree"
                                            required>
                                        <label class="form-check-label ms-2" for="agree">
                                            Saya menyetujui <a href="javascript:void(0)"
                                                class="text-purple fw-bold text-decoration-none" data-bs-toggle="modal"
                                                data-bs-target="#termsModal">Syarat & Ketentuan</a>
                                        </label>
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <button type="submit" class="btn btn-auth w-100 py-3"
                                        style="border-radius: 50px; font-size: 1.1rem;">Lanjut ke Pembayaran</button>
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
                top: 25px;
                left: 50px;
                right: 50px;
                height: 2px;
                background-color: #e0e0e0;
                z-index: -1;
            }

            .step-item {
                display: flex;
                flex-direction: column;
                align-items: center;
                background-color: #f8f4ff;
                padding: 0 10px;
            }

            .reg-step-icon-wrapper {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                background-color: #e0e0e0;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 10px;
                transition: all 0.3s ease;
            }

            .step-item.active .reg-step-icon-wrapper {
                background-color: var(--color-primary);
            }

            .reg-step-icon {
                width: 22px;
                height: 22px;
                object-fit: contain;
                filter: grayscale(100%) opacity(0.5);
            }

            .step-item.active .reg-step-icon {
                filter: brightness(0) invert(1);
            }

            .step-label {
                font-size: 0.85rem;
                font-weight: 500;
                color: #999;
            }

            .step-item.active .step-label {
                color: var(--color-primary);
                font-weight: 700;
            }

            .form-control-custom {
                background-color: #ffffff !important;
                border: 1.5px solid #d1d1d1 !important;
            }

            .form-control-custom:focus {
                border-color: var(--color-primary) !important;
                box-shadow: 0 0 0 0.25rem rgba(93, 22, 166, 0.1) !important;
            }

            .text-purple {
                color: var(--color-primary);
            }

            /* Custom Radio Styling */
            .custom-radio {
                width: 20px;
                height: 20px;
                border: 2px solid var(--color-primary) !important;
                margin-top: 0.2rem;
                cursor: pointer;
            }

            .custom-radio:checked {
                background-color: var(--color-primary) !important;
                border-color: var(--color-primary) !important;
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='2' fill='%23fff'/%3e%3c/svg%3e") !important;
            }

            /* Custom Checkbox Styling */
            .custom-checkbox {
                width: 20px;
                height: 20px;
                border: 2px solid var(--color-primary) !important;
                border-radius: 6px !important;
                cursor: pointer;
            }

            .custom-checkbox:checked {
                background-color: var(--color-primary) !important;
                border-color: var(--color-primary) !important;
            }

            /* Select Arrow Customization */
            .form-select.form-control-custom {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23370075' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
                background-size: 12px;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const statusSelect = document.getElementById('statusSelect');
                const mahasiswaFields = document.getElementById('mahasiswaFields');
                const alumniFields = document.getElementById('alumniFields');
                const umumFields = document.getElementById('umumFields');

                function toggleFields() {
                    const status = statusSelect.value;

                    // Hide all first
                    mahasiswaFields.style.display = 'none';
                    alumniFields.style.display = 'none';
                    umumFields.style.display = 'none';

                    // Reset required attributes
                    resetRequired(mahasiswaFields);
                    resetRequired(alumniFields);
                    resetRequired(umumFields);

                    if (status === 'mahasiswa') {
                        mahasiswaFields.style.display = 'block';
                        setRequired(mahasiswaFields);
                    } else if (status === 'alumni') {
                        alumniFields.style.display = 'block';
                        setRequired(alumniFields);
                    } else if (status === 'umum') {
                        umumFields.style.display = 'block';
                        setRequired(umumFields);
                    }
                }

                function setRequired(container) {
                    const inputs = container.querySelectorAll('input, select');
                    inputs.forEach(input => {
                        input.setAttribute('required', 'required');
                    });
                }

                function resetRequired(container) {
                    const inputs = container.querySelectorAll('input, select');
                    inputs.forEach(input => {
                        input.removeAttribute('required');
                    });
                }

                statusSelect.addEventListener('change', toggleFields);

                // Trigger once on load if there's a value (e.g. old input)
                if (statusSelect.value) {
                    toggleFields();
                }
            });
        </script>
    @endpush
@endsection
