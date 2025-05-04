<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <head>
        <!-- Otros enlaces y configuraciones -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- iconos bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    </head>



    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="d-flex flex-column min-vh-100"> <!-- Aquí añadimos flex para que el footer esté al final -->
        @include('layouts.navigation')

        <main class="flex-grow-1"> <!-- Esto asegura que el contenido se expanda -->
            @yield('content') 
        </main>

        @include('layouts.footer')
    </div>

    <!-- Icono emergente de WhatsApp -->
    <a href="https://wa.me/685373333" class="whatsapp-icon" target="_blank">
        <i class="bi bi-whatsapp fs-2"></i>
    </a>
</body>



</html>