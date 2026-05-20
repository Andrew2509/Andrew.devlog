<!-- Navbar -->
<nav id="main-nav"
     x-data="{ mobileMenuOpen: false }"
     x-init="$watch('mobileMenuOpen', value => {
         if (value) {
             document.body.classList.add('mobile-menu-open');
         } else {
             document.body.classList.remove('mobile-menu-open');
         }
     });
     document.body.classList.remove('mobile-menu-open');"
     class="gsap-nav relative z-50 flex items-center justify-between px-6 py-5 max-w-7xl mx-auto w-full">
    
    <!-- Logo Section -->
    <a href="{{ url('/') }}" class="flex items-center gap-3 font-bold text-xl tracking-tighter cursor-pointer group">
        @if(setting('site_logo'))
            <img src="{{ setting('site_logo') }}" alt="{{ setting('site_name', 'Andrew.Devlog') }}" class="h-14 md:h-16 w-auto object-contain">
        @else
            <div class="w-14 h-14 md:w-16 md:h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center transform -rotate-6 group-hover:rotate-0 transition-transform shadow-md">
                <span class="transform rotate-6 group-hover:rotate-0 transition-transform font-bold text-2xl md:text-3xl">{{ substr(setting('site_name', 'Andrew'), 0, 1) }}</span>
            </div>
            <span class="text-slate-800 text-2xl md:text-3xl">{{ setting('site_name', 'Andrew.Devlog') }}</span>
        @endif
    </a>

    <!-- Desktop Navigation Links -->
    <div class="hidden lg:flex items-center bg-white/60 backdrop-blur-md rounded-full shadow-sm border border-slate-200/50 p-1.5">
        @php
            $links = [
                ['label' => 'Beranda', 'url' => url('/'), 'active' => Request::is('/')],
                ['label' => 'Template', 'url' => route('templates'), 'active' => Request::is('templates*')],
                ['label' => 'Portofolio', 'url' => url('/#portofolio'), 'active' => false],
                ['label' => 'Harga', 'url' => route('harga'), 'active' => Request::is('harga*')],
                ['label' => 'Joki', 'url' => route('joki'), 'active' => Request::is('joki*')],
                ['label' => 'Blog', 'url' => route('blog'), 'active' => Request::is('blog*')],
            ];
        @endphp
        @foreach($links as $link)
            <a href="{{ $link['url'] }}" class="px-6 py-2.5 text-sm font-semibold rounded-full transition-all duration-300 {{ $link['active'] ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-500 hover:text-slate-900' }}">
                {{ $link['label'] }}
            </a>
        @endforeach
    </div>

    <!-- Desktop Actions -->
    <div class="flex items-center gap-4">
        <button onclick="openSearch()" class="w-10 h-10 flex items-center justify-center rounded-full border border-slate-200 bg-white text-slate-500 hover:text-slate-900 hover:border-slate-300 transition-all active:scale-95">
            <i data-lucide="search" class="w-[18px] h-[18px]"></i>
        </button>
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('contact_phone', '+628...')) }}" class="hidden sm:flex items-center gap-2 bg-slate-900 text-white px-6 py-3 rounded-full text-sm font-semibold hover:bg-blue-600 transition-colors duration-300 shadow-lg shadow-slate-900/20 hover:shadow-blue-600/30">
            KONSULTASI GRATIS
        </a>

        <!-- Mobile Toggle Button -->
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden w-10 h-10 flex flex-col items-center justify-center gap-1.5 rounded-full bg-slate-900 text-white transition-all active:scale-95">
            <span class="block w-5 h-0.5 bg-white transition-transform" :class="mobileMenuOpen ? 'rotate-45 translate-y-2' : ''"></span>
            <span class="block w-5 h-0.5 bg-white transition-transform" :class="mobileMenuOpen ? '-rotate-45 -translate-y-0' : ''"></span>
        </button>
    </div>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-overlay"
         class="fixed inset-0 bg-white z-[90] transition-all duration-700 lg:hidden flex flex-col p-10 pt-32"
         :class="mobileMenuOpen ? 'translate-x-0 opacity-100 pointer-events-auto' : 'translate-x-full opacity-0 pointer-events-none'"
         x-cloak>
        
        <div class="flex flex-col space-y-4">
            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 mb-4">Navigasi Utama</span>
            @foreach($links as $index => $link)
                <a href="{{ $link['url'] }}"
                   @click="mobileMenuOpen = false"
                   class="flex items-center justify-between text-4xl sm:text-5xl font-black text-slate-900 hover:text-blue-600 transition-all">
                    <span>{{ $link['label'] }}</span>
                    <i data-lucide="arrow-right" class="w-6 h-6 text-slate-400"></i>
                </a>
            @endforeach
        </div>

        <div class="mt-auto pt-16 space-y-10">
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('contact_phone', '+628...')) }}"
               @click="mobileMenuOpen = false"
               class="block w-full text-center bg-slate-900 text-white py-6 rounded-[2rem] font-bold text-sm uppercase tracking-[0.2em] shadow-xl hover:bg-blue-600 transition-colors">
                Konsultasi Gratis
            </a>
        </div>
    </div>
</nav>
