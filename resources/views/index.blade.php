@extends('layouts.app')

@section('title', setting('site_name', 'Andrew.Devlog') . ' - Jasa Pembuatan Website Profesional & Joki Coding')

@section('head')
<!-- Schema Markup -->
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

<!-- CDNs & Premium Stylings -->
<style>
  /* Custom Cursor styles */
  #custom-cursor {
    transition: transform 0.15s ease-out, background-color 0.25s ease;
  }

  /* GSAP ScrollSmoother CSS fallback and safety styles */
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
    will-change: transform;
  }

  /* Seamless Marquee Animations */
  @keyframes scrollLeft {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
  }

  @keyframes scrollRight {
    0% { transform: translateX(-50%); }
    100% { transform: translateX(0); }
  }

  .animate-scroll-left {
    animation: scrollLeft 30s linear infinite;
  }

  .animate-scroll-right {
    animation: scrollRight 30s linear infinite;
  }

  .portfolio-marquee-track {
    display: flex;
    width: max-content;
    animation: scrollLeft 45s linear infinite;
  }
</style>
@endsection

@section('content')
<div class="relative bg-slate-50 overflow-hidden min-h-screen text-slate-800">
    
    <!-- Custom Cursor -->
    <div id="custom-cursor" class="hidden md:block fixed top-0 left-0 w-8 h-8 rounded-full border border-blue-600 pointer-events-none z-[999] -translate-x-1/2 -translate-y-1/2"></div>
    <div id="custom-cursor-dot" class="hidden md:block fixed top-0 left-0 w-2 h-2 bg-blue-600 rounded-full pointer-events-none z-[999] -translate-x-1/2 -translate-y-1/2"></div>

    <!-- Background Grid Pattern -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: linear-gradient(#2563eb 1px, transparent 1px), linear-gradient(90deg, #2563eb 1px, transparent 1px); background-size: 40px 40px;"></div>
        <div class="absolute top-[-20%] left-[-10%] w-[50%] h-[50%] rounded-full bg-blue-400/10 blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] rounded-full bg-indigo-400/10 blur-[120px] pointer-events-none"></div>
    </div>

    <!-- --- HERO SECTION --- -->
    <section class="relative z-10 pt-20 pb-32 px-6 max-w-7xl mx-auto flex flex-col items-center text-center">
        <!-- Floating Badge -->
        <div class="gsap-badge inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white shadow-sm border border-slate-200/60 mb-8 transform">
            <span class="flex h-2 w-2 rounded-full bg-blue-600 animate-pulse"></span>
            <span class="text-xs font-bold text-slate-500 tracking-wider uppercase">{{ setting('hero_badge', 'Arsitek Digital Terbaik 2026') }}</span>
        </div>

        <!-- Animated Hero Title -->
        <h1 class="gsap-title text-5xl md:text-7xl font-extrabold tracking-tight leading-[1.1] text-slate-900 max-w-5xl mb-8">
            {{ setting('hero_title_1', 'Jasa Pembuatan') }} <br />
            <span class="inline-flex items-center font-normal mt-4 text-slate-800 flex-wrap justify-center gap-4">
                {{ setting('hero_title_2', 'Website & Aplikasi') }}
                <div class="px-5 py-2.5 bg-slate-900 text-white rounded-full flex items-center gap-3 transition-transform hover:scale-105 cursor-default shadow-lg shadow-slate-900/30">
                    <div class="w-6 h-6 rounded-full bg-blue-600 flex items-center justify-center">
                        <i data-lucide="terminal" class="w-3.5 h-3.5 text-white"></i>
                    </div>
                    <span class="font-extrabold tracking-wide text-xl">Joki & SEO</span>
                </div>
            </span>
        </h1>

        <!-- Subtitle -->
        <p class="gsap-subtitle text-slate-500 max-w-2xl text-lg leading-relaxed mb-12">
            {{ setting('hero_subtitle', 'Tingkatkan konversi dan visibilitas online bisnis Anda dengan website berkinerja tinggi dan solusi joki coding profesional yang terpercaya.') }}
        </p>

        <!-- Dynamic Circular Interactive Parallax Container -->
        <div class="gsap-visual relative w-full max-w-5xl h-[400px] sm:h-[500px] flex items-center justify-center mt-12">
            <div class="absolute inset-0 opacity-[0.02]" style="background-image: linear-gradient(#2563eb 1px, transparent 1px), linear-gradient(90deg, #2563eb 1px, transparent 1px); background-size: 50px 50px;"></div>
            
            <svg viewBox="0 0 1000 500" class="absolute w-full h-full opacity-[0.07] pointer-events-none">
                <path d="M 50 450 C 150 100, 850 100, 950 450" fill="none" stroke="#2563eb" stroke-width="1.5"/>
            </svg>

            <!-- Rotating Central Ring Mockup -->
            <div class="relative z-10 w-52 h-52 sm:w-64 sm:h-64 flex items-center justify-center rounded-full bg-white/40 shadow-inner backdrop-blur-sm border border-slate-200/50">
                <div class="absolute inset-0 border border-dashed border-blue-600/30 rounded-full animate-spin-slow"></div>
                <div class="absolute inset-4 border border-dashed border-slate-300 rounded-full animate-spin-reverse"></div>
                
                <div class="relative hover:scale-110 transition-transform duration-500 group cursor-pointer">
                    <img src="https://img.icons8.com/?size=160&id=ezj3zaVtImPg&format=png" alt="VS Code Logo" class="w-28 h-28 sm:w-36 sm:h-36 object-contain filter drop-shadow-xl group-hover:rotate-12 transition-transform duration-500">
                </div>
            </div>

            <!-- Floating Element: Github Logo -->
            <div class="layer-1 absolute top-[30%] left-[8%] sm:left-[12%] flex items-center justify-center transform -rotate-12 hover:rotate-0 transition-all duration-500 cursor-pointer z-20">
                <div class="w-14 h-14 bg-white rounded-2xl shadow-lg border border-slate-100 flex items-center justify-center">
                    <i data-lucide="github" class="w-8 h-8 text-slate-800"></i>
                </div>
            </div>

            <!-- Floating Element: Code Tag -->
            <div class="layer-2 absolute bottom-[20%] left-[20%] sm:left-[30%] flex items-center justify-center transform rotate-6 hover:scale-110 transition-all duration-500 cursor-pointer z-20">
                <div class="w-12 h-12 bg-white rounded-2xl shadow-lg border border-slate-100 flex items-center justify-center">
                    <i data-lucide="code" class="w-6 h-6 text-blue-600"></i>
                </div>
            </div>

            <!-- Floating Element: Hexagon -->
            <div class="layer-3 absolute bottom-[20%] right-[20%] sm:right-[30%] flex items-center justify-center transform rotate-12 hover:rotate-0 transition-all duration-500 cursor-pointer z-20">
                <div class="w-12 h-12 bg-white rounded-2xl shadow-lg border border-slate-100 flex items-center justify-center">
                    <i data-lucide="hexagon" class="w-6 h-6 text-indigo-500"></i>
                </div>
            </div>

            <!-- Floating Element: Terminal Icon -->
            <div class="layer-2 absolute top-[30%] right-[8%] sm:right-[12%] flex items-center justify-center transform hover:scale-110 transition-all duration-500 cursor-pointer z-20">
                <div class="w-14 h-14 bg-white rounded-2xl shadow-lg border border-slate-100 flex items-center justify-center">
                    <i data-lucide="terminal" class="w-7 h-7 text-indigo-600"></i>
                </div>
            </div>

            <!-- Floating Element: WhatsApp Contact Card (Top Right) -->
            <div class="layer-4 absolute top-[5%] right-[1%] sm:right-[10%] bg-white/90 backdrop-blur-md border border-slate-200/50 p-4 sm:p-5 rounded-[2rem] shadow-2xl flex items-center gap-4 z-30 transform hover:-translate-y-2 transition-transform duration-300">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('contact_phone', '+628...')) }}" class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center shadow-lg shadow-green-400/30 text-white">
                        <i data-lucide="message-circle" class="w-6 h-6"></i>
                    </div>
                    <div class="text-left">
                        <p class="text-sm sm:text-base font-extrabold text-slate-800 leading-none mb-1">Punya Project?</p>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">WhatsApp Sekarang</p>
                    </div>
                </a>
            </div>

            <!-- Floating Element: CTA Button (Top Left) -->
            <div class="layer-1 absolute top-[10%] left-[1%] sm:left-[12%] z-30">
                <div class="flex items-center gap-3">
                    <span class="text-xs sm:text-sm font-extrabold text-blue-600 uppercase tracking-widest">Konsultasi</span>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('contact_phone', '+628...')) }}" class="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center shadow-lg shadow-blue-600/30 group hover:scale-110 transition-transform duration-300">
                        <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- --- SEAMLESS PARTNERS & TECH MARQUEE --- -->
    <section class="gsap-marquee border-y border-slate-200/60 bg-white/60 backdrop-blur-md py-14 overflow-hidden relative z-10 flex flex-col gap-10">
        @php
            $partnersList = $partners->isNotEmpty() ? $partners : collect([
                (object)['name' => 'Duitku', 'logo_url' => null],
                (object)['name' => 'Firebase', 'logo_url' => null],
                (object)['name' => 'Github', 'logo_url' => null],
                (object)['name' => 'Hostinger', 'logo_url' => null],
                (object)['name' => 'Ipaymu', 'logo_url' => null],
                (object)['name' => 'Midtrans', 'logo_url' => null],
                (object)['name' => 'RajaOngkir', 'logo_url' => null],
                (object)['name' => 'Vercel', 'logo_url' => null],
            ]);

            $techList = $techs->isNotEmpty() ? $techs : collect([
                (object)['name' => 'JavaScript', 'logo_url' => null],
                (object)['name' => 'Laravel', 'logo_url' => null],
                (object)['name' => 'MySQL', 'logo_url' => null],
                (object)['name' => 'Node.js', 'logo_url' => null],
                (object)['name' => 'PHP', 'logo_url' => null],
                (object)['name' => 'phpMyAdmin', 'logo_url' => null],
                (object)['name' => 'CSS', 'logo_url' => null],
                (object)['name' => 'React', 'logo_url' => null],
                (object)['name' => 'Next.js', 'logo_url' => null],
            ]);
        @endphp

        <!-- Partner Marquee Row (Left) -->
        <div class="flex items-center gap-8 pl-6 md:pl-20">
            <div class="shrink-0 text-left">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-0.5">Dipercaya Oleh</p>
                <h4 class="text-base font-bold text-slate-800 leading-tight">Mitra<br/>Global</h4>
            </div>
            <div class="flex-1 overflow-hidden relative">
                <div class="flex items-center gap-16 w-max animate-scroll-left">
                    @foreach($partnersList->merge($partnersList) as $partner)
                        <div class="flex items-center gap-3 grayscale hover:grayscale-0 opacity-40 hover:opacity-100 transition-all duration-300 cursor-pointer">
                            @if(isset($partner->logo) && $partner->logo)
                                <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="h-6 w-auto object-contain">
                            @else
                                <div class="w-8 h-8 bg-blue-600/10 text-blue-600 rounded-xl flex items-center justify-center font-bold text-sm">
                                    {{ substr($partner->name, 0, 1) }}
                                </div>
                            @endif
                            <span class="text-xl font-bold tracking-tight text-slate-700">{{ $partner->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Tech Marquee Row (Right) -->
        <div class="flex items-center gap-8 pl-6 md:pl-20">
            <div class="flex-1 overflow-hidden relative">
                <div class="flex items-center gap-16 w-max animate-scroll-right">
                    @foreach($techList->merge($techList) as $tech)
                        <div class="flex items-center gap-3 grayscale hover:grayscale-0 opacity-40 hover:opacity-100 transition-all duration-300 cursor-pointer">
                            @if(isset($tech->logo) && $tech->logo)
                                <img src="{{ $tech->logo_url }}" alt="{{ $tech->name }}" class="h-6 w-auto object-contain">
                            @else
                                <div class="w-8 h-8 bg-slate-900/10 text-slate-900 rounded-xl flex items-center justify-center font-bold text-sm">
                                    {{ substr($tech->name, 0, 1) }}
                                </div>
                            @endif
                            <span class="text-xl font-bold tracking-tight text-slate-700">{{ $tech->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="shrink-0 text-right pr-6 md:pr-20">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-0.5">Tech Stack</p>
                <h4 class="text-base font-bold text-slate-800 leading-tight">Solusi<br/>Modern</h4>
            </div>
        </div>
    </section>

    <!-- --- 3-STEP PROCESS SECTION --- -->
    <section class="gsap-step-section py-32 bg-white relative z-10 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <!-- For Desktop: Horizontal Scroll Panel -->
            <div class="hidden md:flex flex-row items-center justify-between gap-12 min-h-[60vh] gsap-step-horizontal-wrapper relative">
                <!-- Left Sticky Side Column -->
                <div class="w-1/3 flex flex-col justify-center text-left py-12 gsap-step-left-sticky">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-50 border border-blue-100 mb-6 w-max">
                        <span class="flex h-2 w-2 rounded-full bg-blue-600 animate-pulse"></span>
                        <span class="text-[10px] font-black text-blue-600 tracking-wider uppercase">Proses Kerja</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-black text-slate-900 mb-6 tracking-tight leading-tight">
                        Gampang Banget,<br/>Cuma <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">3 Step!</span>
                    </h2>
                    <p class="text-slate-500 text-base leading-relaxed max-w-sm">
                        Dari sekadar tanya, tugas beres sampai di depan mata dengan proses yang super transparan dan efisien.
                    </p>
                    
                    <!-- Interactive step progress bar -->
                    <div class="mt-8 flex items-center gap-4 max-w-[240px]">
                        <div class="h-1 flex-1 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-600 w-0 gsap-step-progress-bar"></div>
                        </div>
                        <span class="text-xs font-bold text-slate-400 gsap-step-progress-text shrink-0">Step 1 of 3</span>
                    </div>
                </div>

                <!-- Right Scrolling Cards Container -->
                <div class="w-2/3 flex items-center overflow-x-hidden py-10 relative gsap-step-cards-scroll-container">
                    <div class="flex flex-row gap-8 pl-12 pr-32 w-max gsap-step-horizontal-track">
                        
                        <!-- Step 1 Card -->
                        <div class="gsap-step-card-horizontal w-[380px] bg-slate-50 rounded-[2.5rem] p-10 border border-slate-200/50 hover:shadow-2xl hover:shadow-blue-600/5 hover:bg-white transition-[box-shadow,border-color,background-color] duration-500 relative flex flex-col justify-between h-[360px] group">
                            <div>
                                <div class="flex items-center justify-between mb-8">
                                    <div class="w-16 h-16 bg-green-500/10 rounded-2xl flex items-center justify-center text-green-500 transition-transform group-hover:scale-110 duration-500">
                                        <i data-lucide="message-circle" class="w-8 h-8"></i>
                                    </div>
                                    <span class="text-5xl font-black text-slate-200/80 group-hover:text-green-500/20 transition-colors duration-500">01</span>
                                </div>
                                <h3 class="text-2xl font-extrabold text-slate-900 mb-4 tracking-tight">Chat & Cerita</h3>
                                <p class="text-slate-500 text-sm leading-relaxed">
                                    Beri tahu apa yang kamu butuhkan. Joki kami sudah standby menunggu cerita kamu. Ceritakan keluh kesah kodinganmu sekarang juga!
                                </p>
                            </div>
                            <div class="flex items-center gap-2 text-xs font-bold text-green-600 mt-6">
                                <span class="w-2 h-2 rounded-full bg-green-500 animate-ping"></span>
                                <span>Konsultasi Gratis via WhatsApp</span>
                            </div>
                        </div>

                        <!-- Step 2 Card -->
                        <div class="gsap-step-card-horizontal w-[380px] bg-slate-50 rounded-[2.5rem] p-10 border border-slate-200/50 hover:shadow-2xl hover:shadow-blue-600/5 hover:bg-white transition-[box-shadow,border-color,background-color] duration-500 relative flex flex-col justify-between h-[360px] group">
                            <div>
                                <div class="flex items-center justify-between mb-8">
                                    <div class="w-16 h-16 bg-blue-500/10 rounded-2xl flex items-center justify-center text-blue-600 transition-transform group-hover:scale-110 duration-500">
                                        <i data-lucide="file-text" class="w-8 h-8"></i>
                                    </div>
                                    <span class="text-5xl font-black text-slate-200/80 group-hover:text-blue-600/20 transition-colors duration-500">02</span>
                                </div>
                                <h3 class="text-2xl font-extrabold text-slate-900 mb-4 tracking-tight">Deal & Bayar</h3>
                                <p class="text-slate-500 text-sm leading-relaxed">
                                    Deal untuk harga dan bayar. Tim kami siap langsung eksekusi tanpa tapi-tapi. Mendukung berbagai metode pembayaran instan dan aman.
                                </p>
                            </div>
                            <div class="flex items-center gap-2 text-xs font-bold text-blue-600 mt-6">
                                <span>DP Ringan & Pembayaran Aman</span>
                            </div>
                        </div>

                        <!-- Step 3 Card -->
                        <div class="gsap-step-card-horizontal w-[380px] bg-slate-50 rounded-[2.5rem] p-10 border border-slate-200/50 hover:shadow-2xl hover:shadow-indigo-600/5 hover:bg-white transition-[box-shadow,border-color,background-color] duration-500 relative flex flex-col justify-between h-[360px] group">
                            <div>
                                <div class="flex items-center justify-between mb-8">
                                    <div class="w-16 h-16 bg-indigo-500/10 rounded-2xl flex items-center justify-center text-indigo-500 transition-transform group-hover:scale-110 duration-500">
                                        <i data-lucide="coffee" class="w-8 h-8"></i>
                                    </div>
                                    <span class="text-5xl font-black text-slate-200/80 group-hover:text-indigo-600/20 transition-colors duration-500">03</span>
                                </div>
                                <h3 class="text-2xl font-extrabold text-slate-900 mb-4 tracking-tight">Santai & Terima</h3>
                                <p class="text-slate-500 text-sm leading-relaxed">
                                    Duduk santai, minum kopi, tugasmu tahu-tahu beres sesuai target yang disepakati. Lengkap dengan video demo dan instruksi instalasi.
                                </p>
                            </div>
                            <div class="flex items-center gap-2 text-xs font-bold text-indigo-600 mt-6">
                                <span>Source Code & Demo Siap Kirim</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- For Mobile / Tablet: Clean Vertical Stack with Pinning Reveal -->
            <div class="flex md:hidden flex-col gap-8 gsap-step-mobile-container">
                <div class="text-center mb-6">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-50 border border-blue-100 mb-4 mx-auto">
                        <span class="flex h-2 w-2 rounded-full bg-blue-600 animate-pulse"></span>
                        <span class="text-[10px] font-black text-blue-600 tracking-wider uppercase">Proses Kerja</span>
                    </div>
                    <h2 class="text-3xl font-black text-slate-900 mb-4 tracking-tight leading-tight">
                        Gampang Banget, Cuma <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">3 Step!</span>
                    </h2>
                    <p class="text-slate-500 text-sm max-w-sm mx-auto">
                        Dari sekadar tanya, tugas beres sampai di depan mata dengan proses yang sangat mudah.
                    </p>
                </div>

                <div class="flex flex-col gap-6">
                    <!-- Step 1 Card Mobile -->
                    <div class="gsap-step-card-mobile bg-slate-50 rounded-[2rem] p-8 border border-slate-200/50 flex flex-col gap-4">
                        <div class="flex items-center justify-between">
                            <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center text-green-500">
                                <i data-lucide="message-circle" class="w-6 h-6"></i>
                            </div>
                            <span class="text-3xl font-black text-slate-200">01</span>
                        </div>
                        <h3 class="text-xl font-extrabold text-slate-900">Chat & Cerita</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">
                            Beri tahu apa yang kamu butuhkan. Joki kami sudah standby menunggu cerita kamu. Ceritakan keluh kesah kodinganmu sekarang juga!
                        </p>
                    </div>

                    <!-- Step 2 Card Mobile -->
                    <div class="gsap-step-card-mobile bg-slate-50 rounded-[2rem] p-8 border border-slate-200/50 flex flex-col gap-4">
                        <div class="flex items-center justify-between">
                            <div class="w-12 h-12 bg-blue-500/10 rounded-xl flex items-center justify-center text-blue-600">
                                <i data-lucide="file-text" class="w-6 h-6"></i>
                            </div>
                            <span class="text-3xl font-black text-slate-200">02</span>
                        </div>
                        <h3 class="text-xl font-extrabold text-slate-900">Deal & Bayar</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">
                            Deal untuk harga dan bayar. Tim kami siap langsung eksekusi tanpa tapi-tapi. Mendukung berbagai metode pembayaran instan dan aman.
                        </p>
                    </div>

                    <!-- Step 3 Card Mobile -->
                    <div class="gsap-step-card-mobile bg-slate-50 rounded-[2rem] p-8 border border-slate-200/50 flex flex-col gap-4">
                        <div class="flex items-center justify-between">
                            <div class="w-12 h-12 bg-indigo-500/10 rounded-xl flex items-center justify-center text-indigo-500">
                                <i data-lucide="coffee" class="w-6 h-6"></i>
                            </div>
                            <span class="text-3xl font-black text-slate-200">03</span>
                        </div>
                        <h3 class="text-xl font-extrabold text-slate-900">Santai & Terima</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">
                            Duduk santai, minum kopi, tugasmu tahu-tahu beres sesuai target yang disepakati. Lengkap dengan video demo dan instruksi instalasi.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- --- WHY CHOOSE US SECTION --- -->
    <section class="gsap-feature-section py-32 bg-slate-50 relative z-10 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="gsap-feature-header text-center mb-20">
                <h2 class="text-3xl md:text-5xl font-black text-slate-900 mb-4 tracking-tight">Kenapa Pilih Kita?</h2>
                <p class="text-slate-500 text-lg max-w-2xl mx-auto">Bukan cuma sekadar bayar doang. Ini alasan kamu bakal nikmatin joki dari tim kami.</p>
            </div>

            <div class="flex flex-col md:flex-row gap-8 items-start relative mt-16">
                <!-- Floating background typography element with parallax effect -->
                <div class="absolute left-1/2 top-1/3 -translate-x-1/2 -translate-y-1/2 text-slate-200/40 font-black text-[12rem] select-none pointer-events-none opacity-40 hidden lg:block gsap-why-bg-text tracking-widest" data-speed="0.5">
                    BENEFITS
                </div>

                <!-- Left Column (Standard Scroll speed) -->
                <div class="w-full md:w-1/2 flex flex-col gap-8 gsap-why-col-left">
                    <!-- Feature 1 Card -->
                    <div class="gsap-feature-card bg-white p-10 rounded-[2.5rem] border border-slate-200/60 shadow-sm hover:shadow-2xl hover:shadow-blue-600/5 transition-[box-shadow,border-color,background-color] duration-500 group relative overflow-hidden" data-lag="0.1">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50/40 rounded-bl-[10rem] z-0 pointer-events-none group-hover:scale-110 transition-transform duration-500"></div>
                        <div class="relative z-10">
                            <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center mb-6 text-blue-600 transition-transform group-hover:scale-110 duration-500">
                                <i data-lucide="code" class="w-6 h-6"></i>
                            </div>
                            <h3 class="text-xl font-extrabold text-slate-900 mb-3 tracking-tight">Kode yang Rapi & Clean</h3>
                            <p class="text-slate-500 text-sm leading-relaxed">
                                Struktur coding rapi, mudah dibaca, dan pakai standar terbaru sehingga aman untuk jangka panjang. Sangat mudah dideploy dan disesuaikan untuk kebutuhan Anda kelak.
                            </p>
                        </div>
                    </div>

                    <!-- Feature 3 Card -->
                    <div class="gsap-feature-card bg-white p-10 rounded-[2.5rem] border border-slate-200/60 shadow-sm hover:shadow-2xl hover:shadow-green-600/5 transition-[box-shadow,border-color,background-color] duration-500 group relative overflow-hidden" data-lag="0.15">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-green-50/40 rounded-bl-[10rem] z-0 pointer-events-none group-hover:scale-110 transition-transform duration-500"></div>
                        <div class="relative z-10">
                            <div class="w-14 h-14 rounded-2xl bg-green-50 flex items-center justify-center mb-6 text-green-500 transition-transform group-hover:scale-110 duration-500">
                                <i data-lucide="shield-check" class="w-6 h-6"></i>
                            </div>
                            <h3 class="text-xl font-extrabold text-slate-900 mb-3 tracking-tight">Dijamin Rahasia</h3>
                            <p class="text-slate-500 text-sm leading-relaxed">
                                Privasi data Anda aman 100%. Nama, dokumen, and source code Anda tidak akan bocor ke pihak luar, institusi, dosen, maupun kompetitor bisnis. Kepercayaan adalah komitmen utama kami.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Column (Offset Parallax Scroll speed - moves up faster) -->
                <div class="w-full md:w-1/2 flex flex-col gap-8 md:mt-16 gsap-why-col-right" data-speed="1.2">
                    <!-- Feature 2 Card -->
                    <div class="gsap-feature-card bg-white p-10 rounded-[2.5rem] border border-slate-200/60 shadow-sm hover:shadow-2xl hover:shadow-indigo-600/5 transition-[box-shadow,border-color,background-color] duration-500 group relative overflow-hidden" data-lag="0.2">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50/40 rounded-bl-[10rem] z-0 pointer-events-none group-hover:scale-110 transition-transform duration-500"></div>
                        <div class="relative z-10">
                            <div class="w-14 h-14 rounded-2xl bg-indigo-50 flex items-center justify-center mb-6 text-indigo-500 transition-transform group-hover:scale-110 duration-500">
                                <i data-lucide="zap" class="w-6 h-6"></i>
                            </div>
                            <h3 class="text-xl font-extrabold text-slate-900 mb-3 tracking-tight">Dikerjakan dengan Cepat</h3>
                            <p class="text-slate-500 text-sm leading-relaxed">
                                Deadline mepet? Tenang, tim kami terbiasa dengan jadwal yang super ngegas namun tetap mengutamakan kualitas code terbaik tanpa kompromi.
                            </p>
                        </div>
                    </div>

                    <!-- Feature 4 Card -->
                    <div class="gsap-feature-card bg-white p-10 rounded-[2.5rem] border border-slate-200/60 shadow-sm hover:shadow-2xl hover:shadow-orange-600/5 transition-[box-shadow,border-color,background-color] duration-500 group relative overflow-hidden" data-lag="0.25">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-orange-50/40 rounded-bl-[10rem] z-0 pointer-events-none group-hover:scale-110 transition-transform duration-500"></div>
                        <div class="relative z-10">
                            <div class="w-14 h-14 rounded-2xl bg-orange-50 flex items-center justify-center mb-6 text-orange-500 transition-transform group-hover:scale-110 duration-500">
                                <i data-lucide="refresh-cw" class="w-6 h-6"></i>
                            </div>
                            <h3 class="text-xl font-extrabold text-slate-900 mb-3 tracking-tight">Revisi? Gratis Dong!</h3>
                            <p class="text-slate-500 text-sm leading-relaxed">
                                Belum pas dengan ekspektasi? Tenang, kami berikan revisi penuh sesuai kesepakatan awal untuk memastikan kepuasan Anda tanpa biaya tambahan sepeser pun.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- --- PORTFOLIO SECTION --- -->
    <section id="portofolio" class="gsap-portfolio-section py-32 bg-white relative z-10 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 mb-20">
            <div class="gsap-portfolio-header text-center">
                <h2 class="text-3xl md:text-5xl font-black text-slate-900 mb-4 tracking-tight">Penasaran Sama Hasilnya?</h2>
                <p class="text-slate-500 text-lg max-w-2xl mx-auto">Cek project yang sudah kami selesaikan. Semua dibuat dengan penuh kasih sayang dan standar industri.</p>
            </div>
        </div>

        <!-- Infinite Scrolling Horizontal Portfolio Marquee -->
        <div class="relative w-full overflow-hidden py-4">
            <div class="absolute left-0 top-0 bottom-0 w-24 md:w-40 bg-gradient-to-r from-white to-transparent z-20 pointer-events-none"></div>
            <div class="absolute right-0 top-0 bottom-0 w-24 md:w-40 bg-gradient-to-l from-white to-transparent z-20 pointer-events-none"></div>

            <div class="portfolio-marquee-track gap-8 hover:[animation-play-state:paused] cursor-pointer">
                @php
                    $colors = ['from-blue-500 to-indigo-600', 'from-emerald-400 to-teal-500', 'from-orange-400 to-red-500'];
                @endphp
                @forelse($portfolios as $portfolio)
                    <a href="{{ $portfolio->url ?: '#' }}" class="group block shrink-0 w-[340px] md:w-[420px]" target="_blank" rel="noopener">
                        <div class="relative aspect-[16/10] rounded-[2.5rem] overflow-hidden bg-slate-100 mb-6 shadow-xl border border-slate-100">
                            @if($portfolio->image)
                                <img src="{{ $portfolio->image_url }}" alt="{{ $portfolio->title }}" loading="lazy" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                            @else
                                <div class="w-full h-full bg-gradient-to-br {{ $colors[$loop->index % 3] }} flex items-center justify-center">
                                    <div class="w-3/4 h-3/4 bg-white/20 backdrop-blur-md rounded-2xl border border-white/30 flex items-center justify-center">
                                        <i data-lucide="external-link" class="w-10 h-10 text-white opacity-60"></i>
                                    </div>
                                </div>
                            @endif
                            <!-- Hover Overlay -->
                            <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-all duration-500 backdrop-blur-[2px] flex items-center justify-center">
                                <div class="w-14 h-14 rounded-full bg-white text-slate-900 flex items-center justify-center text-lg transform translate-y-10 group-hover:translate-y-0 transition-all duration-500 shadow-2xl">
                                    <i data-lucide="external-link" class="w-5 h-5"></i>
                                </div>
                            </div>
                        </div>
                        <div class="px-2">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-wider">{{ $portfolio->category->name ?? 'Aplikasi' }}</span>
                                <span class="text-slate-300 text-xs">•</span>
                                <span class="text-slate-400 text-xs font-bold">{{ $portfolio->client_name ?? 'Client Partner' }}</span>
                            </div>
                            <h3 class="text-xl font-extrabold text-slate-800 mb-1 tracking-tight group-hover:text-blue-600 transition-colors whitespace-nowrap overflow-hidden text-ellipsis">{{ $portfolio->title }}</h3>
                        </div>
                    </a>
                @empty
                    <!-- React Mockups Fallback -->
                    @for($i = 1; $i <= 4; $i++)
                        <div class="group shrink-0 w-[340px] md:w-[420px]">
                            <div class="relative aspect-[16/10] rounded-[2.5rem] overflow-hidden bg-slate-100 mb-6 shadow-xl border border-slate-100">
                                <div class="w-full h-full bg-gradient-to-br {{ $colors[$i % 3] }} flex items-center justify-center">
                                    <div class="w-3/4 h-3/4 bg-white/20 backdrop-blur-md rounded-2xl border border-white/30 flex items-center justify-center">
                                        <i data-lucide="code" class="w-10 h-10 text-white opacity-60"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="px-2">
                                <div class="flex items-center gap-3 mb-3">
                                    <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-wider">Aplikasi Web</span>
                                </div>
                                <h3 class="text-xl font-extrabold text-slate-800 mb-1 tracking-tight">Karya Kreatif #{{ $i }}</h3>
                            </div>
                        </div>
                    @endfor
                @endforelse
            </div>
        </div>

        <!-- View All Button -->
        <div class="text-center mt-16">
            <a href="{{ url('/portofolio') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-slate-900 text-white rounded-2xl font-bold tracking-wide hover:bg-blue-600 transition-all duration-300 shadow-xl hover:shadow-blue-600/30 hover:scale-105 active:scale-95">
                <span>Lihat Semua Karya</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>
    </section>

    <!-- --- PRICING SECTION --- -->
    <section id="harga" class="gsap-pricing-section py-32 bg-slate-50 relative z-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="gsap-pricing-header text-center mb-20">
                <h2 class="text-3xl md:text-5xl font-black text-slate-900 mb-4 tracking-tight">Harga yang Masuk Akal</h2>
                <p class="text-slate-500 text-lg max-w-2xl mx-auto">Tenang, kantong mahasiswa bersahabat. Pilih paket yang paling cocok buat kebutuhan akademikmu.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
                @forelse($prices as $price)
                    @php
                        $isPopular = $price->is_popular;
                    @endphp
                    <div class="gsap-pricing-card bg-white rounded-[2.5rem] p-10 {{ $isPopular ? 'relative shadow-xl border-2 border-blue-500 transform md:-translate-y-4' : 'shadow-sm border border-slate-200/60' }} flex flex-col text-left hover:shadow-xl transition-all duration-500">
                        @if($isPopular)
                            <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-blue-600 text-white px-5 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest shadow-xl">
                                Paling Laris
                            </div>
                        @endif
                        <span class="text-xs font-black {{ $isPopular ? 'text-blue-600' : 'text-slate-400' }} uppercase tracking-[0.2em]">{{ $price->service_name }}</span>
                        <div class="mt-4 mb-2 text-slate-400 text-sm">Mulai dari</div>
                        <div class="text-4xl font-black text-slate-900 mb-8">Rp {{ number_format($price->price, 0, ',', '.') }}</div>
                        
                        <ul class="space-y-4 mb-8 flex-1">
                            @if(is_array($price->features))
                                @foreach($price->features as $feature)
                                    @if(trim($feature))
                                        <li class="flex items-start gap-3 {{ $isPopular ? 'text-slate-700 font-medium' : 'text-slate-500' }} text-sm leading-relaxed">
                                            <i data-lucide="check" class="w-[18px] h-[18px] text-blue-600 shrink-0 mt-0.5"></i> 
                                            <span>{{ trim($feature) }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>

                        <a href="{{ $price->is_joki ? route('joki', ['service' => $price->joki_service_slug ?: \Illuminate\Support\Str::slug($price->service_name)]) : $price->button_link }}" 
                           class="w-full py-4 rounded-2xl text-center font-bold text-sm tracking-wide {{ $isPopular ? 'bg-blue-600 text-white hover:bg-blue-700 shadow-lg shadow-blue-600/30' : 'bg-slate-50 border border-slate-200/60 text-slate-600 hover:border-slate-800 hover:text-slate-900' }} hover:scale-[1.03] transition-all duration-300">
                            {{ $price->is_popular ? 'Mulai Konsultasi' : 'Pilih Paket Ini' }}
                        </a>
                    </div>
                @empty
                    <!-- React Fallback Packages -->
                    <div class="gsap-pricing-card bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-200/60 flex flex-col text-left">
                        <span class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Tugas Kuliah</span>
                        <div class="mt-4 mb-2 text-slate-400 text-sm">Mulai dari</div>
                        <div class="text-4xl font-black text-slate-900 mb-8">Rp 150.000</div>
                        <ul class="space-y-4 mb-8 flex-1 text-sm text-slate-500">
                            <li class="flex items-start gap-3"><i data-lucide="check" class="w-[18px] h-[18px] text-blue-600 shrink-0 mt-0.5"></i> Bahasa Bebas (C++, Java, Python)</li>
                            <li class="flex items-start gap-3"><i data-lucide="check" class="w-[18px] h-[18px] text-blue-600 shrink-0 mt-0.5"></i> Flowchart & Laporan Lengkap</li>
                            <li class="flex items-start gap-3"><i data-lucide="check" class="w-[18px] h-[18px] text-blue-600 shrink-0 mt-0.5"></i> Garansi Bebas Revisi</li>
                        </ul>
                        <a href="#" class="w-full py-4 rounded-2xl text-center font-bold text-sm tracking-wide bg-slate-50 border border-slate-200/60 text-slate-600 transition-all">Pilih Paket</a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- --- TESTIMONIALS SECTION --- -->
    <section id="testimoni" class="gsap-testi-section py-32 bg-white relative z-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="gsap-testi-header text-center mb-20">
                <h2 class="text-3xl md:text-5xl font-black text-slate-900 mb-4 tracking-tight">Apa Kata Mereka?</h2>
                <p class="text-slate-500 text-lg">Kepercayaan kamu adalah segalanya bagi kami.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                @foreach($testimonials as $testi)
                    @php
                        // Alternate speeds and lags for card parallax
                        $speeds = ['0.95', '1.05', '1.0'];
                        $lags = ['0.1', '0.25', '0.15'];
                        $speed = $speeds[$loop->index % 3];
                        $lag = $lags[$loop->index % 3];
                    @endphp
                    <div class="gsap-testi-card bg-slate-50 p-10 rounded-[2.5rem] border border-slate-200/40 text-left hover:shadow-xl hover:bg-white transition-all duration-500 group" 
                         data-speed="{{ $speed }}" 
                         data-lag="{{ $lag }}">
                        <div class="flex gap-1 mb-6 text-yellow-400">
                            @for($i = 0; $i < 5; $i++)
                                <i data-lucide="star" class="w-[16px] h-[16px] fill-current"></i>
                            @endfor
                        </div>
                        <p class="text-slate-600 mb-8 text-sm leading-relaxed font-medium">"{{ $testi->content }}"</p>
                        <div class="flex items-center gap-4">
                            @if($testi->avatar_url)
                                <img src="{{ $testi->avatar_url }}" alt="{{ $testi->name }}" class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-md">
                            @else
                                <div class="w-12 h-12 bg-blue-600/10 text-blue-600 rounded-full flex items-center justify-center font-bold text-sm">
                                    {{ substr($testi->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <h4 class="font-extrabold text-slate-800 text-sm leading-none mb-1">{{ $testi->name }}</h4>
                                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">{{ $testi->position }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</div>
@endsection

@section('scripts')
<script>
    window.addEventListener("load", () => {
        // Initialize Lucide SVG Icons using the custom exposed function
        if (window.lucide) {
            window.lucide.createIcons();
        }

        // Register plugins locally in page context
        gsap.registerPlugin(ScrollTrigger, ScrollSmoother);

        // --- 1. GSAP ScrollSmoother Smooth Scrolling ---
        window.smoother = ScrollSmoother.create({
            wrapper: "#smooth-wrapper",
            content: "#smooth-content",
            smooth: 1.2,
            effects: true
        });

        // --- 2. GSAP Animations wrapped in Context (for automatic cleanup & efficiency) ---
        const ctx = gsap.context(() => {

            // Custom Premium Cursor
            const cursor = document.getElementById('custom-cursor');
            const cursorDot = document.getElementById('custom-cursor-dot');

            if (cursor && cursorDot) {
                const xToCursor = gsap.quickTo(cursor, "x", { duration: 0.1, ease: "power3" });
                const yToCursor = gsap.quickTo(cursor, "y", { duration: 0.1, ease: "power3" });
                const xToDot = gsap.quickTo(cursorDot, "x", { duration: 0.05, ease: "power3" });
                const yToDot = gsap.quickTo(cursorDot, "y", { duration: 0.05, ease: "power3" });

                document.addEventListener('mousemove', (e) => {
                    xToCursor(e.clientX);
                    yToCursor(e.clientY);
                    xToDot(e.clientX);
                    yToDot(e.clientY);
                });

                document.querySelectorAll('a, button, [role="button"], .cursor-pointer').forEach(el => {
                    el.addEventListener('mouseenter', () => {
                        gsap.to(cursor, { 
                            scale: 1.5, 
                            backgroundColor: 'rgba(37, 99, 235, 0.08)',
                            borderColor: '#2563eb',
                            duration: 0.2 
                        });
                    });
                    el.addEventListener('mouseleave', () => {
                        gsap.to(cursor, { 
                            scale: 1, 
                            backgroundColor: 'transparent',
                            borderColor: '#2563eb',
                            duration: 0.2 
                        });
                    });
                });
            }

            // --- 3. Interactive Mouse Parallax (Hero Visual) ---
            const layers = [".layer-1", ".layer-2", ".layer-3", ".layer-4"];
            const hasLayers = layers.every(selector => document.querySelector(selector) !== null);
            
            if (hasLayers) {
                const xTo1 = gsap.quickTo(".layer-1", "x", { duration: 0.8, ease: "power3" });
                const yTo1 = gsap.quickTo(".layer-1", "y", { duration: 0.8, ease: "power3" });
                
                const xTo2 = gsap.quickTo(".layer-2", "x", { duration: 0.8, ease: "power3" });
                const yTo2 = gsap.quickTo(".layer-2", "y", { duration: 0.8, ease: "power3" });
                
                const xTo3 = gsap.quickTo(".layer-3", "x", { duration: 0.8, ease: "power3" });
                const yTo3 = gsap.quickTo(".layer-3", "y", { duration: 0.8, ease: "power3" });
                
                const xTo4 = gsap.quickTo(".layer-4", "x", { duration: 0.8, ease: "power3" });
                const yTo4 = gsap.quickTo(".layer-4", "y", { duration: 0.8, ease: "power3" });

                document.addEventListener('mousemove', (e) => {
                    const x = (e.clientX / window.innerWidth - 0.5) * 2;
                    const y = (e.clientY / window.innerHeight - 0.5) * 2;
                    
                    xTo1(x * 15); yTo1(y * 15);
                    xTo2(x * 30); yTo2(y * 30);
                    xTo3(x * 45); yTo3(y * 45);
                    xTo4(x * -20); yTo4(y * -20);
                });
            }

            // --- 4. Entrance & Scroll GSAP Animations ---
            if (document.querySelector(".gsap-badge")) {
                const tl = gsap.timeline();
                tl.from(".gsap-badge", { y: 20, opacity: 0, duration: 0.6, ease: "power3.out" });
                if (document.querySelector(".gsap-title")) {
                    tl.from(".gsap-title", { y: 30, opacity: 0, duration: 0.8, ease: "power3.out" }, "-=0.4");
                }
                if (document.querySelector(".gsap-subtitle")) {
                    tl.from(".gsap-subtitle", { y: 20, opacity: 0, duration: 0.6, ease: "power3.out" }, "-=0.4");
                }
                if (document.querySelector(".gsap-visual")) {
                    tl.from(".gsap-visual", { scale: 0.9, opacity: 0, duration: 1, ease: "elastic.out(1, 0.75)" }, "-=0.4");
                }
            }

            // --- 5. Step Section Pinned Horizontal Scroll & Mobile reveals ---
            if (window.innerWidth >= 768) {
                const track = document.querySelector(".gsap-step-horizontal-track");
                const wrapper = document.querySelector(".gsap-step-horizontal-wrapper");
                
                if (track && wrapper) {
                    const tlSteps = gsap.timeline({
                        scrollTrigger: {
                            trigger: ".gsap-step-section",
                            pin: true,
                            start: "center center",
                            end: () => `+=${track.scrollWidth - wrapper.offsetWidth + 200}`,
                            scrub: 1,
                            invalidateOnRefresh: true,
                            onUpdate: (self) => {
                                const progress = self.progress;
                                
                                // Update progress text only when it changes
                                let currentStep = 1;
                                if (progress > 0.66) {
                                    currentStep = 3;
                                } else if (progress > 0.33) {
                                    currentStep = 2;
                                }
                                const progressText = document.querySelector(".gsap-step-progress-text");
                                if (progressText && progressText.innerText !== `Step ${currentStep} of 3`) {
                                    progressText.innerText = `Step ${currentStep} of 3`;
                                }
                            }
                        }
                    });

                    // Horizontal scrolling track tween
                    tlSteps.to(track, {
                        x: () => -(track.scrollWidth - wrapper.offsetWidth + 120),
                        ease: "none"
                    }, 0);

                    // Dynamic progress bar synchronized directly (zero overhead)
                    if (document.querySelector(".gsap-step-progress-bar")) {
                        tlSteps.to(".gsap-step-progress-bar", {
                            width: "100%",
                            ease: "none"
                        }, 0);
                    }

                    // Subtle entrance for individual horizontal cards
                    if (document.querySelector(".gsap-step-card-horizontal")) {
                        gsap.from(".gsap-step-card-horizontal", {
                            opacity: 0,
                            y: 40,
                            scale: 0.95,
                            duration: 0.8,
                            stagger: 0.1,
                            ease: "power3.out",
                            scrollTrigger: {
                                trigger: ".gsap-step-section",
                                start: "top 60%",
                            }
                        });
                    }
                }
            } else {
                // Mobile entrance animation
                if (document.querySelector(".gsap-step-card-mobile")) {
                    gsap.from(".gsap-step-card-mobile", {
                        scrollTrigger: {
                            trigger: ".gsap-step-mobile-container",
                            start: "top 80%"
                        },
                        y: 50,
                        opacity: 0,
                        duration: 0.8,
                        stagger: 0.15,
                        ease: "power3.out"
                    });
                }
            }

            // --- 6. Features Section Staggered Parallax & Reveals ---
            if (window.innerWidth >= 768) {
                // Clean entrance for features
                if (document.querySelector(".gsap-feature-card")) {
                    gsap.from(".gsap-feature-card", {
                        scrollTrigger: {
                            trigger: ".gsap-feature-section",
                            start: "top 75%"
                        },
                        y: 40,
                        opacity: 0,
                        duration: 0.8,
                        stagger: 0.1,
                        ease: "power3.out"
                    });
                }
            } else {
                // Mobile standard reveals
                if (document.querySelector(".gsap-feature-card")) {
                    gsap.from(".gsap-feature-card", {
                        scrollTrigger: {
                            trigger: ".gsap-feature-section",
                            start: "top 80%"
                        },
                        y: 40,
                        opacity: 0,
                        duration: 0.8,
                        stagger: 0.15,
                        ease: "power3.out"
                    });
                }
            }

            // --- 7. Portfolio Section - Infinite Scroll & Velocity-Driven Marquee ---
            const marqueeTrack = document.querySelector(".portfolio-marquee-track");
            if (marqueeTrack) {
                // Clone track children to make infinite scrolling seamless
                const items = Array.from(marqueeTrack.children);
                items.forEach(item => {
                    const clone = item.cloneNode(true);
                    marqueeTrack.appendChild(clone);
                });

                // Disable the CSS fallback animation so GSAP can take over cleanly
                gsap.set(marqueeTrack, { animation: "none" });

                // Create infinite linear marquee timeline
                const marqueeLoop = gsap.to(marqueeTrack, {
                    xPercent: -50,
                    ease: "none",
                    duration: 35, // speed of continuous scroll
                    repeat: -1
                });

                // Accelerate the marquee dynamically based on user scroll velocity!
                ScrollTrigger.create({
                    trigger: ".gsap-portfolio-section",
                    start: "top bottom",
                    end: "bottom top",
                    onUpdate: (self) => {
                        let velocity = self.getVelocity() * 0.005;
                        velocity = gsap.utils.clamp(-5, 5, velocity);
                        
                        // Dynamically scale timeScale of the marquee loop
                        gsap.to(marqueeLoop, {
                            timeScale: 1 + Math.abs(velocity),
                            duration: 0.4,
                            ease: "power2.out",
                            overwrite: "auto"
                        });
                    }
                });
            }

            // --- 8. Premium Header entrance animations with Stagger ---
            [".gsap-portfolio-header", ".gsap-pricing-header", ".gsap-testi-header"].forEach(selector => {
                const el = document.querySelector(selector);
                if (el) {
                    gsap.from(el.children, {
                        scrollTrigger: {
                            trigger: el,
                            start: "top 85%"
                        },
                        y: 30,
                        opacity: 0,
                        duration: 0.8,
                        stagger: 0.15,
                        ease: "power3.out"
                    });
                }
            });

            // --- 9. Pricing Section - 3D Hover Tilt & Card Float Entrance ---
            if (document.querySelector(".gsap-pricing-card")) {
                gsap.from(".gsap-pricing-card", {
                    scrollTrigger: {
                        trigger: ".gsap-pricing-header",
                        start: "top 90%"
                    },
                    y: 50,
                    opacity: 0,
                    duration: 0.8,
                    stagger: 0.15,
                    ease: "power3.out",
                    onComplete: () => {
                        // Start continuous hover/float on popular card once entrance is done
                        const popularCard = document.querySelector(".gsap-pricing-card.border-blue-500");
                        if (popularCard) {
                            gsap.to(popularCard, {
                                y: "-=8",
                                duration: 2,
                                ease: "sine.inOut",
                                repeat: -1,
                                yoyo: true
                            });
                        }
                    }
                });

                // 3D Hover Tilt Effect
                document.querySelectorAll(".gsap-pricing-card").forEach(card => {
                    card.addEventListener("mousemove", (e) => {
                        const rect = card.getBoundingClientRect();
                        const x = e.clientX - rect.left - rect.width / 2;
                        const y = e.clientY - rect.top - rect.height / 2;
                        
                        gsap.to(card, {
                            rotateY: x * 0.04,
                            rotateX: -y * 0.04,
                            scale: 1.02,
                            transformPerspective: 1000,
                            ease: "power2.out",
                            duration: 0.4,
                            overwrite: "auto"
                        });
                    });
                    
                    card.addEventListener("mouseleave", () => {
                        gsap.to(card, {
                            rotateY: 0,
                            rotateX: 0,
                            scale: 1,
                            ease: "power2.out",
                            duration: 0.4,
                            overwrite: "auto"
                        });
                    });
                });
            }

            // --- 10. Testimonials Section - Card Parallax Entrance ---
            if (document.querySelector(".gsap-testi-card")) {
                gsap.from(".gsap-testi-card", {
                    scrollTrigger: {
                        trigger: ".gsap-testi-header",
                        start: "top 90%"
                    },
                    scale: 0.95,
                    opacity: 0,
                    duration: 0.8,
                    stagger: 0.15,
                    ease: "power3.out"
                });
            }

            // Always call ScrollTrigger.refresh() after all triggers and pins are set up
            ScrollTrigger.refresh();
        });

        // Cleanup function for GSAP context
        window.addEventListener("unload", () => ctx.revert());
    });
</script>
@endsection
