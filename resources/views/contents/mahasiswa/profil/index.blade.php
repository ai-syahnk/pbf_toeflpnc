@extends('layouts.web.main')

@section('content')
    <!-- Profile Header Background -->
    <div class="profile-header-bg"></div>

    <!-- Profile Card Section -->
    <section class="profile-card-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="profile-card">
                        <div class="profile-img-wrapper">
                            <img src="{{ asset('images/profil2.jpg') }}" alt="{{ Auth::user()->name }}" class="profile-img">
                        </div>
                        <h2 class="profile-name">{{ Auth::user()->name }}</h2>
                        <p class="profile-email">{{ Auth::user()->email }}</p>
                        <a href="{{ route('profil.edit') }}" class="btn-edit-profil">
                            <img src="{{ asset('icons/edit.png') }}" alt="" width="16"> Edit Profil
                        </a>
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

        .profile-card {
            background: white;
            border-radius: 24px;
            padding: 60px 40px;
            box-shadow: 0 3px 3px 3px #5D16A629;
            text-align: center;
            border: 1px solid #5D16A629;
        }

        .profile-img-wrapper {
            position: relative;
            display: inline-block;
            margin-bottom: 30px;
        }

        .profile-img {
            width: 132px;
            height: 132px;
            border-radius: 50%;
            border: 4px solid var(--color-primary);
            padding: 2px;
            object-fit: cover;
            background: white;
        }

        .profile-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-black);
            margin-bottom: 0.5rem;
        }

        .profile-email {
            font-size: 1rem;
            color: var(--color-text);
            margin-bottom: 40px;
        }

        .btn-edit-profil {
            background-color: var(--color-primary);
            color: white !important;
            border-radius: 50px;
            padding: 12px 35px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .btn-edit-profil:hover {
            background-color: var(--color-dark-purple);
            transform: translateY(-2px);
        }

        @media (max-width: 767.98px) {
            .profile-name {
                font-size: 1.2rem;
            }
            .profile-card {
                padding: 40px 20px;
            }
            .profile-img {
                width: 150px;
                height: 150px;
            }
        }
    </style>
@endpush
