<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', setting('site_name', 'Andrew.Devlog') . ' - ' . setting('site_tagline', 'Website Development & Digital Agency'))</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">

    @yield('head')
</head>
<body class="font-sans text-gray-800 antialiased bg-white selection:bg-primary selection:text-white">

    @include('component.navbar')

    <main>
        @yield('content')
    </main>

    @include('component.footer')
    @include('component.search-modal')
    @include('component.whatsapp_button')


    <!-- Scripts -->
    <script src="{{ asset('assets/script.js') }}"></script>
    @yield('scripts')
</body>
</html>
