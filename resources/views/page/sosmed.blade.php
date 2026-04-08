<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ setting('site_name', 'Andrew.Devlog') }} - Personal Links</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS (Project Vite Assets) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .selection-bg::selection {
            background-color: #e0e7ff;
        }
        /* Responsive Banner Backgrounds */
        .banner-responsive {
            background-image: url('{{ asset('assets/image/banner1.png') }}');
        }
        @media (min-width: 768px) {
            .banner-responsive {
                background-image: url('{{ asset('assets/image/banner.png') }}');
            }
        }
    </style>
</head>
<body class="min-h-screen bg-[#F4F4F5] text-slate-800 selection-bg">

    <div class="max-w-6xl mx-auto px-4 py-8 md:py-12 flex flex-col lg:flex-row gap-8 lg:gap-12">

        <!-- SIDEBAR: Profile Info -->
        <aside class="w-full lg:w-80 shrink-0">
            <div class="sticky top-12 bg-white lg:bg-transparent rounded-3xl p-6 lg:p-0 shadow-sm lg:shadow-none border border-slate-200 lg:border-none">
                <div class="flex flex-col items-center lg:items-start text-center lg:text-left gap-4 mb-6">
                    <!-- Profile Logo -->
                    <div class="w-24 h-24 lg:w-20 lg:h-20 bg-white rounded-2xl flex items-center justify-center shadow-lg shadow-slate-200 transform transition-transform hover:scale-105 duration-300 p-2 border border-slate-100">
                        <img src="{{ asset('assets/image/Logo.png') }}" alt="{{ setting('site_name') }} Logo" class="w-full h-full object-contain">
                    </div>

                    <div>
                        <h1 class="text-2xl lg:text-xl font-extrabold text-slate-900 tracking-tight">{{ setting('site_name', 'Andrew.Devlog') }}</h1>
                        <p class="text-sm font-semibold text-indigo-600 mt-1 mb-2">{{ setting('sosmed_full_name', 'Princenton Andrew Brightly Masrikat') }}</p>
                        <div class="inline-block bg-slate-100 text-slate-600 text-xs px-3 py-1 rounded-full font-medium border border-slate-200">
                            {{ setting('sosmed_tagline', 'Tech Innovator & Developer') }}
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-center lg:justify-start gap-2 text-sm text-slate-500 bg-white lg:bg-slate-100/80 p-3 rounded-xl border border-slate-100 lg:border-none w-fit mx-auto lg:mx-0">
                    <i data-lucide="map-pin" class="w-4 h-4 text-slate-400"></i>
                    <span>{{ setting('sosmed_location', 'Surabaya, Indonesia') }}</span>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT: Links & Services -->
        <main class="flex-1 space-y-8">

            <!-- Hero Banner -->
            <div class="rounded-3xl p-6 md:p-8 relative overflow-hidden shadow-xl shadow-slate-900/10 min-h-[180px] md:min-h-[220px] flex items-center bg-slate-900 bg-cover bg-center banner-responsive">
                <div class="relative z-10 flex flex-col items-start w-full gap-6">
                    <div class="flex-1">
                        <div class="flex items-center justify-start gap-3 mb-4">
                            <div class="w-10 h-10 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center text-white border border-white/30 shadow-lg">
                                <i data-lucide="code" class="w-6 h-6"></i>
                            </div>
                            <span class="text-white font-bold text-sm tracking-widest uppercase drop-shadow-md">Tingkatkan Bisnis Anda</span>
                        </div>
                        <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-white tracking-tight mt-1 leading-tight drop-shadow-lg">
                            Jasa Pembuatan <br class="hidden lg:block"/>Website & Aplikasi
                        </h2>
                    </div>
                </div>
            </div>

            <!-- About Me -->
            <div class="bg-white rounded-3xl p-6 lg:p-8 border border-slate-200 shadow-sm relative overflow-hidden transition-all hover:shadow-md">
                <div class="absolute top-0 right-0 p-8 opacity-5">
                    <i data-lucide="user" class="w-32 h-32"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-3 flex items-center gap-2">
                    <div class="w-2 h-6 bg-indigo-500 rounded-full"></div>
                    About Me
                </h3>
                <p class="text-slate-600 leading-relaxed text-sm lg:text-base relative z-10 whitespace-pre-line">
                    {{ setting('sosmed_about', 'Halo! Saya adalah seorang Software Developer profesional yang berdedikasi dalam mengubah ide menjadi realitas digital. Dengan keahlian mendalam dalam pengembangan web dan aplikasi mobile, saya siap membantu bisnis Anda tumbuh lebih cepat melalui solusi teknologi yang modern, responsif, dan scalable.') }}
                </p>
            </div>

            <!-- Links Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @php
                    $storedLinks = setting('sosmed_links');
                    $links = [
                        ['id' => 1, 'title' => 'Konsultasi Project via WhatsApp', 'url' => 'https://wa.me/628123456789', 'icon' => 'fa-brands fa-whatsapp', 'icon_color' => 'text-emerald-500', 'type' => 'gradient-dark'],
                        ['id' => 2, 'title' => 'Lihat Daftar Harga Layanan', 'url' => route('harga'), 'icon' => 'tag', 'icon_color' => 'text-amber-500', 'type' => 'normal'],
                        ['id' => 3, 'title' => 'Lihat Portfolio Project Saya', 'url' => route('portfolio'), 'icon' => 'briefcase', 'icon_color' => 'text-indigo-500', 'type' => 'normal'],
                        ['id' => 4, 'title' => 'Kunjungi GitHub Repository', 'url' => 'https://github.com/AndrewMasrikat', 'icon' => 'fa-brands fa-github', 'icon_color' => 'text-slate-700', 'type' => 'normal'],
                        ['id' => 5, 'title' => 'Mari Terhubung di LinkedIn', 'url' => 'https://linkedin.com/in/andrewmasrikat', 'icon' => 'fa-brands fa-linkedin', 'icon_color' => 'text-blue-600', 'type' => 'normal'],
                        ['id' => 6, 'title' => 'Kirim Email Penawaran Kerja Sama', 'url' => 'mailto:contact@andrewdevlog.com', 'icon' => 'mail', 'icon_color' => 'text-rose-500', 'type' => 'normal']
                    ];

                    if ($storedLinks) {
                        $parsedLinks = json_decode($storedLinks, true);
                        $links = collect($links)->map(function($base) use ($parsedLinks) {
                            $match = collect($parsedLinks)->firstWhere('id', $base['id']);
                            if ($match) {
                                $base['title'] = $match['title'] ?? $base['title'];
                                $base['url'] = $match['url'] ?? $base['url'];
                            }
                            return $base;
                        })->toArray();
                    }
                @endphp

                @foreach($links as $link)
                    <a href="{{ $link['url'] }}" target="_blank"
                       class="group flex items-center p-4 rounded-2xl border shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 {{ $link['type'] === 'gradient-dark' ? 'bg-slate-900 border-slate-800' : 'bg-white border-slate-200 hover:border-indigo-300' }}">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 mr-4 shrink-0 {{ $link['type'] === 'gradient-dark' ? 'bg-slate-800' : 'bg-slate-50' }}">
                            @if(str_contains($link['icon'], 'fa-'))
                                <i class="{{ $link['icon'] }} {{ $link['icon_color'] }} text-lg"></i>
                            @else
                                <i data-lucide="{{ $link['icon'] }}" class="w-5 h-5 {{ $link['icon_color'] }}"></i>
                            @endif
                        </div>
                        <span class="text-sm font-semibold transition-colors flex-1 pr-2 {{ $link['type'] === 'gradient-dark' ? 'text-white' : 'text-slate-700 group-hover:text-indigo-600' }}">
                            {{ $link['title'] }}
                        </span>
                        <i data-lucide="chevron-right" class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-all -ml-4 group-hover:ml-0 {{ $link['type'] === 'gradient-dark' ? 'text-slate-400' : 'text-slate-300 group-hover:text-indigo-500' }}"></i>
                    </a>
                @endforeach
            </div>

            <!-- Services Section -->
            <div class="pt-8">
                <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center">
                    Layanan Saya
                    <div class="h-px bg-slate-300 flex-1 ml-4"></div>
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @php
                        $defaultServices = [
                            ['id' => 'web', 'name' => 'Web Development', 'desc' => 'Pembuatan website company profile, e-commerce, landing page, hingga sistem informasi custom.', 'bg' => 'bg-gradient-to-br from-slate-800 to-slate-900', 'icon' => 'globe', 'rotate' => '-rotate-12'],
                            ['id' => 'app', 'name' => 'Mobile App Development', 'desc' => 'Pengembangan aplikasi Android & iOS berkualitas tinggi yang responsif dan user-friendly.', 'bg' => 'bg-gradient-to-br from-indigo-500 to-blue-600', 'icon' => 'smartphone', 'rotate' => 'rotate-6'],
                            ['id' => 'uiux', 'name' => 'UI/UX Design', 'desc' => 'Perancangan antarmuka yang modern, estetis, dan memberikan pengalaman pengguna terbaik.', 'bg' => 'bg-gradient-to-br from-violet-500 to-purple-600', 'icon' => 'pen-tool', 'rotate' => '-rotate-6'],
                            ['id' => 'api', 'name' => 'Backend & API', 'desc' => 'Pembuatan arsitektur server, database management, dan integrasi RESTful API yang aman.', 'bg' => 'bg-gradient-to-br from-teal-500 to-emerald-600', 'icon' => 'database', 'rotate' => 'rotate-12'],
                            ['id' => 'seo', 'name' => 'SEO Optimization', 'desc' => 'Optimasi mesin pencari untuk meningkatkan visibilitas website Anda dan mendatangkan trafik organik yang tertarget.', 'bg' => 'bg-gradient-to-br from-amber-500 to-orange-600', 'icon' => 'trending-up', 'rotate' => '-rotate-12'],
                            ['id' => 'redesign', 'name' => 'Redesign Website', 'desc' => 'Pembaruan UI/UX dan struktur website lama Anda menjadi lebih modern, cepat, dan responsif di semua perangkat.', 'bg' => 'bg-gradient-to-br from-rose-500 to-pink-600', 'icon' => 'palette', 'rotate' => 'rotate-12'],
                            ['id' => 'repair', 'name' => 'Perbaikan Website', 'desc' => 'Penyelesaian bug, error, blank page, atau perbaikan masalah layout agar website Anda kembali berfungsi normal.', 'bg' => 'bg-gradient-to-br from-red-600 to-rose-700', 'icon' => 'wrench', 'rotate' => '-rotate-6'],
                            ['id' => 'maintenance', 'name' => 'Maintenance Website', 'desc' => 'Pemeliharaan server, pembaruan sistem, backup data berkala, dan monitoring keamanan untuk stabilitas jangka panjang.', 'bg' => 'bg-gradient-to-br from-cyan-500 to-blue-600', 'icon' => 'shield-check', 'rotate' => 'rotate-12']
                        ];

                        $storedServices = setting('sosmed_services');
                        if ($storedServices) {
                            $storedServices = json_decode($storedServices, true);
                            $finalServices = collect($defaultServices)->map(function($default) use ($storedServices) {
                                $match = collect($storedServices)->firstWhere('id', $default['id']);
                                if ($match) {
                                    $default['name'] = $match['name'];
                                    $default['desc'] = $match['desc'];
                                }
                                return $default;
                            });
                        } else {
                            $finalServices = $defaultServices;
                        }
                    @endphp

                    @foreach($finalServices as $item)
                        <div class="{{ $item['bg'] }} rounded-3xl p-6 lg:p-8 h-52 relative overflow-hidden group cursor-pointer shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                            <div class="relative z-10 w-4/5">
                                <h4 class="text-xl font-bold text-white mb-3 group-hover:scale-105 origin-left transition-transform duration-300 flex items-center gap-2">
                                    {{ $item['name'] }}
                                </h4>
                                <p class="text-white/80 text-sm leading-relaxed font-medium">
                                    {{ $item['desc'] }}
                                </p>
                            </div>

                            <!-- Decorative Icon Graphic -->
                            <div class="absolute -bottom-6 -right-6 text-white opacity-20 transform {{ $item['rotate'] }} group-hover:scale-110 group-hover:-translate-y-2 transition-transform duration-500 ease-out">
                                <i data-lucide="{{ $item['icon'] }}" class="w-32 h-32"></i>
                            </div>

                            <!-- Glass highlight effect -->
                            <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full blur-2xl -mt-10 -mr-10"></div>
                        </div>
                    @endforeach
                </div>
            </div>

        </main>
    </div>

    <!-- Footer -->
    <footer class="text-center py-8 text-sm text-slate-500 font-medium">
        <p>&copy; Copyright 2026 {{ setting('site_name', 'Andrew.Devlog') }} - Princenton Andrew Brightly Masrikat</p>
    </footer>

    <script>
        // Initialize Lucide Icons
        lucide.createIcons();
    </script>
</body>
</html>
