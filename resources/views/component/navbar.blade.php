<!-- Navbar -->
<nav id="main-nav" class="fixed top-0 left-0 right-0 z-[100] py-6 transition-all duration-700 ease-in-out">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div id="nav-container" class="relative flex justify-between items-center transition-all duration-700 rounded-[2.5rem] border border-white/40 bg-white/10 backdrop-blur-md px-6 sm:px-10 h-20 shadow-2xl shadow-primary/5">

            <!-- Glass Background Layer -->
            <div id="nav-glass" class="absolute inset-0 rounded-[2.5rem] bg-white/70 backdrop-blur-2xl border border-white opacity-0 transition-opacity duration-700 -z-10"></div>

            <!-- Logo Section -->
            <div class="shrink-0 relative z-10">
                <a href="{{ url('/') }}" class="group flex items-center gap-3">
                    <div class="relative flex items-center gap-2 group-hover:scale-105 transition-transform duration-500">
                        @if(setting('site_logo'))
                            <img src="{{ setting('site_logo') }}" alt="{{ setting('site_name', 'Andrew.Devlog') }}" class="h-12 w-auto drop-shadow-md">
                        @else
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary to-meta-purple flex items-center justify-center shadow-lg shadow-primary/20">
                                <span class="text-white font-black text-xl">A</span>
                            </div>
                            <span class="text-xl font-black tracking-tighter text-indigo-950">{{ setting('site_name', 'Andrew.Devlog') }}</span>
                        @endif
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex flex-1 justify-center items-center relative z-10 mx-8">
                <div class="relative flex items-center p-1.5 rounded-full bg-slate-900/5 backdrop-blur-sm border border-slate-200/50">
                    <!-- Sliding Active Pill -->
                    <div id="nav-pill" class="absolute h-10 transition-all duration-500 cubic-bezier(0.34, 1.56, 0.64, 1) rounded-full bg-white shadow-lg shadow-primary/5 border border-slate-100 -z-10 opacity-0"></div>

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
                           class="nav-link relative px-7 py-2 text-[13px] font-bold tracking-wide transition-all duration-300 {{ $link['active'] ? 'text-primary' : 'text-slate-600 hover:text-primary' }} flex items-center gap-1.5 uppercase"
                           data-active="{{ $link['active'] ? 'true' : 'false' }}">
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Actions Section -->
            <div class="hidden md:flex items-center gap-4 relative z-10">
                <button onclick="openSearch()" class="group flex items-center justify-center w-12 h-12 rounded-full bg-white/50 hover:bg-white border border-slate-200 hover:border-primary/30 transition-all duration-500 shadow-sm active:scale-90" title="Cari (Ctrl+K)">
                    <i class="fas fa-search text-slate-500 group-hover:text-primary transition-colors text-sm"></i>
                </button>

                <a href="{{ url('/#kontak') }}" class="relative group px-8 py-3.5 rounded-full font-black text-[11px] tracking-[0.15em] uppercase transition-all duration-500 active:scale-95 overflow-hidden">
                    <!-- Background Layers -->
                    <div class="absolute inset-0 bg-slate-950 transition-all duration-500 group-hover:bg-primary"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-primary to-blue-400 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <span class="relative z-10 text-white">Konsultasi Gratis</span>
                </a>
            </div>

            <!-- Mobile Menu Toggle -->
            <div class="lg:hidden flex items-center gap-3 relative z-10">
                <button id="mobile-menu-btn" onclick="toggleMobileMenu()" class="group w-14 h-14 flex flex-col items-center justify-center gap-1.5 rounded-[1.25rem] bg-slate-950 text-white shadow-xl shadow-slate-900/10 transition-all duration-500 active:scale-90">
                    <span class="block w-6 h-0.5 bg-current rounded-full transition-all duration-500 group-[.open]:rotate-45 group-[.open]:translate-y-2"></span>
                    <span class="block w-4 h-0.5 bg-current rounded-full transition-all duration-500 group-[.open]:opacity-0 self-start ml-4"></span>
                    <span class="block w-6 h-0.5 bg-current rounded-full transition-all duration-500 group-[.open]:-rotate-45 group-[.open]:-translate-y-2"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 bg-white z-[60] translate-x-full transition-transform duration-700 cubic-bezier(0.85, 0, 0.15, 1) hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none">
            <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="currentColor" stroke-width="0.5"/></pattern></defs>
                <rect width="100%" height="100%" fill="url(#grid)"/>
            </svg>
        </div>

        <div class="relative flex flex-col h-full p-10 pt-32 overflow-y-auto">
            <div class="flex flex-col space-y-4">
                <span class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 mb-4">Navigasi Utama</span>
                @foreach($links as $index => $link)
                    <a href="{{ $link['url'] }}"
                       class="mobile-link group flex items-center justify-between text-5xl sm:text-7xl font-black text-slate-900 opacity-0 translate-y-10 transition-all duration-700 hover:text-primary"
                       onclick="toggleMobileMenu()"
                       style="transition-delay: {{ 100 + ($index * 50) }}ms">
                        <span>{{ $link['label'] }}</span>
                        <i class="fas fa-arrow-right text-2xl opacity-0 -translate-x-10 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-500"></i>
                    </a>
                @endforeach
            </div>

            <div class="mt-auto pt-16 space-y-10">
                <div class="grid grid-cols-2 gap-8 opacity-0 translate-y-10 transition-all duration-700 delay-500 mobile-footer-item">
                    <div class="flex flex-col gap-3">
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Media Sosial</span>
                        <div class="flex gap-4">
                            <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-primary hover:text-white transition-all"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-primary hover:text-white transition-all"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-primary hover:text-white transition-all"><i class="fab fa-facebook-f"></i></a>
                        </div>
                    </div>
                    <div class="flex flex-col gap-3">
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Hubungi</span>
                        <a href="mailto:{{ setting('site_email', 'hello@neonflux.id') }}" class="text-sm font-bold text-slate-900 hover:text-primary transition-colors">hello@neonflux.id</a>
                    </div>
                </div>

                <a href="{{ url('/#kontak') }}" onclick="toggleMobileMenu()" class="block w-full text-center bg-slate-950 text-white py-6 rounded-[2rem] font-black text-sm uppercase tracking-[0.2em] shadow-2xl shadow-slate-900/20 opacity-0 translate-y-10 transition-all duration-700 delay-700 mobile-footer-item hover:bg-primary transition-colors">
                    Konsultasi Gratis
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
    /* Sliding Pill Interaction */
    .nav-link[data-active="true"] {
        color: #1877F2;
    }

    #main-nav.scrolled {
        padding-top: 1.25rem;
        padding-bottom: 1.25rem;
    }

    #main-nav.scrolled #nav-container {
        @apply shadow-2xl shadow-primary/10;
        height: 76px;
        border-color: rgba(255, 255, 255, 1);
    }

    #main-nav.scrolled #nav-glass {
        opacity: 1;
    }

    /* Mobile Menu Entrance */
    .mobile-menu-open #mobile-overlay {
        display: block;
        transform: translateX(0);
    }

    .mobile-menu-open .mobile-link,
    .mobile-menu-open .mobile-footer-item {
        opacity: 1;
        transform: translateY(0);
    }

    /* Prevent Scroll when Mobile Menu is Open */
    body.mobile-menu-open {
        overflow: hidden;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const nav = document.getElementById('main-nav');
        const pill = document.getElementById('nav-pill');
        const links = document.querySelectorAll('.nav-link');

        // 1. Pill Logic with smoother spring effect
        const updatePill = (element) => {
            if (!element) {
                pill.style.opacity = '0';
                pill.style.transform = 'scale(0.8)';
                return;
            }
            const rect = element.getBoundingClientRect();
            const parentRect = element.parentElement.getBoundingClientRect();

            pill.style.width = `${rect.width}px`;
            pill.style.left = `${rect.left - parentRect.left}px`;
            pill.style.opacity = '1';
            pill.style.transform = 'scale(1)';
        };

        // Initialize pill for active link
        const activeLink = document.querySelector('.nav-link[data-active="true"]');
        if (activeLink) {
            setTimeout(() => updatePill(activeLink), 300);
        }

        links.forEach(link => {
            link.addEventListener('mouseenter', () => updatePill(link));
            link.addEventListener('mouseleave', () => {
                const currentActive = document.querySelector('.nav-link[data-active="true"]');
                updatePill(currentActive);
            });
        });

        // 2. Scroll Logic with throttling
        let lastScroll = 0;
        window.addEventListener('scroll', () => {
            const currentScroll = window.scrollY;

            if (currentScroll > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }

            lastScroll = currentScroll;
        });
    });

    function toggleMobileMenu() {
        const body = document.body;
        const btn = document.getElementById('mobile-menu-btn');
        const overlay = document.getElementById('mobile-overlay');

        const isOpen = body.classList.toggle('mobile-menu-open');
        btn.classList.toggle('open');

        if (isOpen) {
            overlay.classList.remove('hidden');
            // Trigger reflow
            overlay.offsetHeight;
            overlay.classList.remove('translate-x-full');
        } else {
            overlay.classList.add('translate-x-full');
            setTimeout(() => {
                if (!body.classList.contains('mobile-menu-open')) {
                    overlay.classList.add('hidden');
                }
            }, 700);
        }
    }
</script>


