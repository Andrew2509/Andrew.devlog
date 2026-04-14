<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - ' . setting('site_name', 'Andrew.Devlog'))</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
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
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        .glass-sidebar {
            background: rgba(17, 24, 39, 0.7);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }
        .nav-link-active {
            background: rgba(14, 165, 233, 0.1);
            color: #0ea5e9;
            border-left: 4px solid #0ea5e9;
        }
        .neon-shadow {
            box-shadow: 0 0 15px rgba(14, 165, 233, 0.2);
        }
        ::-webkit-scrollbar {
            width: 5px;
        }
        ::-webkit-scrollbar-track {
            background: #0b0f1a;
        }
        ::-webkit-scrollbar-thumb {
            background: #1f2937;
            border-radius: 10px;
        }

        /* Hamburger Animation CSS */
        .check {
          display: none;
        }

        .hamburger-button {
          position: relative;
          display: inline-block;
          width: 70px;
          height: 50px;
          cursor: pointer;
        }

        .hamburger-button div {
          width: 70px;
          height: 10px;
          background-color: #333;
          border-radius: 3px;
          position: absolute;
          transition: 0.4s;
        }

        .line1 {
          top: 0;
        }

        .line2 {
          top: calc(40%);
        }

        .line3 {
          top: calc(80%);
        }

        .hamburger-button:hover div {
          width: 54.2857143%;
        }

        .hamburger-button:hover .line1 {
          transform: translate(31.5px, 12px) rotate(35deg);
          border-radius: 7px;
          border-top-right-radius: 10px;
          border-bottom-right-radius: 10px;
        }

        .hamburger-button:hover .line3 {
          transform: translate(31.5px, -12px) rotate(-35deg);
          border-radius: 7px;
          border-top-right-radius: 10px;
          border-bottom-right-radius: 10px;
        }

        .check:checked ~ .hamburger-button:hover .line1 {
          transform: translate(0, 12px) rotate(-35deg);
          border-radius: 7px;
          border-top-left-radius: 10px;
          border-bottom-left-radius: 10px;
        }

        .check:checked ~ .hamburger-button:hover .line3 {
          transform: translate(0, -12px) rotate(35deg);
          border-radius: 7px;
          border-top-left-radius: 10px;
          border-bottom-left-radius: 10px;
        }

        .check:checked ~ .hamburger-button:hover .line2 {
          margin-left: 32px;
        }
    </style>

    @yield('head')
</head>
<body class="bg-[#0b0f1a] font-sans text-gray-300 antialiased min-h-screen flex">

    <!-- Mobile Navigation Toggle -->
    <div class="lg:hidden fixed top-6 left-6 z-[120] scale-[0.4] origin-top-left p-2 bg-white rounded-2xl shadow-xl border border-white/10 backdrop-blur-md">
        <input type="checkbox" class="check" id="admin-sidebar-check" onchange="toggleAdminSidebar()" />
        <label for="admin-sidebar-check" class="hamburger-button">
          <div class="line1"></div>
          <div class="line2"></div>
          <div class="line3"></div>
        </label>
    </div>

    <!-- Backdrop -->
    <div id="admin-sidebar-backdrop" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[100] hidden transition-opacity lg:hidden" onclick="toggleAdminSidebar()"></div>

    <!-- Sidebar -->
    <aside id="admin-sidebar" class="w-48 glass-sidebar fixed inset-y-0 left-0 z-[110] flex flex-col transition-all duration-300 overflow-y-auto overflow-x-hidden -translate-x-full lg:translate-x-0">
        <div class="p-6">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center neon-shadow p-1.5 border border-white/10">
                    <img src="{{ setting('site_logo') ?: asset('assets/image/logo.png') }}" alt="Admin Logo" class="w-full h-full object-contain">
                </div>
                <span class="text-lg font-black text-white tracking-tight uppercase leading-none">Admin<br><span class="text-primary text-xs uppercase opacity-70 tracking-[0.2em]">Devlog</span></span>
            </a>
        </div>

        <nav class="flex-1 px-3 space-y-1.5 py-4">
            <div class="text-[9px] font-bold text-gray-500 uppercase tracking-widest px-3 mb-2 mt-4">Menu Utama</div>
            
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all {{ Request::is('admin/dashboard') ? 'nav-link-active' : 'hover:bg-white/5 text-gray-400 hover:text-white' }}">
                <i class="fas fa-chart-pie w-4 text-sm"></i>
                <span class="font-bold text-xs tracking-tight">Dashboard</span>
            </a>

            <a href="{{ route('admin.portfolio.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all {{ Request::is('admin/portfolio*') ? 'nav-link-active' : 'hover:bg-white/5 text-gray-400 hover:text-white' }}">
                <i class="fas fa-folder-open w-4 text-sm"></i>
                <span class="font-bold text-xs tracking-tight">Portfolio</span>
            </a>

            <a href="{{ route('admin.service_categories.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all {{ Request::is('admin/service-categories*') ? 'nav-link-active' : 'hover:bg-white/5 text-gray-400 hover:text-white' }}">
                <i class="fas fa-layer-group w-4 text-sm"></i>
                <span class="font-bold text-xs tracking-tight">Kategori Layanan</span>
            </a>

            <a href="{{ route('admin.pricing.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all {{ Request::is('admin/pricing*') ? 'nav-link-active' : 'hover:bg-white/5 text-gray-400 hover:text-white' }}">
                <i class="fas fa-tags w-4 text-sm"></i>
                <span class="font-bold text-xs tracking-tight">Pricing Paket</span>
            </a>

            <a href="{{ route('admin.blogger.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all {{ Request::is('admin/blogger*') ? 'nav-link-active' : 'hover:bg-white/5 text-gray-400 hover:text-white' }}">
                <i class="fab fa-blogger-b w-4 text-sm"></i>
                <span class="font-bold text-xs tracking-tight">Blogger Artikels</span>
            </a>

            <a href="{{ route('admin.templates.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all {{ Request::is('admin/templates*') ? 'nav-link-active' : 'hover:bg-white/5 text-gray-400 hover:text-white' }}">
                <i class="fas fa-file-code w-4 text-sm"></i>
                <span class="font-bold text-xs tracking-tight">Manajemen Template</span>
            </a>

            <!-- Sosmed (Bio) Menu -->
            <div class="space-y-1">
                <button type="button" onclick="toggleSosmedMenu()" class="w-full flex items-center justify-between gap-3 px-3 py-3 rounded-xl transition-all {{ Request::is('admin/sosmed*') ? 'nav-link-active' : 'hover:bg-white/5 text-gray-400 hover:text-white' }}">
                    <div class="flex items-center gap-3 pointer-events-none">
                        <i class="fas fa-share-alt w-4 text-sm"></i>
                        <span class="font-bold text-xs tracking-tight">Sosmed (Bio)</span>
                    </div>
                    <i id="sosmed-arrow" class="fas fa-chevron-right text-[10px] transition-transform pointer-events-none {{ Request::is('admin/sosmed*') ? 'rotate-90' : '' }}"></i>
                </button>
                <div id="sosmed-submenu" class="{{ Request::is('admin/sosmed*') ? '' : 'hidden' }} flex flex-col px-3 space-y-1 mt-1 border-l-2 border-primary/20 ml-5">
                    <a href="{{ route('admin.sosmed.about') }}" class="py-2 pl-3 text-[11px] font-bold transition-colors {{ Request::is('admin/sosmed/about') ? 'text-primary' : 'text-gray-500 hover:text-white' }}">
                        About Me
                    </a>
                    <a href="{{ route('admin.sosmed.services') }}" class="py-2 pl-3 text-[11px] font-bold transition-colors {{ Request::is('admin/sosmed/services') ? 'text-primary' : 'text-gray-500 hover:text-white' }}">
                        Layanan Saya
                    </a>
                    <a href="{{ route('admin.sosmed.links') }}" class="py-2 pl-3 text-[11px] font-bold transition-colors {{ Request::is('admin/sosmed/links') ? 'text-primary' : 'text-gray-500 hover:text-white' }}">
                        Daftar Link
                    </a>
                </div>
            </div>

            <div class="text-[9px] font-bold text-gray-500 uppercase tracking-widest px-3 mb-2 mt-8">Client & Pesan</div>

            <a href="{{ route('admin.clients.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all {{ Request::is('admin/clients*') ? 'nav-link-active' : 'hover:bg-white/5 text-gray-400 hover:text-white' }}">
                <i class="fas fa-award w-4 text-sm"></i>
                <span class="font-bold text-xs tracking-tight">Dipercaya oleh</span>
            </a>

            <a href="{{ route('admin.inquiries.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all {{ Request::is('admin/inquiries*') ? 'nav-link-active' : 'hover:bg-white/5 text-gray-400 hover:text-white' }}">
                <i class="fas fa-envelope w-4 text-sm"></i>
                <span class="font-bold text-xs tracking-tight">Inbox Pesan</span>
                @php $inquiryCount = \App\Models\Inquiry::where('status', 'new')->count(); @endphp
                @if($inquiryCount > 0)
                    <span class="ml-auto bg-primary text-white text-[10px] px-2 py-0.5 rounded-full font-bold">{{ $inquiryCount }}</span>
                @endif
            </a>

            <div class="text-[9px] font-bold text-gray-500 uppercase tracking-widest px-3 mb-2 mt-8">Konfigurasi</div>

            <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all {{ Request::is('admin/settings*') ? 'nav-link-active' : 'hover:bg-white/5 text-gray-400 hover:text-white' }}">
                <i class="fas fa-cog w-4 text-sm"></i>
                <span class="font-bold text-xs tracking-tight">Pengaturan Website</span>
            </a>

            <a href="{{ route('admin.system.clear_cache') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all hover:bg-white/5 text-gray-400 hover:text-white mt-1 border border-white/5" onclick="return confirm('Bersihkan semua cache sistem (rute & tampilan)? Ini berguna jika tampilan website online tidak berubah setelah update.')">
                <i class="fas fa-sync-alt w-4 text-sm text-primary animate-spin-hover"></i>
                <span class="font-bold text-xs tracking-tight">Bersihkan Cache</span>
            </a>
        </nav>

        <div class="p-4 mt-auto">
            <div class="bg-white/5 rounded-3xl p-4 border border-white/5">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-primary to-primary-light flex items-center justify-center font-black text-white">
                        {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="overflow-hidden leading-tight">
                        <p class="text-sm font-bold text-white truncate">{{ auth()->user()->name ?? 'Admin' }}</p>
                        <p class="text-[10px] text-gray-500 truncate">{{ auth()->user()->email ?? setting('contact_email', 'admin@andrew.devlog') }}</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-2 bg-red-500/10 hover:bg-red-500/20 text-red-500 rounded-xl text-[10px] font-bold transition-all flex items-center justify-center gap-2">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 lg:ml-48 p-4 md:p-8">
        <header class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-2xl font-black text-white tracking-tight">@yield('header_title', 'Dashboard Overview')</h2>
                <p class="text-gray-500 text-sm mt-1">@yield('header_subtitle', 'Selamat datang kembali, mari kelola website Anda.')</p>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="{{ url('/') }}" target="_blank" class="px-5 py-2.5 bg-white/5 hover:bg-white/10 text-white text-xs font-bold rounded-xl transition-all border border-white/5 flex items-center gap-2">
                    <i class="fas fa-external-link-alt text-primary"></i>
                    Lihat Website
                </a>
            </div>
        </header>

        <div class="relative z-10">
            @yield('admin_content')
        </div>

        <!-- Abstract Footer Decor -->
        <div class="mt-20 pt-10 border-t border-white/5 text-center text-[10px] text-gray-600 font-bold tracking-widest uppercase">
            {{ strtoupper(setting('site_name', 'ANDREW.DEVLOG')) }} V2.0 &bull; Handcrafted Custom Admin
        </div>
    </main>

    <script>
        function toggleAdminSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const backdrop = document.getElementById('admin-sidebar-backdrop');
            const checkbox = document.getElementById('admin-sidebar-check');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                // Open
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
                checkbox.checked = true;
                document.body.style.overflow = 'hidden';
                setTimeout(() => backdrop.classList.add('opacity-100'), 10);
            } else {
                // Close
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.remove('opacity-100');
                checkbox.checked = false;
                document.body.style.overflow = '';
                setTimeout(() => backdrop.classList.add('hidden'), 300);
            }
        }

        function toggleSosmedMenu() {
            const submenu = document.getElementById('sosmed-submenu');
            const arrow = document.getElementById('sosmed-arrow');
            submenu.classList.toggle('hidden');
            arrow.classList.toggle('rotate-90');
        }
    </script>
    @yield('scripts')
</body>
</html>
