<nav id="sidebar" class="d-flex flex-column">
    {{-- <div class="sidebar-header border-bottom d-none d-lg-block">
        <div class="py-2"></div>
    </div> --}}

    <ul class="list-unstyled components flex-grow-1">
        <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}"><i class="fas fa-list"></i> Dashboard</a>
        </li>
        <li class="{{ request()->is('admin/jadwal*') ? 'active' : '' }}">
            <a href="#"><i class="fas fa-calendar-alt"></i> Jadwal Tes</a>
        </li>
        <li class="{{ request()->is('admin/peserta*') ? 'active' : '' }}">
            <a href="#"><i class="fas fa-user"></i> Peserta Tes</a>
        </li>
    </ul>

    <div class="logout-container border-top">
        <a href="#" class="logout-btn"><i class="fas fa-sign-out-alt me-2"></i> Log out</a>
    </div>
</nav>
