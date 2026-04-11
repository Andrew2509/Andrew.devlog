<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', setting('site_name', 'Andrew.Devlog') . ' - ' . setting('site_tagline', 'Website Development & Digital Agency'))</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('meta_description', setting('meta_description', 'Andrew.DevLog melayani jasa pembuatan website profesional, aplikasi web, dan optimasi SEO untuk meningkatkan visibilitas bisnis Anda di Google. Cepat, responsif, dan terpercaya.'))">
    <meta name="keywords" content="@yield('meta_keywords', setting('meta_keywords', 'jasa pembuatan website, jasa seo, jasa web surabaya, andrew devlog, pembuatan website profesional, digital agency indonesia'))">
    <meta name="author" content="Andrew.DevLog">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', setting('site_name', 'Andrew.Devlog'))">
    <meta property="og:description" content="@yield('meta_description', setting('meta_description', 'Andrew.DevLog melayani jasa pembuatan website profesional, aplikasi web, dan optimasi SEO.'))">
    <meta property="og:image" content="@yield('meta_image', asset('assets/image/Logo.png'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', setting('site_name', 'Andrew.Devlog'))">
    <meta property="twitter:description" content="@yield('meta_description', setting('meta_description', 'Andrew.DevLog melayani jasa pembuatan website profesional, aplikasi web, dan optimasi SEO.'))">
    <meta property="twitter:image" content="@yield('meta_image', asset('assets/image/Logo.png'))">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            DEFAULT: '#0ea5e9',
                            light: '#38bdf8',
                            dark: '#0369a1',
                            50: '#f0f9ff',
                            100: '#e0effe',
                        }
                    }
                }
            }
        }
    </script>

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
