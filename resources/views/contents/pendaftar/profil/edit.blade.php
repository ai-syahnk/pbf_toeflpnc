@extends('layouts.web.main')

@section('content')
    <!-- Profile Header Background -->
    <div class="profile-header-bg"></div>

    <!-- Edit Profile Card Section -->
    <section class="profile-card-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="edit-profile-card">
                        <div class="text-center mb-5">
                            <h2 class="edit-profile-title">Edit Profil</h2>
                            <div class="title-underline"></div>
                        </div>

                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Ganti Foto Section -->
                            <div class="photo-upload-section mb-4">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="profile-img-wrapper">
                                            <img src="{{ asset('images/profil2.jpg') }}" alt="{{ Auth::user()->name }}" class="profile-img-preview">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h5 class="upload-label mb-3">Ganti Foto</h5>
                                        <div class="d-flex align-items-center">
                                            <input type="file" id="foto" name="foto" class="d-none" onchange="updateFileName(this)">
                                            <label for="foto" class="btn-choose-file">Choose File</label>
                                            <span id="file-name-display" class="ms-3 text-muted" style="font-size: 14px;">No file chosen</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Fields -->
                            <div class="mb-4">
                                <label for="name" class="form-label-custom">Nama Lengkap</label>
                                <input type="text" class="form-control-custom" id="name" name="name" value="{{ Auth::user()->name }}" placeholder="Masukkan nama lengkap">
                            </div>

                            <div class="mb-5">
                                <label for="email" class="form-label-custom">Email</label>
                                <input type="email" class="form-control-custom" id="email" name="email" value="{{ Auth::user()->email }}" placeholder="Masukkan alamat email">
                            </div>

                            <div class="d-flex justify-content-end gap-3">
                                <a href="{{ route('profil') }}" class="btn-batal">Batal</a>
                                <button type="submit" class="btn-simpan">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .profile-header-bg {
            background: linear-gradient(90deg, #5D16A6 0%, #CCA7F2 100%);
            height: 250px;
            width: 100%;
        }

        .profile-card-container {
            margin-top: -180px;
            padding-bottom: 80px;
        }

        .edit-profile-card {
            background: white;
            border-radius: 24px;
            padding: 60px 80px;
            box-shadow: 0 3px 3px 3px #5D16A629;
            border: 1px solid #5D16A629;
        }

        .edit-profile-title {
            color: var(--color-primary, #5D16A6);
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .title-underline {
            width: 180px;
            height: 4px;
            background-color: #F8B12C;
            margin: 0 auto;
            border-radius: 2px;
        }

        .photo-upload-section {
            background-color: #F8F6F9;
            border-radius: 20px;
            padding: 16px;
        }

        .profile-img-preview {
            width: 124px;
            height: 124px;
            border-radius: 50%;
            border: 3px solid var(--color-primary, #5D16A6);
            padding: 2px;
            object-fit: cover;
            background: white;
        }

        .upload-label {
            font-weight: 600;
            color: var(--color-black, #000);
            font-size: 1.25rem;
        }

        .btn-choose-file {
            background-color: #E7EDFF;
            color: #4A89FF;
            padding: 8px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.75rem;
            transition: all 0.2s ease;
        }

        .btn-choose-file:hover {
            background-color: #D6E0FF;
        }

        .form-label-custom {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 12px;
            display: block;
            color: var(--color-black, #000);
        }

        .form-control-custom {
            border: 2px solid var(--color-primary, #5D16A6);
            border-radius: 12px;
            padding: 14px 20px;
            width: 100%;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control-custom:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(93, 22, 166, 0.1);
        }

        .btn-batal {
            border: 2px solid var(--color-primary, #5D16A6);
            color: var(--color-primary, #5D16A6);
            background: transparent;
            border-radius: 50px;
            padding: 10px 40px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-batal:hover {
            background-color: #F3E8FF;
            color: var(--color-primary, #5D16A6);
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
        }

        @media (max-width: 991.98px) {
            .edit-profile-card {
                padding: 40px;
            }
        }

        @media (max-width: 767.98px) {
            .edit-profile-card {
                padding: 30px 20px;
            }
            .photo-upload-section {
                padding: 20px;
            }
            .profile-img-preview {
                width: 90px;
                height: 90px;
            }
            .btn-batal, .btn-simpan {
                padding: 10px 30px;
                width: 100%;
                text-align: center;
            }
            .d-flex.justify-content-end {
                flex-direction: column;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        function updateFileName(input) {
            const fileName = input.files[0] ? input.files[0].name : 'No file chosen';
            document.getElementById('file-name-display').textContent = fileName;
        }
    </script>
@endpush
