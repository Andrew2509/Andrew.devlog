<!-- Navbar -->
<nav class="fixed w-full z-50 transition-all duration-300 bg-white/90 backdrop-blur-md border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo Section -->
            <div class="flex-shrink-0">
                <a href="{{ url('/') }}" class="flex items-center gap-2 cursor-pointer py-1">
                    @if(setting('site_logo'))
                        <img src="{{ setting('site_logo') }}" alt="{{ setting('site_name', 'Andrew.Devlog') }}" class="h-28 w-auto drop-shadow-md">
                    @else
                        <div class="w-10 h-10 rounded-xl bg-primary text-white flex items-center justify-center font-bold text-2xl shadow-lg shadow-primary/20">
                            {{ substr(setting('site_name', 'Andrew.Devlog'), 0, 1) }}
                        </div>
                        <span class="font-bold text-2xl text-gray-900 tracking-tighter">{{ setting('site_name', 'Andrew.Devlog') }}</span>
                    @endif
                </a>
            </div>

            <!-- Centered Desktop Links -->
            <div class="hidden md:flex flex-1 justify-center">
                <div class="flex items-center gap-6">
                    <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'text-primary-600 border-b-2 border-primary font-bold' : 'text-gray-600 hover:text-primary font-medium' }} transition-all px-1 py-1 text-sm whitespace-nowrap">Beranda</a>
                    <a href="{{ url('/#layanan') }}" class="text-gray-600 hover:text-primary font-medium transition-colors text-sm whitespace-nowrap">Layanan</a>
                    <a href="{{ url('/#proses-kerja') }}" class="text-gray-600 hover:text-primary font-medium transition-colors text-sm whitespace-nowrap">Proses</a>
                    <a href="{{ url('/#portofolio') }}" class="text-gray-600 hover:text-primary transition-colors font-medium text-sm whitespace-nowrap">Portofolio</a>
                    <a href="{{ url('/harga') }}" class="{{ Request::is('harga') ? 'text-primary-600 border-b-2 border-primary font-bold' : 'text-gray-600 hover:text-primary font-medium' }} transition-all px-1 py-1 text-sm whitespace-nowrap">Harga</a>
                    <a href="{{ route('blog') }}" class="{{ Request::is('blog*') ? 'text-primary-600 border-b-2 border-primary font-bold' : 'text-gray-600 hover:text-primary font-medium' }} transition-all px-1 py-1 text-sm whitespace-nowrap">Blog</a>
                    <a href="{{ url('/#testimoni') }}" class="text-gray-600 hover:text-primary font-medium transition-colors text-sm whitespace-nowrap">Testimoni</a>
                </div>
            </div>

            <!-- Search & Actions Section -->
            <div class="hidden md:flex items-center gap-3 flex-shrink-0">
                <button
                    class="[--background:#ffffff] [--color:#000000] [--muted:#f4f4f5] [--muted-foreground:#71717a] [--border:#e4e4e7] relative inline-flex items-center gap-2 whitespace-nowrap transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary disabled:pointer-events-none disabled:opacity-50 border border-[--border] bg-[--background] hover:bg-[--muted] text-[--muted-foreground] hover:text-[--color] px-3 py-2 justify-start rounded-[0.75rem] text-xs font-medium shadow-sm h-9 w-44 group"
                    type="button"
                    onclick="openSearch()"
                >
                    <i class="fas fa-search text-[10px]"></i>
                    <span class="hidden lg:inline-flex">Cari sesuatu...</span>
                    <span class="inline-flex lg:hidden">Cari...</span>
                    <kbd
                        class="pointer-events-none absolute right-[0.4rem] top-[0.4rem] hidden xl:flex h-5 select-none items-center gap-1 rounded border border-[--border] bg-[--muted] px-1 font-mono text-[9px] font-medium opacity-100"
                    >
                        ⌘K
                    </kbd>
                </button>

                <a href="{{ url('/#kontak') }}" class="bg-primary hover:bg-primary-dark text-white px-5 py-2.5 rounded-full font-bold text-xs whitespace-nowrap transition-all shadow-lg shadow-primary/20 hover:shadow-primary/40 active:scale-95">
                    Konsultasi Gratis
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button class="w-10 h-10 flex items-center justify-center bg-gray-50 rounded-xl text-gray-900 border border-gray-100 active:scale-90 transition-all" id="mobile-menu-btn">
                    <i class="fas fa-bars" id="mobile-menu-icon"></i>
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
            <a href="{{ url('/#layanan') }}" class="block px-4 py-3 rounded-xl text-gray-600 font-medium hover:bg-gray-100 transition-all">Layanan</a>
            <a href="{{ url('/#proses-kerja') }}" class="block px-4 py-3 rounded-xl text-gray-600 font-medium hover:bg-gray-100 transition-all">Proses</a>
            <a href="{{ url('/#portofolio') }}" class="block px-4 py-3 rounded-xl text-gray-600 font-medium hover:bg-gray-100 transition-all">Portofolio</a>
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
