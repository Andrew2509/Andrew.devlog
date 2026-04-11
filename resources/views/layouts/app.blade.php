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
    <meta property="og:image" content="@yield('meta_image', setting('site_logo') ?: asset('assets/image/logo.png'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', setting('site_name', 'Andrew.Devlog'))">
    <meta property="twitter:description" content="@yield('meta_description', setting('meta_description', 'Andrew.DevLog melayani jasa pembuatan website profesional, aplikasi web, dan optimasi SEO.'))">
    <meta property="twitter:image" content="@yield('meta_image', setting('site_logo') ?: asset('assets/image/logo.png'))">

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="{{ setting('site_favicon') ?: asset('assets/image/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ setting('site_favicon') ?: asset('assets/image/logo.png') }}">

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
    <style>
        /* Reduced Motion Support */
        @media (prefers-reduced-motion: reduce) {
            *, ::before, ::after {
                animation-delay: -1ms !important;
                animation-duration: 1ms !important;
                animation-iteration-count: 1 !important;
                background-attachment: initial !important;
                scroll-behavior: auto !important;
                transition-duration: 0s !important;
                transition-delay: 0s !important;
            }
        }
        
        /* Skip link for accessibility */
        .skip-link {
            position: fixed;
            top: -60px;
            left: 50%;
            transform: translateX(-50%);
            background: #0ea5e9;
            color: white;
            padding: 10px 20px;
            z-index: 9999;
            transition: top 0.3s;
            border-radius: 0 0 15px 15px;
            box-shadow: 0 4px 15px rgba(14, 165, 233, 0.3);
        }
        .skip-link:focus {
            top: 0;
            outline: none;
        }
    </style>
</head>
<body class="font-sans text-gray-800 antialiased bg-white selection:bg-primary selection:text-white">
    <a href="#main-content" class="skip-link font-bold text-xs">Skip to content</a>

    @include('component.navbar')

    <main id="main-content">
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
