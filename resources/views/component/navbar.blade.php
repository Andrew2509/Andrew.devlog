<!-- Navbar -->
<nav class="fixed w-full z-50 transition-all duration-300 bg-white/90 backdrop-blur-md border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo Section -->
            <div class="shrink-0">
                <a href="{{ url('/') }}" class="flex items-center gap-2 cursor-pointer py-1">
                    @if(setting('site_logo'))
                        <img src="{{ setting('site_logo') }}" alt="{{ setting('site_name', 'Andrew.Devlog') }}" class="h-28 w-auto drop-shadow-md">
                    @else
                        <img src="{{ asset('assets/image/logo.png') }}" alt="{{ setting('site_name', 'Andrew.Devlog') }}" class="h-28 w-auto drop-shadow-md">
                    @endif
                </a>
            </div>

            <!-- Centered Desktop Links -->
            <div class="hidden md:flex flex-1 justify-center">
                <div class="flex items-center gap-6">
                    <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'text-primary-600 border-b-2 border-primary font-bold' : 'text-gray-600 hover:text-primary font-medium' }} transition-all px-1 py-1 text-sm whitespace-nowrap">Beranda</a>
                    {{-- <a href="{{ url('/#layanan') }}" class="text-gray-600 hover:text-primary font-medium transition-colors text-sm whitespace-nowrap">Layanan</a> --}}
                    {{-- <a href="{{ url('/#proses-kerja') }}" class="text-gray-600 hover:text-primary font-medium transition-colors text-sm whitespace-nowrap">Proses</a> --}}
                    <a href="{{ url('/#portofolio') }}" class="text-gray-600 hover:text-primary transition-colors font-medium text-sm whitespace-nowrap">Proyek</a>
                    <a href="{{ route('templates') }}" class="{{ Request::is('templates*') ? 'text-primary-600 border-b-2 border-primary font-bold' : 'text-gray-600 hover:text-primary font-medium' }} transition-all px-1 py-1 text-sm whitespace-nowrap flex items-center gap-1">
                        Template
                        <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-[10px] font-bold bg-primary text-white leading-none">New</span>
                    </a>
                    <a href="{{ url('/harga') }}" class="{{ Request::is('harga') ? 'text-primary-600 border-b-2 border-primary font-bold' : 'text-gray-600 hover:text-primary font-medium' }} transition-all px-1 py-1 text-sm whitespace-nowrap">Harga</a>
                    <a href="{{ route('blog') }}" class="{{ Request::is('blog*') ? 'text-primary-600 border-b-2 border-primary font-bold' : 'text-gray-600 hover:text-primary font-medium' }} transition-all px-1 py-1 text-sm whitespace-nowrap">Blog</a>
                    {{-- <a href="{{ url('/#testimoni') }}" class="text-gray-600 hover:text-primary font-medium transition-colors text-sm whitespace-nowrap">Testimoni</a> --}}
                </div>
            </div>

            <!-- Search & Actions Section -->
            <div class="hidden md:flex items-center gap-8">
                <button onclick="openSearch()" class="flex items-center gap-3 px-4 py-2 rounded-xl bg-gray-50 border border-gray-100 text-gray-400 hover:text-primary hover:border-primary-100 transition-all group" aria-label="Buka Pencarian">
                    <i class="fas fa-search text-sm"></i>
                    <span class="text-sm font-medium">Cari sesuatu...</span>
                    <kbd class="hidden lg:inline-flex h-5 select-none items-center gap-1 rounded border border-gray-200 bg-white px-1.5 font-mono text-[10px] font-medium text-gray-400 opacity-100">
                        Ctrl+K
                    </kbd>
                </button>

                <a href="{{ url('/#kontak') }}" class="bg-primary hover:bg-primary-dark text-white px-5 py-2.5 rounded-full font-bold text-xs whitespace-nowrap transition-all shadow-lg shadow-primary/20 hover:shadow-primary/40 active:scale-95">
                    Konsultasi Gratis
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center gap-4">
                <button onclick="openSearch()" class="w-10 h-10 flex items-center justify-center text-gray-600 hover:text-primary transition-colors" aria-label="Buka Pencarian">
                    <i class="fas fa-search"></i>
                </button>
                <button id="mobile-menu-btn" onclick="toggleMobileMenu()" class="w-10 h-10 flex items-center justify-center text-gray-600 hover:text-primary transition-colors" aria-label="Buka Menu Navigasi">
                    <i id="mobile-menu-icon" class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-menu" class="hidden md:hidden bg-white border-b border-gray-100 overflow-hidden transition-all duration-300 max-h-0">
        <div class="px-4 pt-4 pb-6 space-y-2 shadow-inner bg-gray-50/50">
            <!-- Mobile Search -->
            <div class="px-2 mb-4">
                <button
                    class="w-full bg-white border border-gray-200 text-gray-500 rounded-2xl py-4 px-5 flex items-center gap-3 text-sm font-medium shadow-sm active:scale-[0.98] transition-all"
                    onclick="openSearch()"
                >
                    <i class="fas fa-search text-primary"></i>
                    <span>Cari sesuatu...</span>
                </button>
            </div>

            <a href="{{ url('/') }}" class="block px-4 py-3 rounded-xl {{ Request::is('/') ? 'bg-primary text-white font-bold shadow-lg shadow-primary/20' : 'text-gray-600 font-medium hover:bg-gray-100' }} transition-all">Beranda</a>
            {{-- <a href="{{ url('/#layanan') }}" class="block px-4 py-3 rounded-xl text-gray-600 font-medium hover:bg-gray-100 transition-all">Layanan</a> --}}
            {{-- <a href="{{ url('/#proses-kerja') }}" class="block px-4 py-3 rounded-xl text-gray-600 font-medium hover:bg-gray-100 transition-all">Proses</a> --}}
            <a href="{{ url('/#portofolio') }}" class="block px-4 py-3 rounded-xl text-gray-600 font-medium hover:bg-gray-100 transition-all">Portofolio</a>
            <a href="{{ route('templates') }}" class="block px-4 py-3 rounded-xl {{ Request::is('templates*') ? 'bg-primary text-white font-bold shadow-lg shadow-primary/20' : 'text-gray-600 font-medium hover:bg-gray-100' }} transition-all flex items-center justify-between">
                <span>Template</span>
                <span class="px-2 py-1 rounded-lg text-[10px] font-bold bg-white text-primary shadow-sm">NEW</span>
            </a>
            <a href="{{ url('/harga') }}" class="block px-4 py-3 rounded-xl {{ Request::is('harga') ? 'bg-primary text-white font-bold shadow-lg shadow-primary/20' : 'text-gray-600 font-medium hover:bg-gray-100' }} transition-all">Harga</a>
            <a href="{{ route('blog') }}" class="block px-4 py-3 rounded-xl {{ Request::is('blog*') ? 'bg-primary text-white font-bold shadow-lg shadow-primary/20' : 'text-gray-600 font-medium hover:bg-gray-100' }} transition-all">Blog</a>
            <a href="{{ url('/#testimoni') }}" class="block px-4 py-3 rounded-xl text-gray-600 font-medium hover:bg-gray-100 transition-all">Testimoni</a>

            <div class="pt-4 px-2">
                <a href="{{ url('/#kontak') }}" class="block w-full text-center bg-primary hover:bg-primary-dark text-white py-4 rounded-2xl font-bold text-sm shadow-xl shadow-primary/20 transition-all">
                    Konsultasi Gratis
                </a>
            </div>
        </div>
    </div>
</nav>
