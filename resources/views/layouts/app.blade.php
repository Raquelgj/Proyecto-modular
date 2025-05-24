<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- CONTENIDO PRINCIPAL QUE SE EXTIENDE -->
    <div class="flex-grow-1 bg-white dark:bg-gray-900">
        @include('layouts.navigation')

        @isset($header)
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <main>
            @yield('content')
        </main>
    </div>

    <!-- FOOTER SIEMPRE ABAJO -->
    <footer class="footer-custom">
        @include('layouts.footer')
    </footer>

    <!-- Aviso de cookies -->
    <div id="cookie-banner" class="cookie-banner">
        <div class="cookie-content">
            <p>Usamos cookies para mejorar tu experiencia. Al continuar navegando, aceptas nuestra <a href="/politica-cookies" target="_blank">Política de Cookies</a>.</p>
            <button id="accept-cookies" class="btn btn-success">Aceptar</button>
            <button id="decline-cookies" class="btn btn-danger">Denegar</button>
        </div>
    </div>

    <!-- WhatsApp -->
    <a href="https://wa.me/661312784" class="whatsapp-icon" target="_blank">
        <i class="bi bi-whatsapp fs-2"></i>
    </a>

    <script>
        window.onload = function () {
            if (!localStorage.getItem('cookiesAccepted')) {
                document.getElementById('cookie-banner').style.display = 'block';
            }

            document.getElementById('accept-cookies').addEventListener('click', function () {
                localStorage.setItem('cookiesAccepted', 'true');
                document.getElementById('cookie-banner').style.display = 'none';
            });

            document.getElementById('decline-cookies').addEventListener('click', function () {
                document.getElementById('cookie-banner').style.display = 'none';
            });
        };
    </script>
</body>

</html>
