<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOEFL PNC - Sistem Pendaftaran TOEFL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/web.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    {{-- favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo_pnc_2.png') }}">
    @stack('styles')
</head>

<body>
    @include('layouts.web.header')

    <main>
        @yield('content')
    </main>

    @include('layouts.web.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/web.js') }}"></script>
    @stack('scripts')
</body>

</html>
