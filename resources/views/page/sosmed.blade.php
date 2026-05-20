<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ setting('site_name', 'Andrew.Devlog') }} - Tautan Pribadi</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="Hubungi Andrew.Devlog. Temukan tautan sosial media resmi, portofolio, dan layanan pembuatan website & aplikasi profesional kami.">
    <meta name="author" content="Andrew.Devlog">
    <meta name="robots" content="index, follow">
    <link rel="icon" type="image/png" href="{{ setting('site_favicon') ?: asset('assets/image/logo.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Vite Assets (Tailwind CSS & JS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #090D16;
            color: #E2E8F0;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, .font-heading {
            font-family: 'Outfit', sans-serif;
        }

        /* Glassmorphic Panel Design System */
        .glass-panel {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.06);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.4);
        }

        /* Dynamic Glass Cards Hover Effect */
        .glass-card-hover {
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .glass-card-hover:hover {
            background: rgba(255, 255, 255, 0.04);
            border-color: rgba(255, 255, 255, 0.12);
            box-shadow: 0 12px 40px 0 var(--glow-color, rgba(6, 182, 212, 0.15));
            transform: translateY(-3px);
        }

        /* Prevent layout jumping before ScrollSmoother fully initializes */
        #smooth-wrapper {
            overflow: hidden;
            position: fixed;
            height: 100%;
            width: 100%;
            top: 0;
            left: 0;
        }

        #smooth-content {
            overflow: visible;
            width: 100%;
        }

        /* Hide scrollbars for full-screen aesthetic, custom indicator is handled natively */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #090D16;
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.08);
            border-radius: 999px;
            border: 2px solid #090D16;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.18);
        }

        /* Helper for title mask clip text reveal */
        .clip-text-reveal {
            clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%);
        }
    </style>
</head>
<body class="bg-[#090D16] text-[#E2E8F0] antialiased overflow-x-hidden selection:bg-cyan-500 selection:text-white">

    <!-- Glowing Background Mesh Blobs (GSAP Parallax Speed-lag) -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute w-[600px] h-[600px] rounded-full bg-gradient-to-br from-indigo-600/10 to-purple-600/0 blur-[130px] -top-60 -left-60 animate-blob" data-speed="0.75"></div>
        <div class="absolute w-[700px] h-[700px] rounded-full bg-gradient-to-br from-cyan-500/10 to-emerald-500/0 blur-[140px] top-1/4 -right-40 animate-blob animation-delay-2000" data-speed="0.9"></div>
        <div class="absolute w-[500px] h-[500px] rounded-full bg-gradient-to-br from-fuchsia-600/8 to-pink-600/0 blur-[120px] bottom-10 left-1/4 animate-blob animation-delay-4000" data-speed="0.6"></div>
    </div>

    <!-- ScrollSmoother Outer Wrapper -->
    <div id="smooth-wrapper">
        <!-- ScrollSmoother Content Wrapper -->
        <div id="smooth-content">

            <div class="max-w-6xl mx-auto px-4 py-12 md:py-20 flex flex-col lg:flex-row gap-8 lg:gap-16 relative z-10">

                <!-- SIDEBAR: Profile Card -->
                <aside class="w-full lg:w-80 shrink-0">
                    <div class="glass-panel rounded-3xl p-8 flex flex-col gap-6 text-center lg:text-left border border-white/[0.05] shadow-[0_8px_32px_0_rgba(0,0,0,0.37)]">
                        <!-- Profile Logo / Photo -->
                        <div class="relative w-28 h-28 mx-auto lg:mx-0">
                            <!-- Glow Ring background -->
                            <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-cyan-400 to-indigo-600 blur-md opacity-40 animate-pulse"></div>
                            <!-- Actual Container -->
                            <div class="relative w-full h-full bg-[#0c1424]/90 rounded-2xl flex items-center justify-center p-4 border border-white/[0.08] shadow-inner">
                                <img src="{{ setting('site_logo') ?: asset('assets/image/logo.png') }}" alt="{{ setting('site_name') }} Logo" class="w-full h-full object-contain filter drop-shadow-[0_2px_8px_rgba(6,182,212,0.3)]">
                            </div>
                        </div>

                        <!-- Name and Tagline -->
                        <div class="space-y-3">
                            <div class="clip-text-reveal">
                                <h1 class="text-3xl lg:text-2xl font-black text-white tracking-tight leading-tight gsap-title">
                                    {{ setting('site_name', 'Andrew.Devlog') }}
                                </h1>
                            </div>
                            <p class="text-xs font-bold text-cyan-400 font-mono tracking-widest uppercase">
                                {{ setting('sosmed_full_name', 'Princenton Andrew Brightly Masrikat') }}
                            </p>
                            <div class="inline-block bg-white/[0.03] text-slate-300 text-xs px-3.5 py-1.5 rounded-full font-medium border border-white/[0.05]">
                                {{ setting('sosmed_tagline', 'Tech Innovator & Developer') }}
                            </div>
                        </div>

                        <div class="h-px bg-white/[0.08]"></div>

                        <!-- Location Info -->
                        <div class="flex items-center justify-center lg:justify-start gap-3 text-sm text-slate-300 bg-white/[0.02] border border-white/[0.04] px-4 py-3 rounded-2xl w-fit mx-auto lg:mx-0">
                            <i data-lucide="map-pin" class="w-4 h-4 text-cyan-400"></i>
                            <span class="font-medium">{{ setting('sosmed_location', 'Surabaya, Indonesia') }}</span>
                        </div>
                    </div>
                </aside>

                <!-- MAIN CONTENT -->
                <main class="flex-1 space-y-12">

                    <!-- Hero Banner Card -->
                    <div class="glass-panel rounded-3xl p-8 md:p-12 relative overflow-hidden flex items-center min-h-[160px] md:min-h-[220px] border border-white/[0.08] shadow-[0_12px_40px_0_rgba(0,0,0,0.5)] group cursor-default">
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-950/80 via-[#0a0f1d]/90 to-cyan-950/80 opacity-95 z-0"></div>
                        <div class="absolute -top-1/2 -left-1/2 w-full h-full bg-gradient-to-br from-cyan-500/10 to-transparent blur-[80px] group-hover:translate-x-12 group-hover:translate-y-12 transition-transform duration-1000"></div>

                        <div class="relative z-10 w-full flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                            <div class="space-y-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 bg-white/[0.04] backdrop-blur-md rounded-xl flex items-center justify-center text-cyan-400 border border-white/[0.06] shadow-lg">
                                        <i data-lucide="code" class="w-4 h-4"></i>
                                    </div>
                                    <span class="text-cyan-400 font-bold text-xs tracking-widest uppercase font-mono">Tingkatkan Bisnis Anda</span>
                                </div>
                                <div class="clip-text-reveal">
                                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight gsap-title-hero">
                                        Jasa Pembuatan <br class="hidden md:block"/>Website & Aplikasi
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- About Me -->
                    <div class="glass-panel rounded-3xl p-8 md:p-10 border border-white/[0.05] shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] relative overflow-hidden group">
                        <!-- Decorative background SVG icon -->
                        <div class="absolute -bottom-6 -right-6 p-8 text-white/[0.01] transition-all group-hover:text-cyan-400/[0.02] group-hover:scale-105 duration-700 pointer-events-none">
                            <i data-lucide="user" class="w-48 h-48"></i>
                        </div>

                        <h3 class="text-xl font-bold text-white mb-5 flex items-center gap-3 gsap-section-title">
                            <div class="w-1.5 h-6 bg-gradient-to-b from-cyan-400 to-indigo-500 rounded-full"></div>
                            Tentang Saya
                        </h3>
                        <p class="text-slate-300 leading-relaxed text-sm md:text-base relative z-10 whitespace-pre-line font-light">
                            {{ setting('sosmed_about', 'Halo! Saya adalah seorang Software Developer profesional yang berdedikasi dalam mengubah ide menjadi realitas digital. Dengan keahlian mendalam dalam pengembangan web dan aplikasi mobile, saya siap membantu bisnis Anda tumbuh lebih cepat melalui solusi teknologi yang modern, responsif, dan scalable.') }}
                        </p>
                    </div>

                    <!-- Filter Tabs & Links -->
                    <div class="space-y-6">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <h3 class="text-xl font-bold text-white flex items-center gap-3 gsap-section-title">
                                <div class="w-1.5 h-6 bg-gradient-to-b from-cyan-400 to-indigo-500 rounded-full"></div>
                                Tautan & Sosmed
                            </h3>

                            <!-- GSAP Flip Filter Buttons -->
                            <div class="glass-panel p-1 rounded-2xl flex w-fit gap-1 border border-white/[0.04] bg-white/[0.01]">
                                <button data-filter="semua" class="tab-btn px-4 py-2 rounded-xl text-xs md:text-sm font-semibold transition-all duration-300 cursor-pointer select-none active relative bg-white/[0.06] text-white">
                                    Semua
                                </button>
                                <button data-filter="bisnis" class="tab-btn px-4 py-2 rounded-xl text-xs md:text-sm font-semibold transition-all duration-300 cursor-pointer select-none relative text-slate-400 hover:text-white">
                                    Bisnis
                                </button>
                                <button data-filter="sosial" class="tab-btn px-4 py-2 rounded-xl text-xs md:text-sm font-semibold transition-all duration-300 cursor-pointer select-none relative text-slate-400 hover:text-white">
                                    Sosial
                                </button>
                            </div>
                        </div>

                        @php
                            $storedLinks = setting('sosmed_links');
                            $baseMetadata = [
                                ['id' => 0, 'icon' => 'globe', 'icon_color' => 'text-cyan-400', 'type' => 'normal'],
                                ['id' => 1, 'icon' => 'fa-brands fa-whatsapp', 'icon_color' => 'text-emerald-400', 'type' => 'normal'],
                                ['id' => 2, 'icon' => 'tag', 'icon_color' => 'text-amber-400', 'type' => 'normal'],
                                ['id' => 3, 'icon' => 'briefcase', 'icon_color' => 'text-indigo-400', 'type' => 'normal'],
                                ['id' => 4, 'icon' => 'fa-brands fa-github', 'icon_color' => 'text-slate-300', 'type' => 'normal'],
                                ['id' => 5, 'icon' => 'fa-brands fa-linkedin', 'icon_color' => 'text-blue-400', 'type' => 'normal'],
                                ['id' => 6, 'icon' => 'mail', 'icon_color' => 'text-rose-400', 'type' => 'normal']
                            ];

                            $defaults = [
                                ['id' => 0, 'title' => 'Lihat website Andrew.devlog', 'url' => '/'],
                                ['id' => 1, 'title' => 'Konsultasi Project via WhatsApp', 'url' => 'https://wa.me/628123456789'],
                                ['id' => 2, 'title' => 'Lihat Daftar Harga Layanan', 'url' => route('harga')],
                                ['id' => 3, 'title' => 'Lihat Portfolio Project Saya', 'url' => route('portfolio')],
                                ['id' => 4, 'title' => 'Kunjungi GitHub Repository', 'url' => 'https://github.com/AndrewMasrikat'],
                                ['id' => 5, 'title' => 'Mari Terhubung di LinkedIn', 'url' => 'https://linkedin.com/in/andrewmasrikat'],
                                ['id' => 6, 'title' => 'Kirim Email Penawaran Kerja Sama', 'url' => 'mailto:contact@andrewdevlog.com']
                            ];

                            if ($storedLinks) {
                                $parsedLinks = json_decode($storedLinks, true);
                                $links = collect($parsedLinks)->map(function($stored) use ($baseMetadata) {
                                    $meta = collect($baseMetadata)->firstWhere('id', $stored['id']);
                                    return array_merge([
                                        'icon' => 'link',
                                        'icon_color' => 'text-slate-400',
                                        'type' => 'normal'
                                    ], $meta ?? [], $stored);
                                });
                            } else {
                                $links = collect($defaults)->map(function($def) use ($baseMetadata) {
                                    $meta = collect($baseMetadata)->firstWhere('id', $def['id']);
                                    return array_merge($def, $meta ?? []);
                                });
                            }

                            // Dynamic Categorization for Flip Filter
                            $links = collect($links)->map(function($link) {
                                $category = 'sosial';
                                $url = strtolower($link['url']);
                                if (
                                    in_array($link['id'], [0, 1, 2, 3]) ||
                                    str_contains($url, 'wa.me') ||
                                    str_contains($url, 'harga') ||
                                    str_contains($url, 'portfolio') ||
                                    str_contains($url, 'andrewdevlog') ||
                                    $link['id'] == 0
                                ) {
                                    $category = 'bisnis';
                                }
                                $link['category'] = $category;
                                return $link;
                            });
                        @endphp

                        <!-- Links Cards Grid (GSAP Flip Target Container) -->
                        <div id="links-container" class="grid grid-cols-1 md:grid-cols-2 gap-4 relative">
                            @foreach($links as $link)
                                <div class="link-card transform-gpu" data-category="{{ $link['category'] }}">
                                    <a href="{{ $link['url'] }}" target="_blank"
                                       class="group flex items-center p-4 rounded-2xl transition-all duration-300 glass-panel border-white/[0.04] bg-white/[0.01] glass-card-hover min-h-[84px]"
                                       style="--glow-color: rgba(6, 182, 212, 0.1);">
                                        <div class="w-12 h-12 rounded-xl flex items-center justify-center group-hover:scale-110 transition-all duration-500 mr-4 shrink-0 bg-white/[0.03] border border-white/[0.05]">
                                            @if(str_contains($link['icon'], 'fa-'))
                                                <i class="{{ $link['icon'] }} {{ $link['icon_color'] }} text-lg"></i>
                                            @else
                                                <i data-lucide="{{ $link['icon'] }}" class="w-5 h-5 {{ $link['icon_color'] }}"></i>
                                            @endif
                                        </div>
                                        <span class="text-sm font-semibold transition-colors flex-1 pr-2 text-slate-200 group-hover:text-cyan-400">
                                            {{ $link['title'] }}
                                        </span>
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-white/[0.02] border border-white/[0.04] opacity-40 group-hover:opacity-100 group-hover:bg-cyan-500/10 group-hover:border-cyan-500/20 transition-all duration-300 shrink-0">
                                            <i data-lucide="arrow-up-right" class="w-4 h-4 text-slate-400 group-hover:text-cyan-400"></i>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Services Section -->
                    <div class="space-y-6 pt-6">
                        <h3 class="text-xl font-bold text-white flex items-center gap-3 gsap-section-title">
                            <div class="w-1.5 h-6 bg-gradient-to-b from-cyan-400 to-indigo-500 rounded-full"></div>
                            Layanan Saya
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @php
                                $baseServices = [
                                    ['id' => 'web', 'icon' => 'globe', 'rotate' => '-rotate-12', 'bg' => 'bg-gradient-to-br from-indigo-950/60 to-slate-950/80'],
                                    ['id' => 'app', 'icon' => 'smartphone', 'rotate' => 'rotate-6', 'bg' => 'bg-gradient-to-br from-indigo-500 to-blue-600'],
                                    ['id' => 'uiux', 'icon' => 'pen-tool', 'rotate' => '-rotate-6', 'bg' => 'bg-gradient-to-br from-violet-500 to-purple-600'],
                                    ['id' => 'api', 'icon' => 'database', 'rotate' => 'rotate-12', 'bg' => 'bg-gradient-to-br from-teal-500 to-emerald-600'],
                                    ['id' => 'seo', 'icon' => 'trending-up', 'rotate' => '-rotate-12', 'bg' => 'bg-gradient-to-br from-amber-500 to-orange-600'],
                                    ['id' => 'redesign', 'icon' => 'palette', 'rotate' => 'rotate-12', 'bg' => 'bg-gradient-to-br from-rose-500 to-pink-600'],
                                    ['id' => 'repair', 'icon' => 'wrench', 'rotate' => '-rotate-6', 'bg' => 'bg-gradient-to-br from-red-600 to-rose-700'],
                                    ['id' => 'maintenance', 'icon' => 'shield-check', 'rotate' => 'rotate-12', 'bg' => 'bg-gradient-to-br from-cyan-500 to-blue-600']
                                ];

                                $defaults = [
                                    ['id' => 'web', 'name' => 'Web Development', 'desc' => 'Pembuatan website company profile, e-commerce, landing page, hingga sistem informasi custom.'],
                                    ['id' => 'app', 'name' => 'Mobile App Development', 'desc' => 'Pengembangan aplikasi Android & iOS berkualitas tinggi yang responsif dan user-friendly.'],
                                    ['id' => 'uiux', 'name' => 'UI/UX Design', 'desc' => 'Perancangan antarmuka yang modern, estetis, dan memberikan pengalaman pengguna terbaik.'],
                                    ['id' => 'api', 'name' => 'Backend & API', 'desc' => 'Pembuatan arsitektur server, database management, dan integrasi RESTful API yang aman.'],
                                    ['id' => 'seo', 'name' => 'SEO Optimization', 'desc' => 'Optimasi mesin pencari untuk meningkatkan visibilitas website Anda dan mendatangkan trafik organik.'],
                                    ['id' => 'redesign', 'name' => 'Redesign Website', 'desc' => 'Pembaruan UI/UX dan struktur website lama Anda menjadi lebih modern, cepat, dan responsif.'],
                                    ['id' => 'repair', 'name' => 'Perbaikan Website', 'desc' => 'Penyelesaian bug, error, blank page, atau perbaikan masalah layout agar website kembali normal.'],
                                    ['id' => 'maintenance', 'name' => 'Maintenance Website', 'desc' => 'Pemeliharaan server, pembaruan sistem, backup data berkala, dan monitoring keamanan.']
                                ];

                                $storedServices = setting('sosmed_services');
                                if ($storedServices) {
                                    $parsedServices = json_decode($storedServices, true);
                                    $finalServices = collect($parsedServices)->map(function($stored) use ($baseServices) {
                                        $base = collect($baseServices)->firstWhere('id', $stored['id']);
                                        return array_merge([
                                            'icon' => 'star',
                                            'rotate' => 'rotate-0',
                                            'bg' => 'bg-slate-800'
                                        ], $base ?? [], $stored);
                                    });
                                } else {
                                    $finalServices = collect($defaults)->map(function($def) use ($baseServices) {
                                        $base = collect($baseServices)->firstWhere('id', $def['id']);
                                        return array_merge($def, $base ?? []);
                                    });
                                }
                            @endphp

                            @foreach($finalServices as $item)
                                @php
                                    // Custom colors mapping for maximum visual hierarchy and aesthetic wow-factor
                                    $glowColor = 'rgba(6,182,212,0.12)';
                                    $accentColor = 'text-cyan-400';
                                    $gradient = 'from-slate-900/60 to-[#0c1220]/80';

                                    if($item['id'] === 'web') {
                                        $gradient = 'from-indigo-950/40 via-[#0d1326]/70 to-[#080c18]/90';
                                        $glowColor = 'rgba(99,102,241,0.12)';
                                        $accentColor = 'text-indigo-400';
                                    } elseif($item['id'] === 'app') {
                                        $gradient = 'from-violet-950/40 via-[#0e1227]/70 to-[#090b19]/90';
                                        $glowColor = 'rgba(139,92,246,0.12)';
                                        $accentColor = 'text-violet-400';
                                    } elseif($item['id'] === 'uiux') {
                                        $gradient = 'from-fuchsia-950/40 via-[#12112b]/70 to-[#0a0a1a]/90';
                                        $glowColor = 'rgba(217,70,239,0.12)';
                                        $accentColor = 'text-fuchsia-400';
                                    } elseif($item['id'] === 'api') {
                                        $gradient = 'from-teal-950/40 via-[#0a1523]/70 to-[#050b12]/90';
                                        $glowColor = 'rgba(20,184,166,0.12)';
                                        $accentColor = 'text-teal-400';
                                    } elseif($item['id'] === 'seo') {
                                        $gradient = 'from-amber-950/40 via-[#141221]/70 to-[#090914]/90';
                                        $glowColor = 'rgba(245,158,11,0.12)';
                                        $accentColor = 'text-amber-400';
                                    } elseif($item['id'] === 'redesign') {
                                        $gradient = 'from-rose-950/40 via-[#151023]/70 to-[#0a0815]/90';
                                        $glowColor = 'rgba(244,63,94,0.12)';
                                        $accentColor = 'text-rose-400';
                                    }
                                @endphp

                                <div class="glass-panel bg-gradient-to-br {{ $gradient }} rounded-3xl p-8 h-56 relative overflow-hidden group cursor-pointer border border-white/[0.04] glass-card-hover"
                                     style="--glow-color: {{ $glowColor }};">
                                    <div class="relative z-10 w-11/12 h-full flex flex-col justify-between">
                                        <h4 class="text-xl font-bold text-white group-hover:text-cyan-300 origin-left transition-colors duration-300 flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-lg bg-white/[0.04] border border-white/[0.06] flex items-center justify-center {{ $accentColor }} shrink-0">
                                                <i data-lucide="{{ $item['icon'] }}" class="w-4.5 h-4.5"></i>
                                            </div>
                                            {{ $item['name'] }}
                                        </h4>
                                        <p class="text-slate-300/80 text-sm leading-relaxed font-light mt-4 flex-1">
                                            {{ $item['desc'] }}
                                        </p>
                                    </div>

                                    <!-- Parallax decorative background icon -->
                                    <div class="absolute -bottom-8 -right-8 opacity-[0.03] group-hover:opacity-[0.09] text-white transform {{ $item['rotate'] }} scale-90 group-hover:scale-105 group-hover:-translate-y-2 transition-all duration-700 ease-out pointer-events-none"
                                         data-speed="0.1">
                                        <i data-lucide="{{ $item['icon'] }}" class="w-36 h-36"></i>
                                    </div>

                                    <!-- Hover Glass Overlay Shine -->
                                    <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/[0.01] to-white/[0.03] opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </main>
            </div>

            <!-- Footer -->
            <footer class="text-center py-12 text-xs text-slate-500 font-mono tracking-wider relative z-10 border-t border-white/[0.04] mt-12 bg-[#060a12]/30">
                <p>&copy; Hak Cipta 2026 {{ setting('site_name', 'Andrew.Devlog') }} - Princenton Andrew Brightly Masrikat</p>
            </footer>

        </div>
    </div>

    <!-- GSAP Integration & Script Execution -->
    <script>
        // Secure execution after all DOM and Vite bundles have completed load
        window.addEventListener('load', () => {
            // Re-instantiate icons as a backup for dynamically constructed cards
            if(window.lucide) {
                window.lucide.createIcons();
            }

            // 1. Initialize ScrollSmoother
            const smoother = window.ScrollSmoother.create({
                wrapper: "#smooth-wrapper",
                content: "#smooth-content",
                smooth: 1.6,
                effects: true,
                smoothTouch: 0.1
            });

            // 2. Title SplitText Entrance Effects
            if(window.SplitText) {
                const titleSplit = new window.SplitText(".gsap-title", { type: "chars, words" });
                const heroTitleSplit = new window.SplitText(".gsap-title-hero", { type: "words, lines" });
                const sectionTitleSplits = new window.SplitText(".gsap-section-title", { type: "words" });

                window.gsap.from(titleSplit.chars, {
                    opacity: 0,
                    y: 30,
                    stagger: 0.04,
                    duration: 0.9,
                    ease: "back.out(1.6)",
                    delay: 0.15
                });

                window.gsap.from(".relative.w-28.h-28", {
                    opacity: 0,
                    scale: 0.7,
                    duration: 1.2,
                    ease: "elastic.out(1, 0.75)",
                    delay: 0.1
                });

                window.gsap.from(heroTitleSplit.words, {
                    opacity: 0,
                    y: 20,
                    stagger: 0.06,
                    duration: 1,
                    ease: "power4.out",
                    delay: 0.45
                });
            }

            // 3. ScrollTrigger Card Entrance Animation
            if(window.ScrollTrigger) {
                // Link Cards Staggered fade in
                window.gsap.utils.toArray(".link-card").forEach((card) => {
                    window.gsap.from(card, {
                        scrollTrigger: {
                            trigger: card,
                            start: "top 92%",
                            toggleActions: "play none none none"
                        },
                        opacity: 0,
                        y: 35,
                        duration: 0.85,
                        ease: "power3.out"
                    });
                });

                // Services Cards Staggered slide reveal
                window.gsap.utils.toArray(".glass-panel[style*='--glow-color']").forEach((service) => {
                    window.gsap.from(service, {
                        scrollTrigger: {
                            trigger: service,
                            start: "top 94%",
                            toggleActions: "play none none none"
                        },
                        opacity: 0,
                        y: 45,
                        duration: 1.1,
                        ease: "power4.out"
                    });
                });

                // Pin profile sidebar dynamically on desktop layout
                window.ScrollTrigger.matchMedia({
                    "(min-width: 1024px)": function() {
                        window.ScrollTrigger.create({
                            trigger: "aside",
                            start: "top 64px",
                            endTrigger: "main",
                            end: "bottom bottom",
                            pin: "aside > div",
                            pinSpacing: false
                        });
                    }
                });
            }

            // 4. Flip Filter Category Layout Animations
            if(window.Flip) {
                const filterButtons = document.querySelectorAll(".tab-btn");
                const linkCards = document.querySelectorAll(".link-card");

                filterButtons.forEach(btn => {
                    btn.addEventListener("click", () => {
                        // De-activate current tabs
                        filterButtons.forEach(b => {
                            b.classList.remove("active", "bg-white/[0.06]", "text-white");
                            b.classList.add("text-slate-400");
                        });

                        // Set clicked button to active state
                        btn.classList.add("active", "bg-white/[0.06]", "text-white");
                        btn.classList.remove("text-slate-400");

                        const filterValue = btn.getAttribute("data-filter");

                        // Capture link cards visual states
                        const state = window.Flip.getState(linkCards);

                        // Rearrange items visibility
                        linkCards.forEach(card => {
                            const category = card.getAttribute("data-category");
                            if (filterValue === "semua" || category === filterValue) {
                                card.style.display = "block";
                                card.style.opacity = "1";
                                card.style.pointerEvents = "auto";
                            } else {
                                card.style.display = "none";
                                card.style.opacity = "0";
                                card.style.pointerEvents = "none";
                            }
                        });

                        // Make them "Flip" with a beautiful layout morph transition
                        window.Flip.from(state, {
                            duration: 0.65,
                            ease: "power3.inOut",
                            absolute: true,
                            onComplete: () => {
                                // Important: Refresh ScrollTrigger boundaries after dimensions change
                                window.ScrollTrigger.refresh();
                            }
                        });
                    });
                });
            }
        });
    </script>
</body>
</html>
