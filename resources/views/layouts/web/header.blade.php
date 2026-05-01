<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/logo_pnc_1.png') }}" alt="TOEFL PNC" height="32">
            <span>TOEFL PNC</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mx-lg-auto mb-2 mb-lg-0 text-end text-lg-start">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}" href="{{ route('tentang') }}">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('jadwal') ? 'active' : '' }}" href="{{ route('jadwal') }}">Jadwal Tes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('hasiltes') ? 'active' : '' }}" href="{{ route('hasiltes') }}">Hasil Tes</a>
                </li>
            </ul>
            <div class="d-flex align-items-center justify-content-end justify-content-lg-start">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-masuk btn-sm">Masuk</a>
                @else
                    <div class="user-avatar-container" id="userAvatarToggle">
                        <img src="{{ asset('images/profil2.jpg') }}" alt="{{ Auth::user()->name }}" class="user-avatar">
                        <div class="user-dropdown" id="userDropdown">
                            <div class="px-3 py-2">
                                <p class="mb-0 fw-bold text-dark" style="font-size: 0.9rem;">{{ Auth::user()->name }}</p>
                                <p class="mb-0 text-muted" style="font-size: 0.8rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('profil') }}" class="dropdown-item-custom">
                                <img src="{{ asset('icons/profil_saya.png') }}" alt="">
                                <span>Profil Saya</span>
                            </a>
                            <a href="{{ route('profil.edit') }}" class="dropdown-item-custom">
                                <img src="{{ asset('icons/profil_edit.png') }}" alt="">
                                <span>Edit Profil</span>
                            </a>
                            <a href="{{ route('transaksi.riwayat') }}" class="dropdown-item-custom">
                                <img src="{{ asset('icons/transaksi.png') }}" alt="">
                                <span>Riwayat Transaksi</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item-custom w-100 border-0 bg-transparent text-danger">
                                    <img src="{{ asset('icons/logout.png') }}" alt="" style="filter: invert(30%) sepia(100%) saturate(2000%) hue-rotate(340deg) brightness(90%) contrast(100%);">
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>
