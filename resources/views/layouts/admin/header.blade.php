<nav class="navbar navbar-expand-lg navbar-admin fixed-top">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <button type="button" id="sidebarCollapse" class="btn btn-link text-dark me-3 p-0 d-lg-none">
                <i class="fas fa-bars fa-lg"></i>
            </button>
            <div class="d-flex align-items-center me-4">
                <img src="{{ asset('images/logo_pnc_1.png') }}" alt="Logo" height="35" class="me-2">
                <h5 class="mb-0 fw-bold d-none d-sm-block">TOEFL PNC</h5>
            </div>
            <div class="border-start ps-3 d-none d-md-block">
                <span class="navbar-text text-muted" style="font-size: 14px;">Admin Panel</span>
            </div>
        </div>
        <div class="ms-auto d-flex align-items-center">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="bg-light rounded-circle p-2 border me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-user text-muted"></i>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="dropdownUser">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="#">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
