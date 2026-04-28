@extends('layouts.app')

@section('title', setting('site_name', 'Andrew.Devlog') . ' - Jasa Pembuatan Website Profesional & Joki Coding')

@section('head')
<script>
    // Page-specific Tailwind extensions
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    sans: ['Inter', 'sans-serif'],
                },
                colors: {
                    primary: {
                        DEFAULT: '#1877F2',
                        light: '#4294FF',
                        dark: '#0056B3',
                        50: '#f0f9ff',
                        100: '#e0effe',
                    },
                    meta: {
                        blue: '#0064E0',
                        light: '#0088FF',
                        purple: '#8A2BE2'
                    }
                },
                animation: {
                    'blob': 'blob 10s infinite',
                    'float': 'float 6s ease-in-out infinite',
                    'pulse-soft': 'pulse-soft 2s infinite',
                    'spin-slow': 'spin 15s linear infinite',
                    'bounce-slow': 'bounce 3s infinite',
                    'marquee': 'marquee 40s linear infinite',
                    'spin-reverse': 'spin-reverse 20s linear infinite',
                },
                keyframes: {
                    blob: {
                        '0%': { transform: 'translate(0px, 0px) scale(1)' },
                        '33%': { transform: 'translate(50px, -70px) scale(1.2)' },
                        '66%': { transform: 'translate(-30px, 30px) scale(0.8)' },
                        '100%': { transform: 'translate(0px, 0px) scale(1)' },
                    },
                    float: {
                        '0%, 100%': { transform: 'translate(0, 0) rotate(0deg)' },
                        '33%': { transform: 'translate(5px, -15px) rotate(2deg)' },
                        '66%': { transform: 'translate(-5px, -25px) rotate(-2deg)' },
                    },
                    'pulse-soft': {
                        '0%': { boxShadow: '0 0 0 0 rgba(24, 119, 242, 0.4)', transform: 'scale(1)' },
                        '70%': { boxShadow: '0 0 0 15px rgba(24, 119, 242, 0)', transform: 'scale(1.05)' },
                        '100%': { boxShadow: '0 0 0 0 rgba(24, 119, 242, 0)', transform: 'scale(1)' },
                    },
                    'spin-reverse': {
                        'from': { transform: 'rotate(360deg)' },
                        'to': { transform: 'rotate(0deg)' },
                    },
                    marquee: {
                        '0%': { transform: 'translateX(0)' },
                        '100%': { transform: 'translateX(-50%)' },
                    }
                }
            }
        }
    }
</script>

<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "ProfessionalService",
  "name": "{{ setting('site_name', 'Andrew.Devlog') }}",
  "image": "{{ setting('site_logo') ?: asset('assets/image/logo.png') }}",
  "@@id": "{{ url('/') }}",
  "url": "{{ url('/') }}",
  "telephone": "{{ setting('contact_phone', '') }}",
  "address": {
    "@@type": "PostalAddress",
    "streetAddress": "Surabaya",
    "addressLocality": "Surabaya",
    "addressRegion": "Jawa Timur",
    "postalCode": "60000",
    "addressCountry": "ID"
  },
  "geo": {
    "@@type": "GeoCoordinates",
    "latitude": -7.2575,
    "longitude": 112.7521
  },
  "openingHoursSpecification": {
    "@@type": "OpeningHoursSpecification",
    "dayOfWeek": [
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
      "Sunday"
    ],
    "opens": "00:00",
    "closes": "23:59"
  },
  "sameAs": [
    "{{ setting('social_instagram', '#') }}",
    "{{ setting('social_linkedin', '#') }}"
  ],
  "priceRange": "$$",
  "description": "{{ setting('meta_description', 'Andrew.DevLog melayani jasa pembuatan website profesional, aplikasi web, dan optimasi SEO untuk meningkatkan visibilitas bisnis Anda di Google.') }}"
}
</script>
@endsection

@section('content')
    <div class="relative min-h-screen bg-[#F8FAFC] overflow-x-hidden">
        <!-- Background Grid & Decorative Blobs -->
        <div class="absolute inset-0 z-[-10]">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 50% 50%, rgba(24, 119, 242, 0.05), transparent 70%);"></div>
            <div class="absolute inset-0 opacity-[0.03]" style="background-image: linear-gradient(#1877F2 1px, transparent 1px), linear-gradient(90deg, #1877F2 1px, transparent 1px); background-size: 40px 40px;"></div>
        </div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-radial-gradient from-blue-100/20 to-transparent blur-3xl pointer-events-none -z-10"></div>

        <!-- Hero Section -->
        <section class="relative pt-32 pb-32 px-6 max-w-7xl mx-auto flex flex-col items-center text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white shadow-sm border border-slate-100 mb-8 animate-float">
                <span class="flex h-2 w-2 rounded-full bg-primary animate-pulse"></span>
                <span class="text-xs font-bold text-slate-500 tracking-wider uppercase">{{ setting('hero_badge', 'Arsitek Digital Terbaik 2026') }}</span>
            </div>

            <h1 class="text-4xl md:text-6xl lg:text-[72px] font-black tracking-tight leading-[1.1] mb-8 text-indigo-950 max-w-5xl">
                {{ setting('hero_title_1', 'Jasa Pembuatan') }} <br />
                <span class="inline-flex items-center font-normal mt-4">
                    {{ setting('hero_title_2', 'Website') }}
                    <div class="mx-3 px-5 py-2 bg-white shadow-xl shadow-primary/5 border border-slate-100 rounded-full flex items-center gap-3 transition-transform hover:scale-105 cursor-default">
                        <div class="w-6 h-6 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 border-2 border-white shadow-sm ring-1 ring-slate-100 flex items-center justify-center">
                            <i class="fas fa-code text-[10px] text-white"></i>
                        </div>
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-400 font-black tracking-wide text-xl md:text-2xl">Joki</span>
                    </div>
                    {{ setting('hero_title_3', '& Coding') }}
                </span>
            </h1>

            <p class="text-slate-500 max-w-2xl text-base md:text-lg leading-relaxed mb-12">
                {{ setting('hero_subtitle', 'Tingkatkan konversi dan visibilitas online bisnis Anda dengan website berkinerja tinggi dan solusi joki coding profesional yang terpercaya.') }}
            </p>

            <div class="relative w-full max-w-5xl h-[350px] sm:h-[500px] flex items-center justify-center mt-8 sm:mt-12 scale-[0.8] sm:scale-100">
                <!-- Background Grid -->
                <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
                     style="background-image: linear-gradient(#1877F2 1px, transparent 1px), linear-gradient(90deg, #1877F2 1px, transparent 1px); background-size: 50px 50px;">
                </div>

                <!-- Single Large Arc Path (Solid Line) -->
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                    <svg viewBox="0 0 1000 500" class="w-full h-full opacity-10">
                        <path d="M 50 450 C 150 100, 850 100, 950 450" fill="none" stroke="#1877F2" stroke-width="1.5"/>
                    </svg>
                </div>

                <!-- Main Hero Element (Central Coding Logo) -->
                <div class="relative z-10 w-48 h-48 sm:w-64 sm:h-64 flex items-center justify-center animate-pulse-soft animate-float rounded-full">
                    <!-- Rotating Ring -->
                    <div class="absolute inset-0 border-2 border-dashed border-primary/30 rounded-full animate-spin-slow"></div>
                    <div class="absolute inset-4 border border-dashed border-primary/20 rounded-full animate-spin-reverse"></div>

                    <div class="relative hover:scale-110 transition-transform duration-500 group">
                        <img src="https://img.icons8.com/?size=100&id=ezj3zaVtImPg&format=png&color=000000" alt="VS Code" class="w-24 h-24 sm:w-40 sm:h-40 object-contain group-hover:rotate-12 transition-transform">
                    </div>
                </div>

                <!-- Floating Elements - Following the curve exactly -->

                <!-- GitHub Icon -->
                <div class="absolute top-[30%] sm:top-[35%] left-[8%] sm:left-[12%] flex items-center justify-center transform -rotate-12 hover:rotate-0 transition-all duration-500 cursor-pointer z-20 animate-float" style="animation-delay: 1.2s; animation-duration: 7s;">
                    <i class="fab fa-github text-3xl sm:text-5xl text-slate-900"></i>
                </div>

                <!-- VS Code / Code Icon -->
                <div class="absolute bottom-[20%] sm:bottom-[25%] left-[20%] sm:left-[30%] flex items-center justify-center transform rotate-6 hover:scale-110 transition-all duration-500 cursor-pointer z-20 animate-float" style="animation-delay: 2.5s; animation-duration: 5.5s;">
                    <i class="fas fa-code text-2xl sm:text-4xl text-blue-500"></i>
                </div>

                <!-- Laravel Icon -->
                <div class="absolute bottom-[20%] sm:bottom-[25%] right-[20%] sm:right-[30%] flex items-center justify-center transform rotate-12 hover:rotate-0 transition-all duration-500 cursor-pointer z-20 animate-float" style="animation-delay: 1.8s; animation-duration: 6.5s;">
                    <i class="fab fa-laravel text-2xl sm:text-4xl text-[#FF2D20]"></i>
                </div>

                <!-- Terminal Icon -->
                <div class="absolute top-[30%] sm:top-[35%] right-[8%] sm:right-[12%] flex items-center justify-center transform hover:scale-110 transition-all duration-500 cursor-pointer z-20 animate-float" style="animation-delay: 0.5s; animation-duration: 8s;">
                    <i class="fas fa-terminal text-2xl sm:text-4xl text-indigo-600"></i>
                </div>

                <!-- Contact Card (Top Right) -->
                <div class="absolute top-[5%] sm:top-[10%] -right-4 sm:right-[10%] bg-white/90 backdrop-blur-md border border-white p-3 sm:p-5 rounded-[1.5rem] sm:rounded-[2rem] shadow-2xl flex items-center gap-2 sm:gap-4 z-30 animate-float scale-75 sm:scale-100">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-[#25D366] rounded-full flex items-center justify-center shadow-lg shadow-green-200">
                        <i class="fab fa-whatsapp text-white text-xl sm:text-2xl"></i>
                    </div>
                    <div class="text-left">
                        <p class="text-sm sm:text-lg font-black text-slate-800 leading-none mb-1">Punya Project?</p>
                        <p class="text-[8px] sm:text-[10px] text-slate-500 font-medium leading-tight max-w-[100px] sm:max-w-[150px]">Hubungi via WA</p>
                    </div>
                </div>

                <!-- CTA Button (Top Left) -->
                <div class="absolute top-[10%] sm:top-[18%] -left-4 sm:left-[12%] z-30 animate-float scale-75 sm:scale-100" style="animation-delay: 0.5s;">
                    <div class="flex items-center gap-2 sm:gap-4">
                        <span class="text-xs sm:text-sm font-bold text-blue-600">Konsultasi</span>
                        <a href="#kontak" class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-primary text-white flex items-center justify-center shadow-lg shadow-primary/30 group hover:scale-110 transition-all">
                            <i class="fas fa-arrow-up text-xs sm:text-sm rotate-45"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Trusted Brands Marquee -->
        <section class="border-y border-slate-200/40 bg-white/50 backdrop-blur-sm py-12 overflow-hidden">
            <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center gap-12">
                <div class="shrink-0 text-center md:text-left">
                    <p class="text-xs font-black uppercase tracking-[0.2em] text-slate-400 mb-1">Dipercaya Oleh</p>
                    <p class="text-lg font-bold text-slate-900 leading-tight">Mitra<br/>Global</p>
                </div>

                <div class="flex-1 overflow-hidden">
                    <div class="flex items-center gap-16 animate-marquee whitespace-nowrap">
                        @php
                            $techLogos = [
                                ['name' => 'Cloudflare', 'icon' => 'fab fa-cloudflare'],
                                ['name' => 'Figma', 'icon' => 'fab fa-figma'],
                                ['name' => 'Firebase', 'icon' => 'fas fa-fire'],
                                ['name' => 'Flutter', 'icon' => 'fas fa-mobile-alt'],
                                ['name' => 'GraphQL', 'icon' => 'fas fa-project-diagram'],
                                ['name' => 'Laravel', 'icon' => 'fab fa-laravel'],
                                ['name' => 'Mysql', 'icon' => 'fas fa-database'],
                            ];
                        @endphp

                        @foreach(array_merge($techLogos, $techLogos, $techLogos) as $tech)
                        <div class="flex items-center gap-3 opacity-30 hover:opacity-100 transition-opacity cursor-default grayscale hover:grayscale-0 py-2">
                            <i class="{{ $tech['icon'] }} text-2xl text-slate-600"></i>
                            <span class="text-xl font-bold tracking-tighter text-slate-800">{{ $tech['name'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>


    </div>

        <!-- 3-Step Process Section -->
        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-6 text-center">
                <h2 class="text-3xl md:text-5xl font-black text-indigo-950 mb-4 tracking-tight">Gampang Banget, Cuma 3 Step!</h2>
                <p class="text-slate-500 mb-16 text-lg">Dari sekadar tanya, tugas beres sampai di depan mata.</p>

                <div class="grid md:grid-cols-3 gap-12 relative">
                    <!-- Step 1 -->
                    <div class="relative group">
                        <div class="w-20 h-20 bg-[#00D95F]/10 rounded-3xl flex items-center justify-center mx-auto mb-8 transition-transform group-hover:scale-110 group-hover:rotate-3">
                            <i class="fab fa-whatsapp text-4xl text-[#00D95F]"></i>
                        </div>
                        <h3 class="text-xl font-black text-indigo-950 mb-3 tracking-tight">Chat & Cerita</h3>
                        <p class="text-slate-500 text-sm leading-relaxed max-w-[250px] mx-auto">
                            Beri tahu apa yang kamu butuhkan. Joki kami sudah standby menunggu cerita kamu.
                        </p>
                        <!-- Arrow -->
                        <div class="hidden md:block absolute top-10 -right-6 text-slate-200">
                            <i class="fas fa-arrow-right text-xl"></i>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative group">
                        <div class="w-20 h-20 bg-[#1877F2]/10 rounded-3xl flex items-center justify-center mx-auto mb-8 transition-transform group-hover:scale-110 group-hover:-rotate-3">
                            <i class="fas fa-file-invoice-dollar text-4xl text-[#1877F2]"></i>
                        </div>
                        <h3 class="text-xl font-black text-indigo-950 mb-3 tracking-tight">Deal & Bayar</h3>
                        <p class="text-slate-500 text-sm leading-relaxed max-w-[250px] mx-auto">
                            Deal untuk harga dan bayar. Tim kami siap langsung eksekusi tanpa tapi-tapi.
                        </p>
                        <!-- Arrow -->
                        <div class="hidden md:block absolute top-10 -right-6 text-slate-200">
                            <i class="fas fa-arrow-right text-xl"></i>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative group">
                        <div class="w-20 h-20 bg-[#8A2BE2]/10 rounded-3xl flex items-center justify-center mx-auto mb-8 transition-transform group-hover:scale-110 group-hover:rotate-3">
                            <i class="fas fa-mug-hot text-4xl text-[#8A2BE2]"></i>
                        </div>
                        <h3 class="text-xl font-black text-indigo-950 mb-3 tracking-tight">Santai & Terima</h3>
                        <p class="text-slate-500 text-sm leading-relaxed max-w-[250px] mx-auto">
                            Duduk santai, minum kopi, tugasmu tahu-tahu beres sesuai target yang disepakati.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Choose Us Section -->
        <section class="py-32 bg-[#F8FAFC]">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-20">
                    <h2 class="text-3xl md:text-5xl font-black text-indigo-950 mb-4 tracking-tight">Kenapa Pilih Kita?</h2>
                    <p class="text-slate-500 text-lg max-w-2xl mx-auto">Bukan cuma sekadar bayar doang. Ini alasan kamu bakal nikmatin joki dari tim kami.</p>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all group">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center mb-6 text-primary transition-transform group-hover:scale-110">
                            <i class="fas fa-code text-xl"></i>
                        </div>
                        <h3 class="text-xl font-black text-indigo-950 mb-3 tracking-tight">Kode yang Rapi & Clean</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            Struktur coding rapi, mudah dibaca, dan pakai standar terbaru sehingga aman untuk jangka panjang.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all group">
                        <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center mb-6 text-purple-600 transition-transform group-hover:scale-110">
                            <i class="fas fa-bolt text-xl"></i>
                        </div>
                        <h3 class="text-xl font-black text-indigo-950 mb-3 tracking-tight">Dikerjakan dengan Cepat</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            Deadline mepet? Tenang, tim kami terbiasa dengan jadwal yang super ngegas namun tetap berkualitas.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all group">
                        <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center mb-6 text-green-600 transition-transform group-hover:scale-110">
                            <i class="fas fa-shield-alt text-xl"></i>
                        </div>
                        <h3 class="text-xl font-black text-indigo-950 mb-3 tracking-tight">Dijamin Rahasia</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            Privasi data kamu aman 100%. Nama kamu gak bakal bocor ke dosen, asisten laboratorium, atau atasan.
                        </p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all group">
                        <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center mb-6 text-orange-500 transition-transform group-hover:scale-110">
                            <i class="fas fa-sync text-xl"></i>
                        </div>
                        <h3 class="text-xl font-black text-indigo-950 mb-3 tracking-tight">Revisi? Gratis Dong!</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            Belum puas dengan hasilnya? Tenang, kami berikan revisi sampai deal tanpa biaya tambahan sepeserpun.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Portfolio Section -->
        <section id="portofolio" class="py-32 bg-white">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-20">
                    <h2 class="text-3xl md:text-5xl font-black text-indigo-950 mb-4 tracking-tight">Penasaran Sama Hasilnya?</h2>
                    <p class="text-slate-500 text-lg max-w-2xl mx-auto">Cek project yang sudah kami selesaikan. Semua dibuat dengan penuh kasih sayang dan standar industri.</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($portfolios as $portfolio)
                    <div class="group cursor-pointer">
                        <div class="relative aspect-[16/10] rounded-[2.5rem] overflow-hidden bg-slate-100 mb-8 shadow-2xl shadow-slate-200/50">
                            @if($portfolio->image_url)
                                <img src="{{ $portfolio->image_url }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-slate-50">
                                    <i class="fas fa-image text-4xl text-slate-200"></i>
                                </div>
                            @endif
                            
                            <!-- Hover Overlay -->
                            <div class="absolute inset-0 bg-indigo-950/40 opacity-0 group-hover:opacity-100 transition-all duration-500 backdrop-blur-[2px] flex items-center justify-center">
                                <div class="w-16 h-16 rounded-full bg-white text-indigo-950 flex items-center justify-center text-xl transform translate-y-10 group-hover:translate-y-0 transition-all duration-500 shadow-2xl">
                                    <i class="fas fa-external-link-alt"></i>
                                </div>
                            </div>
                        </div>
                        <div class="px-2">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="px-3 py-1 rounded-full bg-primary/10 text-primary text-[10px] font-black uppercase tracking-widest">{{ $portfolio->category->name ?? 'Project' }}</span>
                                <span class="text-slate-300 text-xs">•</span>
                                <span class="text-slate-400 text-xs font-bold">{{ $portfolio->client_name }}</span>
                            </div>
                            <h3 class="text-2xl font-black text-indigo-950 mb-2 tracking-tight group-hover:text-primary transition-colors">{{ $portfolio->title }}</h3>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Pricing Section -->
        <section id="harga" class="py-32 bg-[#F8FAFC]">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-20">
                    <h2 class="text-3xl md:text-5xl font-black text-indigo-950 mb-4 tracking-tight">Harga yang Masuk Akal</h2>
                    <p class="text-slate-500 text-lg max-w-2xl mx-auto">Tenang, kantong mahasiswa bersahabat. Pilih paket yang paling cocok buat kebutuhan akademikmu.</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8 items-stretch">
                    @foreach($prices as $price)
                    <div class="relative bg-white p-12 rounded-[3rem] border {{ $price->is_popular ? 'border-primary shadow-2xl shadow-primary/10' : 'border-slate-100 shadow-sm' }} flex flex-col h-full transform transition-all hover:scale-[1.02]">
                        @if($price->is_popular)
                        <div class="absolute -top-4 left-1/2 -translate-x-1/2 px-6 py-2 rounded-full bg-primary text-white text-[10px] font-black uppercase tracking-widest shadow-xl">
                            Paling Populer
                        </div>
                        @endif
                        
                        <h4 class="text-sm font-black text-slate-400 uppercase tracking-[0.2em] mb-4">{{ $price->service_name }}</h4>
                        <div class="flex items-baseline gap-2 mb-8">
                            <span class="text-sm font-bold text-slate-400">mulai dari</span>
                            <span class="text-4xl font-black text-indigo-950">Rp {{ number_format($price->price, 0, ',', '.') }}</span>
                        </div>

                        <ul class="space-y-4 mb-10 flex-1">
                            @if(is_array($price->features))
                                @foreach($price->features as $feature)
                                    @if(trim($feature))
                                    <li class="flex items-center gap-3 text-slate-500 text-sm">
                                        <i class="fas fa-check-circle text-primary text-base"></i>
                                        {{ trim($feature) }}
                                    </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>

                        <a href="#kontak" onclick="document.getElementById('service_name').value='{{ $price->service_name }}'; document.getElementById('service_category_id').value='{{ $price->service_category_id }}'" 
                           class="w-full py-5 rounded-2xl {{ $price->is_popular ? 'bg-primary text-white shadow-xl shadow-primary/30' : 'bg-slate-50 text-slate-600 border border-slate-100' }} text-center font-black tracking-wide hover:scale-[1.05] transition-all">
                            Pilih Paket Ini
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section id="testimoni" class="py-32 bg-white overflow-hidden">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-20">
                    <h2 class="text-3xl md:text-5xl font-black text-indigo-950 mb-4 tracking-tight">Apa Kata Mereka?</h2>
                    <p class="text-slate-500 text-lg">Kepercayaan kamu adalah segalanya bagi kami.</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($testimonials as $testimonial)
                    <div class="bg-slate-50 p-10 rounded-[2.5rem] border border-slate-100 relative group transition-all hover:bg-white hover:shadow-xl">
                        <div class="flex gap-1 mb-6">
                            @for($i=0; $i<5; $i++)
                                <i class="fas fa-star text-orange-400 text-xs"></i>
                            @endfor
                        </div>
                        <p class="text-slate-600 text-sm leading-relaxed mb-8 font-medium">"{{ $testimonial->content }}"</p>
                        <div class="flex items-center gap-4">
                            @if($testimonial->avatar_url)
                                <img src="{{ $testimonial->avatar_url }}" alt="{{ $testimonial->name }}" class="w-12 h-12 rounded-full object-cover">
                            @else
                                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary font-black">
                                    {{ substr($testimonial->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <h5 class="text-sm font-black text-indigo-950 leading-none mb-1">{{ $testimonial->name }}</h5>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">{{ $testimonial->position }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="kontak" class="py-32 bg-[#F8FAFC]">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid lg:grid-cols-2 gap-24 items-center">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-primary/5 rounded-lg mb-6">
                            <i class="fas fa-paper-plane text-primary text-xs"></i>
                            <span class="text-[10px] font-black uppercase tracking-widest text-primary">Hubungi Kami</span>
                        </div>
                        <h2 class="text-4xl md:text-6xl font-black text-indigo-950 mb-8 leading-tight">
                            Siap Untuk <span class="text-primary italic">Berkembang?</span>
                        </h2>
                        <p class="text-slate-500 text-lg leading-relaxed mb-12 max-w-lg">
                            Ambil langkah pertama untuk menyelesaikan tugasmu. Isi formulir dan pakar kami akan menghubungi Anda sesegera mungkin.
                        </p>

                        <div class="space-y-8">
                            <div class="flex items-center gap-6">
                                <div class="w-12 h-12 rounded-2xl bg-white shadow-lg flex items-center justify-center text-primary">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Email Kami</p>
                                    <p class="text-indigo-950 font-bold">{{ setting('contact_email', 'hello@bilcode.com') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-6">
                                <div class="w-12 h-12 rounded-2xl bg-white shadow-lg flex items-center justify-center text-primary">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">WhatsApp Kami</p>
                                    <p class="text-indigo-950 font-bold">{{ setting('contact_phone', '+62...') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="absolute -top-20 -right-20 w-64 h-64 bg-primary/5 rounded-full blur-3xl pointer-events-none"></div>

                        <div class="relative bg-white p-8 md:p-12 rounded-[3rem] border border-slate-100 shadow-[0_50px_100px_-20px_rgba(0,0,0,0.12)]">
                            @if(session('success'))
                                <div class="mb-8 p-4 bg-green-50 text-green-600 rounded-2xl text-sm font-black flex items-center gap-3">
                                    <i class="fas fa-check-circle"></i>
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('inquiry.store') }}" method="POST" class="space-y-6">
                                @csrf
                                <input type="hidden" name="service_category_id" id="service_category_id">
                                <input type="hidden" name="service_name" id="service_name">

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                                    <input type="text" name="name" required placeholder="Nama kamu..." class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none font-bold text-indigo-950 placeholder:text-slate-300">
                                </div>

                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Email</label>
                                        <input type="email" name="email" required placeholder="email@kamu.com" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none font-bold text-indigo-950 placeholder:text-slate-300">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Telepon/WA</label>
                                        <input type="tel" name="phone" required placeholder="+62..." class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none font-bold text-indigo-950 placeholder:text-slate-300">
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Pesan / Detail Tugas</label>
                                    <textarea id="message" name="message" required rows="4" placeholder="Ceritakan tentang tugas atau project kamu..." class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none font-bold text-indigo-950 placeholder:text-slate-300 resize-none"></textarea>
                                </div>

                                <button type="submit" class="w-full py-5 bg-primary text-white rounded-2xl font-black text-lg shadow-xl shadow-primary/30 hover:scale-[1.02] transition-all duration-300">
                                    Kirim Sekarang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pricingButtons = document.querySelectorAll('.pricing-btn');
        const messageArea = document.getElementById('message');
        const serviceCategorySelect = document.getElementById('service_category_id');
        const serviceNameInput = document.getElementById('service_name');

        pricingButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const package = this.getAttribute('data-package');
                const categoryId = this.getAttribute('data-category');

                if (categoryId && serviceCategorySelect) {
                    serviceCategorySelect.value = categoryId;
                }

                if (package && serviceNameInput) {
                    serviceNameInput.value = package;
                }

                if (package && messageArea) {
                    messageArea.value = `Halo Andrew.Devlog,\n\nSaya tertarik untuk memesan paket: *${package}*.\n\nBerikut rincian kebutuhan saya:\n- \n\n(Silakan lengkapi detail di atas)`;
                }
            });
        });
    });

    function previewLogo(input, previewId, placeholderId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                const preview = document.getElementById(previewId);
                const placeholder = document.getElementById(placeholderId);

                preview.src = e.target.result;
                preview.classList.remove('hidden');

                if (placeholder) {
                    placeholder.classList.add('hidden');
                }
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
