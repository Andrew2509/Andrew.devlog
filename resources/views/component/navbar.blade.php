<!-- Floating Premium Header -->
<header id="main-header" class="fixed top-0 left-0 w-full z-50 pt-5 px-4 md:px-8 pointer-events-none">
    <!-- Navbar Container -->
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
         class="pointer-events-auto gsap-nav max-w-7xl mx-auto w-full flex items-center justify-between px-6 py-3.5 rounded-full bg-white/45 backdrop-blur-xl border border-white/30 shadow-[0_8px_32px_rgba(0,0,0,0.03)] transition-all duration-300">
        
        <!-- Logo Section -->
        <a href="{{ url('/') }}" class="flex items-center gap-2.5 font-black text-lg tracking-tight cursor-pointer group">
            @if(setting('site_logo'))
                <img src="{{ setting('site_logo') }}" alt="{{ setting('site_name', 'Andrew.Devlog') }}" class="h-10 md:h-12 w-auto object-contain transition-transform duration-500 group-hover:scale-105">
            @else
                <div class="w-10 h-10 md:w-11 md:h-11 bg-gradient-to-tr from-blue-600 to-indigo-600 text-white rounded-2xl flex items-center justify-center transform -rotate-6 group-hover:rotate-0 transition-transform shadow-md">
                    <span class="transform rotate-6 group-hover:rotate-0 transition-transform font-bold text-lg md:text-xl">{{ substr(setting('site_name', 'Andrew'), 0, 1) }}</span>
                </div>
                <span class="text-slate-900 font-extrabold text-xl tracking-tight transition-colors group-hover:text-blue-600">{{ setting('site_name', 'Andrew.Devlog') }}</span>
            @endif
        </a>

        <!-- Desktop Navigation Links -->
        <div class="hidden lg:flex items-center bg-slate-900/5 backdrop-blur-md rounded-full border border-slate-950/5 p-1 relative" id="nav-links-container">
            <!-- Active Link Pill Indicator (Toggled & Positioned by JS) -->
            <div id="nav-pill" class="absolute top-1 bottom-1 bg-white rounded-full shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-slate-200/50 transition-all duration-300 pointer-events-none opacity-0 scale-95 z-0"></div>
            
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
                <a href="{{ $link['url'] }}" 
                   data-active="{{ $link['active'] ? 'true' : 'false' }}"
                   class="nav-link px-6 py-2 text-sm font-semibold rounded-full transition-all duration-300 relative z-10 {{ $link['active'] ? 'text-blue-600' : 'text-slate-500 hover:text-slate-900' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>

        <!-- Desktop Actions -->
        <div class="flex items-center gap-3">
            <!-- Search Button -->
            <button onclick="openSearch()" class="w-10 h-10 flex items-center justify-center rounded-full border border-slate-200 bg-white text-slate-500 hover:text-slate-900 hover:border-slate-300 transition-all active:scale-95 shadow-sm hover:shadow">
                <i data-lucide="search" class="w-4 h-4"></i>
            </button>
            
            <!-- WhatsApp CTA Button with sweep light effect -->
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('contact_phone', '+628...')) }}" 
               class="relative overflow-hidden hidden sm:flex items-center gap-2 bg-slate-900 hover:bg-blue-650 text-white px-6 py-3 rounded-full text-xs font-black tracking-wider uppercase transition-all duration-300 shadow-md hover:shadow-[0_8px_25px_-5px_rgba(37,99,235,0.3)] group">
                <!-- Sweep Light Gradient Overlay -->
                <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-sweep"></span>
                <span>KONSULTASI GRATIS</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
            </a>

            <!-- Mobile Toggle Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" 
                    class="lg:hidden w-10 h-10 flex flex-col items-center justify-center gap-1.5 rounded-full bg-slate-900 text-white transition-all active:scale-95 shadow">
                <span class="block w-5 h-0.5 bg-white transition-transform duration-300" :class="mobileMenuOpen ? 'rotate-45 translate-y-2' : ''"></span>
                <span class="block w-3.5 h-0.5 bg-white transition-transform duration-300 self-start ml-2.5" :class="mobileMenuOpen ? 'opacity-0' : ''"></span>
                <span class="block w-5 h-0.5 bg-white transition-transform duration-300" :class="mobileMenuOpen ? '-rotate-45 -translate-y-2' : ''"></span>
            </button>
        </div>

        <!-- Mobile Menu Overlay (Glassmorphic Slide-down) -->
        <div id="mobile-overlay"
             class="fixed inset-x-0 top-0 h-screen bg-white/95 backdrop-blur-2xl z-[90] transition-all duration-500 lg:hidden flex flex-col p-8 pt-32"
             :class="mobileMenuOpen ? 'translate-y-0 opacity-100 pointer-events-auto' : '-translate-y-full opacity-0 pointer-events-none'"
             x-cloak>
            
            <div class="flex flex-col space-y-4">
                <span class="text-[10px] font-black uppercase tracking-[0.25em] text-slate-400 mb-2">Navigasi Utama</span>
                @foreach($links as $index => $link)
                    <a href="{{ $link['url'] }}"
                       @click="mobileMenuOpen = false"
                       class="flex items-center justify-between py-3 text-3xl font-black text-slate-900 hover:text-blue-600 transition-all border-b border-slate-100">
                        <span>{{ $link['label'] }}</span>
                        <i data-lucide="arrow-right" class="w-5 h-5 text-slate-350"></i>
                    </a>
                @endforeach
            </div>

            <div class="mt-auto pb-10">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('contact_phone', '+628...')) }}"
                   @click="mobileMenuOpen = false"
                   class="block w-full text-center bg-gradient-to-r from-blue-600 to-indigo-650 hover:from-blue-700 hover:to-indigo-755 text-white py-4.5 rounded-full font-bold text-xs uppercase tracking-widest shadow-xl transition-all active:scale-95">
                    Konsultasi Gratis
                </a>
            </div>
        </div>
    </nav>
</header>
