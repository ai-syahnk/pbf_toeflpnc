<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - TOEFL PNC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/web.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-image d-none d-lg-block"></div>
        <div class="auth-form-container">
            <div class="auth-form-content">
                <h1 class="auth-title">Masuk</h1>
                <p class="auth-subtitle">Selamat datang kembali di TOEFL PNC.<br> Silakan masuk ke akun Anda untuk
                    mendaftar tes TOEFL.</p>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="#" method="POST">
                    <div class="mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control-custom"
                            placeholder="aikaeva_darlene.stu@pnc.ac.id" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password" class="form-control-custom"
                                placeholder="********" required>
                            <i class="fas fa-eye-slash password-toggle" id="togglePassword"></i>
                        </div>
                    </div>

                    <div class="text-end mb-4">
                        <a href="#" class="text-primary text-decoration-none fw-bold small">Lupa Password?</a>
                    </div>

                    <button type="submit" class="btn-auth">Masuk</button>

                    <div class="text-center mt-4">
                        <p class="small text-muted">Belum memiliki Akun? <a href="{{ route('register') }}"
                                class="text-primary text-decoration-none fw-bold">Daftar</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>
