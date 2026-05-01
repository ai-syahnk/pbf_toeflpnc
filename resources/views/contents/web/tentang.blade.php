@extends('layouts.web.main')

@section('content')
    <!-- Tentang TOEFL PNC Section -->
    <section class="tentang-header-section">
        <div class="container">
            <div class="section-title">
                <h2>Tentang TOEFL PNC</h2>
            </div>
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="tentang-content-text">
                        <p>Sistem pendaftaran TOEFL Politeknik Negeri Cilacap merupakan layanan resmi yang diselenggarakan oleh Unit Penunjang Akademik (UPA) Bahasa. Tes ini bertujuan untuk mengukur kemampuan bahasa Inggris mahasiswa sebagai salah satu persyaratan kelulusan serta untuk memenuhi kebutuhan akademik lainnya.</p>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('images/hero_2.jpeg') }}" alt="Tentang TOEFL PNC" class="img-tentang-header">
                </div>
            </div>
        </div>
    </section>

    <!-- Program Tes Section -->
    <section class="programtes-section">
        <div class="container">
            <div class="section-title">
                <h2>Program Tes</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="program-card-custom">
                        <h3>TOEFL ITP</h3>
                        <p>Test of English as a Foreign Language – Institutional Testing Program</p>
                        <p>TOEFL ITP merupakan tes kemampuan bahasa Inggris yang diselenggarakan secara institusional untuk memenuhi persyaratan kelulusan di Politeknik Negeri Cilacap.</p>
                        <div class="badge-container">
                            <div class="badge-info">
                                <img src="{{ asset('icons/time.png') }}" alt="Durasi">
                                Durasi 115 menit
                            </div>
                            <div class="badge-info">
                                <img src="{{ asset('icons/paper.png') }}" alt="Paper Based">
                                Paper Based Test
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="program-card-custom">
                        <h3>TOEFL PREDICTION</h3>
                        <p>English Proficiency Test – Prediction</p>
                        <p>TOEFL EPT-P merupakan tes prediksi yang dirancang untuk mengukur kemampuan bahasa Inggris mahasiswa sebagai persiapan menghadapi tes TOEFL resmi.</p>
                        <div class="badge-container">
                            <div class="badge-info">
                                <img src="{{ asset('icons/time.png') }}" alt="Durasi">
                                Durasi 115 menit
                            </div>
                            <div class="badge-info">
                                <img src="{{ asset('icons/paper.png') }}" alt="Paper Based">
                                Paper Based Test
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Struktur Tes Section -->
    <section class="caradaftar-section">
        <div class="container">
            <div class="section-title">
                <h2>Struktur Tes</h2>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="struktur-card">
                        <div class="struktur-icon">
                            <img src="{{ asset('icons/listening.png') }}" alt="Listening">
                        </div>
                        <h4>Listening Comprehension</h4>
                        <p>Mengukur kemampuan memahami percakapan dalam bahasa Inggris.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="struktur-card">
                        <div class="struktur-icon">
                            <img src="{{ asset('icons/written.png') }}" alt="Structure">
                        </div>
                        <h4>Structure and Written Expression</h4>
                        <p>Mengukur pemahaman tata bahasa dan struktur kalimat.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mx-auto">
                    <div class="struktur-card">
                        <div class="struktur-icon">
                            <img src="{{ asset('icons/reading.png') }}" alt="Reading">
                        </div>
                        <h4>Reading Comprehension</h4>
                        <p>Mengukur kemampuan memahami teks bacaan berbahasa Inggris.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Dokumentasi Tes Section -->
    <section class="programtes-section">
        <div class="container">
            <div class="section-title">
                <h2>Dokumentasi Tes</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <img src="{{ asset('images/hero_1.jpeg') }}" alt="Dokumentasi 1" class="img-dokumentasi">
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('images/hero_3.jpeg') }}" alt="Dokumentasi 2" class="img-dokumentasi">
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('images/hero.jpeg') }}" alt="Dokumentasi 3" class="img-dokumentasi">
                </div>
            </div>
        </div>
    </section>
@endsection
