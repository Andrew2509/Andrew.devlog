@extends('layouts.app')

@section('title', setting('site_name', 'Andrew.Devlog') . ' - Jasa Pembuatan Website Profesional & SEO')

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
                        DEFAULT: '#0ea5e9',
                        light: '#38bdf8',
                        dark: '#0369a1',
                        50: '#f0f9ff',
                        100: '#e0effe',
                    }
                },
                animation: {
                    'blob': 'blob 7s infinite',
                    'float': 'float 6s ease-in-out infinite',
                    'pulse-soft': 'pulse-soft 2s infinite',
                },
                keyframes: {
                    blob: {
                        '0%': { transform: 'translate(0px, 0px) scale(1)' },
                        '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                        '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                        '100%': { transform: 'translate(0px, 0px) scale(1)' },
                    },
                    float: {
                        '0%, 100%': { transform: 'translateY(0)' },
                        '50%': { transform: 'translateY(-20px)' },
                    },
                    'pulse-soft': {
                        '0%': { boxShadow: '0 0 0 0 rgba(0, 86, 179, 0.4)', transform: 'scale(1)' },
                        '70%': { boxShadow: '0 0 0 15px rgba(0, 86, 179, 0)', transform: 'scale(1.02)' },
                        '100%': { boxShadow: '0 0 0 0 rgba(0, 86, 179, 0)', transform: 'scale(1)' },
                    }
                }
            }
        }
    }
</script>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="hero-{{ strtolower(setting('site_name', 'andrew.devlog')) }} relative overflow-hidden pt-28 pb-16 lg:pt-32 lg:pb-24 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('assets/image/Backround.png') }}');">
        <!-- Decorative Blobs -->
        <div class="absolute top-0 left-0 w-72 h-72 bg-primary rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob"></div>
        <div class="absolute top-0 right-20 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-8 items-center">
                <!-- Text Content -->
                <div class="text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white text-primary text-sm font-semibold mb-6 shadow-sm border border-primary-100 animate-text-reveal" style="animation-delay: 0.1s;">
                        <i class="fas fa-rocket"></i> {{ setting('hero_badge', 'Arsitek Digital Terbaik 2026') }}
                    </div>

                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight mb-6 tracking-tight">
                        <span class="block overflow-hidden pb-1"><span class="animate-text-reveal" style="animation-delay: 0.2s;">{{ setting('hero_title_1', 'Jasa Pembuatan') }}</span></span>
                        <span class="block overflow-hidden pb-1"><span class="animate-text-reveal text-primary" style="animation-delay: 0.4s;">{{ setting('hero_title_2', 'Website Profesional') }}</span></span>
                        <span class="block overflow-hidden pb-1"><span class="animate-text-reveal" style="animation-delay: 0.6s;">{{ setting('hero_title_3', '& SEO') }}</span></span>
                    </h1>

                    <p class="text-base sm:text-xl text-gray-600 mb-8 max-w-2xl mx-auto lg:mx-0 leading-relaxed overflow-hidden">
                        <span class="animate-text-reveal block" style="animation-delay: 0.8s;">
                            {{ setting('hero_subtitle', 'Tingkatkan konversi dan visibilitas online bisnis Anda dengan website berkinerja tinggi dan strategi pemasaran digital yang terbukti. Saya hadir untuk mewujudkan visi digital Anda.') }}
                        </span>
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start overflow-hidden pt-2 pb-4">
                        <div class="animate-text-reveal" style="animation-delay: 1s;">
                            <a href="#harga" class="bg-primary hover:bg-primary-dark text-white text-base sm:text-lg px-6 py-3.5 sm:px-8 sm:py-4 rounded-full font-semibold transition-all shadow-lg flex items-center justify-center gap-2 animate-pulse-soft relative z-10">
                                Lihat Paket Harga <i class="fas fa-arrow-right text-sm"></i>
                            </a>
                        </div>
                        <div class="animate-text-reveal" style="animation-delay: 1.1s;">
                            <a href="#layanan" class="bg-white hover:bg-gray-50 text-gray-800 border border-gray-200 text-base sm:text-lg px-6 py-3.5 sm:px-8 sm:py-4 rounded-full font-semibold transition-all flex items-center justify-center gap-2 hover:-translate-y-1">
                                Pelajari Layanan
                            </a>
                        </div>
                    </div>

                    <div class="mt-8 flex items-center justify-center lg:justify-start gap-4 text-xs sm:text-sm text-gray-500 font-medium overflow-hidden">
                        <span class="animate-text-reveal flex items-center gap-1" style="animation-delay: 1.2s;">
                            <i class="fas fa-check-circle text-green-500"></i> Gratis SSL
                        </span>
                        <span class="animate-text-reveal flex items-center gap-1" style="animation-delay: 1.3s;">
                            <i class="fas fa-check-circle text-green-500"></i> Support 24/7
                        </span>
                        <span class="animate-text-reveal flex items-center gap-1" style="animation-delay: 1.4s;">
                            <i class="fas fa-check-circle text-green-500"></i> Garansi SEO
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trusted By -->
    <section class="py-10 border-b border-gray-100 bg-white overflow-hidden marquee-wrapper">
        {{-- <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
            <p class="text-center text-sm font-semibold text-gray-400 uppercase tracking-wider">Dipercaya oleh Perusahaan Terkemuka</p>
        </div> --}}
        <div class="relative w-full overflow-hidden">
            <div class="marquee-container flex flex-nowrap gap-8 md:gap-16 px-8 items-center">
                @foreach($clients as $client)
                <div class="flex items-center gap-4 text-2xl md:text-3xl font-bold text-gray-800 opacity-60 grayscale hover:grayscale-0 hover:opacity-100 cursor-pointer transition-all duration-300">
                    <img src="{{ $client->logo_url }}" alt="{{ $client->name }}" class="h-10 md:h-12 w-auto object-contain">
                    <span>{{ $client->name }}</span>
                </div>
                @endforeach
                {{-- Duplicate for seamless marquee --}}
                @foreach($clients as $client)
                <div class="flex items-center gap-4 text-2xl md:text-3xl font-bold text-gray-800 opacity-60 grayscale hover:grayscale-0 hover:opacity-100 cursor-pointer transition-all duration-300">
                    <img src="{{ $client->logo_url }}" alt="{{ $client->name }}" class="h-10 md:h-12 w-auto object-contain">
                    <span>{{ $client->name }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Kenapa Memilih Saya -->
    <section id="keunggulan" class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in-up-element" style="transition-delay: 0.1s;">
                <h2 class="text-primary font-bold tracking-wide uppercase text-sm mb-2">Keunggulan Saya</h2>
                <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">Kenapa Memilih {{ setting('site_name', 'Andrew.Devlog') }}?</h3>
                <p class="text-gray-600 text-lg">Saya tidak hanya membuat website, saya membangun aset digital yang menghasilkan pertumbuhan nyata untuk bisnis Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="fade-in-up-element bg-gray-50 rounded-2xl p-6 md:p-8 hover:-translate-y-3 transition-transform duration-300 border border-gray-100 hover:shadow-2xl hover:shadow-primary/10 group cursor-default" style="transition-delay: 0.2s;">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-primary-100 rounded-2xl flex items-center justify-center text-primary text-2xl md:text-3xl mb-6 group-hover:bg-primary group-hover:text-white group-hover:scale-110 transition-all duration-300">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h4 class="text-lg md:text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors">Kecepatan Maksimal</h4>
                    <p class="text-gray-600 leading-relaxed text-sm md:text-base">Website dioptimalkan untuk loading secepat kilat, memberikan pengalaman pengguna terbaik.</p>
                </div>
                <div class="fade-in-up-element bg-gray-50 rounded-2xl p-6 md:p-8 hover:-translate-y-3 transition-transform duration-300 border border-gray-100 hover:shadow-2xl hover:shadow-primary/10 group cursor-default" style="transition-delay: 0.4s;">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-primary-100 rounded-2xl flex items-center justify-center text-primary text-2xl md:text-3xl mb-6 group-hover:bg-primary group-hover:text-white group-hover:scale-110 transition-all duration-300">
                        <i class="fas fa-search"></i>
                    </div>
                    <h4 class="text-lg md:text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors">100% SEO Friendly</h4>
                    <p class="text-gray-600 leading-relaxed text-sm md:text-base">Struktur, meta tag, dan kode dirancang khusus untuk memenuhi standar Google.</p>
                </div>
                <div class="fade-in-up-element bg-gray-50 rounded-2xl p-6 md:p-8 hover:-translate-y-3 transition-transform duration-300 border border-gray-100 hover:shadow-2xl hover:shadow-primary/10 group cursor-default" style="transition-delay: 0.6s;">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-primary-100 rounded-2xl flex items-center justify-center text-primary text-2xl md:text-3xl mb-6 group-hover:bg-primary group-hover:text-white group-hover:scale-110 transition-all duration-300">
                        <i class="fas fa-tags"></i>
                    </div>
                    <h4 class="text-lg md:text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors">Harga Terjangkau</h4>
                    <p class="text-gray-600 leading-relaxed text-sm md:text-base">Kualitas premium skala korporat dengan paket harga yang transparan dan kompetitif.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Detail Layanan Saya -->
    <section id="layanan" class="py-24 bg-gray-50 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in-up-element">
                <h2 class="text-primary font-bold tracking-wide uppercase text-sm mb-2">Layanan Saya</h2>
                <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">Solusi Digital Komprehensif</h3>
                <p class="text-gray-600 text-lg">Semua yang Anda butuhkan untuk mendominasi era digital.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Service 1 -->
                <div class="fade-in-up-element bg-white rounded-3xl p-6 md:p-10 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 relative overflow-hidden group cursor-pointer" style="transition-delay: 0.1s;">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary-50 rounded-bl-full -z-10 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="flex items-start gap-5 md:gap-6 mb-6">
                        <div class="w-14 h-14 md:w-16 md:h-16 rounded-2xl bg-primary text-white flex items-center justify-center text-2xl md:text-3xl flex-shrink-0 group-hover:rotate-12 transition-transform">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <div>
                            <h4 class="text-xl md:text-2xl font-bold text-gray-900 mb-2 group-hover:text-primary transition-colors">Web Design & Dev</h4>
                            <p class="text-gray-600 leading-relaxed text-sm md:text-base">Membangun representasi online bisnis Anda dengan desain estetis yang cepat dan responsif.</p>
                        </div>
                    </div>
                    <hr class="border-gray-100 my-6">
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center gap-3 text-gray-700 font-medium">
                            <div class="w-6 h-6 rounded-full bg-green-100 text-green-500 flex items-center justify-center text-xs flex-shrink-0"><i class="fas fa-check"></i></div>
                            Desain Responsif (Mobile-Friendly)
                        </li>
                        <li class="flex items-center gap-3 text-gray-700 font-medium">
                            <div class="w-6 h-6 rounded-full bg-green-100 text-green-500 flex items-center justify-center text-xs flex-shrink-0"><i class="fas fa-check"></i></div>
                            Sertifikat SSL Gratis (Keamanan)
                        </li>
                    </ul>
                </div>

                <!-- Service 2 -->
                <div class="fade-in-up-element bg-white rounded-3xl p-6 md:p-10 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 relative overflow-hidden group cursor-pointer" style="transition-delay: 0.2s;">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary-50 rounded-bl-full -z-10 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="flex items-start gap-5 md:gap-6 mb-6">
                        <div class="w-14 h-14 md:w-16 md:h-16 rounded-2xl bg-primary text-white flex items-center justify-center text-2xl md:text-3xl flex-shrink-0 group-hover:rotate-12 transition-transform">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div>
                            <h4 class="text-xl md:text-2xl font-bold text-gray-900 mb-2 group-hover:text-primary transition-colors">SEO Optimization</h4>
                            <p class="text-gray-600 leading-relaxed text-sm md:text-base">Mendominasi halaman pertama mesin pencari Google.</p>
                        </div>
                    </div>
                    <hr class="border-gray-100 my-6">
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center gap-3 text-gray-700 font-medium">
                            <div class="w-6 h-6 rounded-full bg-green-100 text-green-500 flex items-center justify-center text-xs flex-shrink-0"><i class="fas fa-check"></i></div>
                            Riset Keyword Akurat
                        </li>
                        <li class="flex items-center gap-3 text-gray-700 font-medium">
                            <div class="w-6 h-6 rounded-full bg-green-100 text-green-500 flex items-center justify-center text-xs flex-shrink-0"><i class="fas fa-check"></i></div>
                            Optimasi On-Page & Off-Page
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

    <!-- Proses Kerja -->
    <section id="proses-kerja" class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-20 fade-in-up-element">
                <h2 class="text-primary font-bold tracking-wide uppercase text-sm mb-2">Bagaimana Saya Bekerja</h2>
                <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">Proses Kerja yang Transparan</h3>
                <p class="text-gray-600 text-lg">Langkah demi langkah terstruktur dari awal hingga peluncuran.</p>
            </div>

            <!-- Steps Grid -->
            <div class="relative">
                <div class="hidden md:block absolute top-12 left-[12%] right-[12%] h-1 bg-gradient-to-r from-primary-100 via-primary to-primary-100 z-0"></div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 relative z-10">
                    <div class="fade-in-up-element flex flex-col items-center text-center group" style="transition-delay: 0.1s;">
                        <div class="w-20 h-20 md:w-24 md:h-24 bg-white rounded-full border-4 border-primary-50 shadow-xl flex items-center justify-center relative mb-6 group-hover:-translate-y-2 transition-transform duration-300">
                            <div class="absolute -top-2 -right-2 w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center font-bold text-sm shadow-md">1</div>
                            <i class="fas fa-comments text-3xl md:text-4xl text-primary"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Konsultasi</h4>
                        <p class="text-gray-600 text-sm leading-relaxed">Berdiskusi untuk memahami visi dan target audiens Anda.</p>
                    </div>

                    <div class="fade-in-up-element flex flex-col items-center text-center group" style="transition-delay: 0.2s;">
                        <div class="w-20 h-20 md:w-24 md:h-24 bg-white rounded-full border-4 border-primary-50 shadow-xl flex items-center justify-center relative mb-6 group-hover:-translate-y-2 transition-transform duration-300">
                            <div class="absolute -top-2 -right-2 w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center font-bold text-sm shadow-md">2</div>
                            <i class="fas fa-pen-nib text-3xl md:text-4xl text-primary"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Desain</h4>
                        <p class="text-gray-600 text-sm leading-relaxed">Pembuatan wireframe dan rancangan UI/UX visual yang estetis.</p>
                    </div>

                    <div class="fade-in-up-element flex flex-col items-center text-center group" style="transition-delay: 0.3s;">
                        <div class="w-20 h-20 md:w-24 md:h-24 bg-white rounded-full border-4 border-primary-50 shadow-xl flex items-center justify-center relative mb-6 group-hover:-translate-y-2 transition-transform duration-300">
                            <div class="absolute -top-2 -right-2 w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center font-bold text-sm shadow-md">3</div>
                            <i class="fas fa-code text-3xl md:text-4xl text-primary"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Development</h4>
                        <p class="text-gray-600 text-sm leading-relaxed">Saya mengubah desain menjadi website fungsional.</p>
                    </div>

                    <div class="fade-in-up-element flex flex-col items-center text-center group" style="transition-delay: 0.4s;">
                        <div class="w-20 h-20 md:w-24 md:h-24 bg-white rounded-full border-4 border-primary-50 shadow-xl flex items-center justify-center relative mb-6 group-hover:-translate-y-2 transition-transform duration-300">
                            <div class="absolute -top-2 -right-2 w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center font-bold text-sm shadow-md">4</div>
                            <i class="fas fa-rocket text-3xl md:text-4xl text-primary"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Launching</h4>
                        <p class="text-gray-600 text-sm leading-relaxed">Optimasi server dan peluncuran website.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Portofolio -->
    <section id="portofolio" class="py-24 bg-gray-50 overflow-hidden border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-row justify-between items-end gap-4 mb-12 fade-in-up-element">
                <div class="text-left max-w-[70%]">
                    <h2 class="text-primary font-bold tracking-wide uppercase text-xs mb-1">Karya Saya</h2>
                    <h3 class="text-2xl md:text-4xl font-extrabold text-gray-900 mb-2">Portofolio Proyek</h3>
                    <p class="text-gray-600 text-sm md:text-lg hidden sm:block">Solusi digital pilihan saya.</p>
                </div>
                <div class="flex-shrink-0 mb-1">
                    <a href="{{ url('/portofolio') }}" class="inline-flex items-center gap-2 bg-white text-primary border border-primary hover:bg-primary hover:text-white px-4 md:px-8 py-2 md:py-3 rounded-full font-bold text-xs md:text-base transition-all shadow-sm group">
                        <span class="hidden md:inline">Lihat Semua</span>
                        <span class="md:hidden">Semua</span>
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="portfolio-grid">
                @forelse($portfolios as $portfolio)
                <div class="portfolio-item fade-in-up-element group relative overflow-hidden rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-500 bg-white" style="transition-delay: {{ 0.2 + ($loop->index * 0.1) }}s;">
                    <div class="w-full h-72">
                        <img src="{{ asset('storage/' . $portfolio->image) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-8">
                        <span class="text-primary-100 font-semibold text-sm mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">{{ $portfolio->category }}</span>
                        <h4 class="text-white text-2xl font-bold mb-6 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-75">{{ $portfolio->title }}</h4>
                        <a href="{{ $portfolio->link ?? '#' }}" target="{{ $portfolio->link ? '_blank' : '_self' }}" class="inline-flex items-center justify-center bg-primary hover:bg-primary-light text-white px-6 py-2.5 rounded-full font-medium transition-colors w-max transform translate-y-4 group-hover:translate-y-0 duration-500 delay-100 shadow-lg">
                            Lihat Website <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 py-20 text-center">
                    <p class="text-gray-500 font-bold uppercase tracking-widest italic">Belum ada portofolio unggulan.</p>
                </div>
                @endforelse
            </div>

            <!-- Mobile View More Button -->
            <div class="mt-12 text-center md:hidden fade-in-up-element">
                <a href="{{ url('/portofolio') }}" class="inline-flex items-center gap-3 bg-white text-primary border-2 border-primary hover:bg-primary hover:text-white px-10 py-4 rounded-full font-bold text-lg transition-all shadow-lg hover:shadow-primary/20 group">
                    Lihat Semua Portofolio
                    <i class="fas fa-arrow-right group-hover:translate-x-2 transition-transform"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Daftar Harga (Pricing Table) -->
    <section id="harga" class="py-24 bg-gray-50 border-y border-gray-100 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-12 fade-in-up-element" style="transition-delay: 0.2s;">
                <div class="text-center md:text-left max-w-2xl">
                    <h2 class="text-primary font-bold tracking-wide uppercase text-sm mb-2">Daftar Harga</h2>
                    <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">Pilih Paket Sesuai Kebutuhan</h3>
                    <p class="text-gray-600 text-lg">Investasi terbaik untuk pertumbuhan digital bisnis Anda.</p>
                </div>
                <div class="flex-shrink-0">
                    <a href="{{ url('/harga') }}" class="inline-flex items-center gap-2 bg-white hover:bg-primary hover:text-white text-primary border-2 border-primary px-6 py-3 rounded-full font-bold text-sm transition-all shadow-md hover:shadow-primary/20 hover:-translate-y-1 group">
                        <i class="fas fa-tags group-hover:scale-110 transition-transform"></i> Lihat Semua Harga <i class="fas fa-chevron-right text-xs group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-6xl mx-auto items-center">
                @forelse($prices as $price)
                <div class="fade-in-up-element bg-{{ $price->is_popular ? 'primary' : 'white' }} rounded-3xl p-6 md:p-8 lg:p-10 border border-{{ $price->is_popular ? 'primary-dark' : 'gray-200' }} shadow-{{ $price->is_popular ? '2xl' : 'sm' }} relative {{ $price->is_popular ? 'transform lg:-translate-y-6 z-10' : 'hover:shadow-xl' }} transition-all duration-300" style="transition-delay: {{ 0.1 + ($loop->index * 0.1) }}s;">
                    @if($price->is_popular)
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-yellow-400 to-yellow-500 text-yellow-900 px-6 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest shadow-lg flex items-center gap-2">
                        <i class="fas fa-star"></i> Paling Populer
                    </div>
                    @endif
                    <div class="mb-4">
                        <h4 class="text-lg font-bold {{ $price->is_popular ? 'text-white' : 'text-gray-900' }} uppercase tracking-tight">{{ $price->service_name }}</h4>
                    </div>
                    <div class="mb-6 {{ $price->is_popular ? 'text-white' : 'text-gray-900' }}">
                        <span class="text-2xl {{ $price->is_popular ? 'lg:text-3xl' : '' }} font-extrabold">Rp {{ number_format($price->price, 0, ',', '.') }}</span>
                    </div>
                    <ul class="space-y-4 mb-10 {{ $price->is_popular ? 'text-white' : 'text-gray-700' }}">
                        @foreach($price->features as $feature)
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle {{ $price->is_popular ? 'text-yellow-400' : 'text-green-500' }} mt-1"></i> <span>{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                    <a href="#kontak" data-package="{{ $price->service_name }}" data-category="{{ $price->service_category_id }}" class="pricing-btn block w-full text-center {{ $price->is_popular ? 'bg-white text-primary hover:bg-gray-50' : 'bg-white text-primary border-2 border-primary hover:bg-primary hover:text-white' }} text-base md:text-lg py-3 rounded-full font-bold transition-all {{ $price->is_popular ? 'hover:shadow-lg hover:-translate-y-1' : '' }}">
                        {{ $price->button_text }}
                    </a>
                </div>
                @empty
                <div class="col-span-1 lg:col-span-3 py-20 text-center">
                    <p class="text-gray-500 font-bold uppercase tracking-widest italic">Belum ada paket harga yang tersedia.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-primary text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 fade-in-up-element">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center divide-y md:divide-y-0 md:divide-x divide-white/20">
                <div class="py-6 md:py-0">
                    <div class="text-4xl md:text-6xl font-extrabold mb-2 flex justify-center items-center drop-shadow-lg">
                        @php
                            $projects = setting('stats_projects', '2500+');
                            $projectsNum = preg_replace('/[^0-9]/', '', $projects);
                        @endphp
                        <span class="counter" data-target="{{ $projectsNum }}">{{ $projectsNum }}</span><span class="text-primary-100">{{ str_replace($projectsNum, '', $projects) ?: '+' }}</span>
                    </div>
                    <p class="text-primary-100 text-lg font-medium tracking-wide">Project Selesai</p>
                </div>
                <div class="py-6 md:py-0">
                    <div class="text-4xl md:text-6xl font-extrabold mb-2 flex justify-center items-center drop-shadow-lg">
                        @php
                            $clients = setting('stats_clients', '1500+');
                            $clientsNum = preg_replace('/[^0-9]/', '', $clients);
                        @endphp
                        <span class="counter" data-target="{{ $clientsNum }}">{{ $clientsNum }}</span><span class="text-primary-100">{{ str_replace($clientsNum, '', $clients) ?: '+' }}</span>
                    </div>
                    <p class="text-primary-100 text-lg font-medium tracking-wide">Klien Puas</p>
                </div>
                <div class="py-6 md:py-0">
                    <div class="text-5xl md:text-6xl font-extrabold mb-2 flex justify-center items-center drop-shadow-lg">
                        @php
                            $experience = setting('stats_experience', '10+');
                            $experienceNum = preg_replace('/[^0-9]/', '', $experience);
                        @endphp
                        <span class="counter" data-target="{{ $experienceNum }}">{{ $experienceNum }}</span><span class="text-primary-100">{{ str_replace($experienceNum, '', $experience) ?: '+' }}</span>
                    </div>
                    <p class="text-primary-100 text-lg font-medium tracking-wide">Tahun Pengalaman</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni -->
    <section id="testimoni" class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in-up-element">
                <h2 class="text-primary font-bold tracking-wide uppercase text-sm mb-2">Testimoni</h2>
                <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">Apa Kata Klien Saya?</h3>
                <p class="text-gray-600 text-lg">Keberhasilan klien adalah prioritas utama saya.</p>
            </div>

            <!-- Elfsight Google Reviews Widget -->
            <div class="fade-in-up-element relative" style="transition-delay: 0.2s;">
                <div class="overflow-hidden" style="max-height: 580px;">
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/iframe-resizer/4.2.10/iframeResizer.min.js"></script>
                    <iframe onload="iFrameResize(this)" src="{{ setting('google_reviews_iframe', 'https://5d994d31ef99443986d2ad9bf3283ff9.elf.site') }}" style="border:none;width:100%; min-height: 500px;"></iframe>
                </div>
                <!-- Masking bottom banner if it still appears -->
                <div class="absolute bottom-0 left-0 w-full h-12 bg-white pointer-events-none z-10"></div>
            </div>
        </div>
    </section>

    <!-- Kontak Saya -->
    <section id="kontak" class="py-24 bg-gray-50 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in-up-element">
                <h2 class="text-primary font-bold tracking-wide uppercase text-sm mb-2">Hubungi Saya</h2>
                <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">Mari Mulai Proyek Anda</h3>
                <p class="text-gray-600 text-lg">Saya siap membantu merealisasikan ide digital Anda.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-start">
                <div class="fade-in-up-element bg-white rounded-3xl p-6 md:p-8 lg:p-10 border border-gray-100 shadow-xl shadow-primary/5" style="transition-delay: 0.1s;">
                    <h4 class="text-2xl font-bold text-gray-900 mb-6">Kirim Pesan Langsung</h4>
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 text-green-500 rounded-2xl text-sm font-medium flex items-center gap-3">
                            <i class="fas fa-check-circle"></i>
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('inquiry.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="service_category_id" id="service_category_id">
                        <input type="hidden" name="service_name" id="service_name">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" name="name" id="name" required placeholder="Budi Santoso" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" name="email" id="email" required placeholder="budi@example.com" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none">
                            </div>
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor HP</label>
                            <input type="tel" name="phone" id="phone" required placeholder="0812-xxxx-xxxx" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Pesan Anda</label>
                            <textarea name="message" id="message" required rows="5" placeholder="Tuliskan detail kebutuhan website Anda di sini..." class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none resize-none"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white text-lg font-bold py-4 rounded-xl transition-all shadow-lg">Kirim Pesan Sekarang</button>
                    </form>
                </div>

                <div class="fade-in-up-element space-y-10" style="transition-delay: 0.2s;">
                    <div class="w-full h-64 bg-gray-200 rounded-3xl overflow-hidden border border-gray-200 relative group">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126646.20963380062!2d112.63004838637763!3d-7.275443760395779!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbf8381ac47f%3A0x3027a76e352be40!2sSurabaya%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" class="filter grayscale group-hover:grayscale-0 transition-all duration-700"></iframe>
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
