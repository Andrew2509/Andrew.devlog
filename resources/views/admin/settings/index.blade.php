@extends('layouts.admin')

@section('title', 'Pengaturan Website - ' . setting('site_name', 'Andrew.Devlog') . ' Admin')
@section('header_title', 'Pengaturan Website')
@section('header_subtitle', 'Kelola identitas, kontak, dan media sosial website Anda.')

@section('admin_content')
<div class="max-w-5xl">
    @if(session('success'))
        <div class="mb-8 bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 px-6 py-4 rounded-2xl text-sm font-bold flex items-center gap-3 animate-fade-in">
            <i class="fas fa-check-circle text-lg"></i>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="space-y-10">
            <!-- Umum Section -->
            <div class="bg-gray-900 border border-white/5 rounded-[40px] p-10 relative overflow-hidden shadow-2xl">
                <div class="absolute -right-20 -top-20 w-80 h-80 bg-primary/5 rounded-full blur-3xl"></div>
                
                <h3 class="text-white font-black text-xl tracking-tight mb-8 flex items-center gap-3 uppercase relative z-10">
                    <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary border border-primary/20">
                        <i class="fas fa-globe text-sm"></i>
                    </div>
                    Identitas Umum
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                    <!-- Logo Upload -->
                    <div class="md:col-span-2 space-y-4 mb-4">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            Logo Website
                        </label>
                        <div class="flex flex-col md:flex-row items-center gap-8 bg-black/20 p-8 rounded-[32px] border border-white/5">
                            <div class="relative group">
                                <div class="w-32 h-32 rounded-2xl bg-white/5 flex items-center justify-center overflow-hidden border border-white/10 group-hover:border-primary/50 transition-all shadow-2xl">
                                    @if(setting('site_logo'))
                                        <img src="{{ setting('site_logo') }}" id="logo-preview" class="w-full h-full object-contain">
                                    @else
                                        <div id="logo-placeholder" class="text-gray-600 flex flex-col items-center gap-2">
                                            <i class="fas fa-image text-3xl"></i>
                                            <span class="text-[8px] font-bold uppercase tracking-tighter">No Logo</span>
                                        </div>
                                        <img id="logo-preview" class="hidden w-full h-full object-contain">
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1 space-y-4 text-center md:text-left">
                                <h4 class="text-white font-bold text-sm">Ganti Logo Website</h4>
                                <p class="text-gray-500 text-[10px] uppercase font-bold tracking-widest leading-relaxed">
                                    Upload file format PNG/JPG (Max. 2MB).<br>Logo akan disimpan langsung ke database.
                                </p>
                                <label class="inline-flex items-center gap-2 px-6 py-3 bg-white/5 hover:bg-white/10 text-white text-xs font-black rounded-xl border border-white/5 cursor-pointer transition-all uppercase tracking-widest">
                                    <i class="fas fa-upload text-primary text-[10px]"></i>
                                    <span>Pilih File</span>
                                    <input type="file" name="site_logo" class="hidden" onchange="previewLogo(this, 'logo-preview', 'logo-placeholder')">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            Nama Website
                        </label>
                        <input type="text" name="site_name" value="{{ setting('site_name', 'Andrew.Devlog') }}" 
                            class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-semibold outline-none"
                            placeholder="Contoh: Andrew.Devlog Digital Agency">
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            Tagline Website
                        </label>
                        <input type="text" name="site_tagline" value="{{ setting('site_tagline', 'Elegance in Every Pixel') }}" 
                            class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-semibold outline-none"
                            placeholder="Slogan website Anda">
                    </div>

                    <div class="space-y-3 md:col-span-2">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            Deskripsi Meta (SEO)
                        </label>
                        <textarea name="site_description" rows="3" 
                            class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-medium resize-none outline-none"
                            placeholder="Deskripsi singkat untuk mesin pencari...">{{ setting('site_description') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Hero Section -->
            <div class="bg-gray-900 border border-white/5 rounded-[40px] p-10 relative overflow-hidden shadow-2xl transition-all hover:border-primary/20">
                <div class="absolute -left-20 -top-20 w-80 h-80 bg-primary/5 rounded-full blur-3xl"></div>
                
                <h3 class="text-white font-black text-xl tracking-tight mb-8 flex items-center gap-3 uppercase relative z-10">
                    <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary border border-primary/20">
                        <i class="fas fa-rocket text-sm"></i>
                    </div>
                    Konten Hero Beranda
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                    <div class="space-y-3 md:col-span-2">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            Badge/Label Atas
                        </label>
                        <input type="text" name="hero_badge" value="{{ setting('hero_badge', 'Arsitek Digital Terbaik 2026') }}" 
                            class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-semibold outline-none">
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            Judul Baris 1
                        </label>
                        <input type="text" name="hero_title_1" value="{{ setting('hero_title_1', 'Jasa Pembuatan') }}" 
                            class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-semibold outline-none">
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            Judul Baris 2 (Text Biru)
                        </label>
                        <input type="text" name="hero_title_2" value="{{ setting('hero_title_2', 'Website Profesional') }}" 
                            class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-semibold outline-none text-primary">
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            Judul Baris 3
                        </label>
                        <input type="text" name="hero_title_3" value="{{ setting('hero_title_3', '& SEO') }}" 
                            class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-semibold outline-none">
                    </div>

                    <div class="space-y-3 md:col-span-2">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            Subtitle / Deskripsi Hero
                        </label>
                        <textarea name="hero_subtitle" rows="3" 
                            class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-medium resize-none outline-none">{{ setting('hero_subtitle', 'Tingkatkan konversi dan visibilitas online bisnis Anda dengan website berkinerja tinggi dan strategi pemasaran digital yang terbukti.') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Kontak Section -->
            <div class="bg-gray-900 border border-white/5 rounded-[40px] p-10 relative overflow-hidden shadow-2xl">
                <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-primary/5 rounded-full blur-3xl"></div>

                <h3 class="text-white font-black text-xl tracking-tight mb-8 flex items-center gap-3 uppercase relative z-10">
                    <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary border border-primary/20">
                        <i class="fas fa-address-book text-sm"></i>
                    </div>
                    Informasi Kontak
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            Email Bisnis
                        </label>
                        <input type="email" name="contact_email" value="{{ setting('contact_email', 'hello@andrew.devlog') }}" 
                            class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-semibold outline-none">
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            WhatsApp (Tanpa '+', Awali 62)
                        </label>
                        <input type="text" name="contact_whatsapp" value="{{ setting('contact_whatsapp', '628123456789') }}" 
                            class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-semibold outline-none"
                            placeholder="628xxxxxxxxxx">
                    </div>

                    <div class="space-y-3 md:col-span-2">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            Alamat Kantor
                        </label>
                        <textarea name="contact_address" rows="2" 
                            class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-medium resize-none outline-none">{{ setting('contact_address') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Sosial Media Section -->
            <div class="bg-gray-900 border border-white/5 rounded-[40px] p-10 relative overflow-hidden shadow-2xl">
                <h3 class="text-white font-black text-xl tracking-tight mb-8 flex items-center gap-3 uppercase relative z-10">
                    <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary border border-primary/20">
                        <i class="fas fa-share-alt text-sm"></i>
                    </div>
                    Media Sosial
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            Instagram URL
                        </label>
                        <div class="flex">
                            <div class="bg-white/5 px-4 flex items-center rounded-l-2xl border-r border-white/5 text-gray-500">
                                <i class="fab fa-instagram"></i>
                            </div>
                            <input type="text" name="social_instagram" value="{{ setting('social_instagram') }}" 
                                class="w-full bg-white text-gray-900 px-6 py-4 rounded-r-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-semibold outline-none"
                                placeholder="https://instagram.com/username">
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            Tiktok URL
                        </label>
                        <div class="flex">
                            <div class="bg-white/5 px-4 flex items-center rounded-l-2xl border-r border-white/5 text-gray-500">
                                <i class="fab fa-tiktok"></i>
                            </div>
                            <input type="text" name="social_tiktok" value="{{ setting('social_tiktok') }}" 
                                class="w-full bg-white text-gray-900 px-6 py-4 rounded-r-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-semibold outline-none"
                                placeholder="https://tiktok.com/@username">
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            Github URL
                        </label>
                        <div class="flex">
                            <div class="bg-white/5 px-4 flex items-center rounded-l-2xl border-r border-white/5 text-gray-500">
                                <i class="fab fa-github"></i>
                            </div>
                            <input type="text" name="social_github" value="{{ setting('social_github') }}" 
                                class="w-full bg-white text-gray-900 px-6 py-4 rounded-r-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-semibold outline-none"
                                placeholder="https://github.com/username">
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            Facebook URL
                        </label>
                        <div class="flex">
                            <div class="bg-white/5 px-4 flex items-center rounded-l-2xl border-r border-white/5 text-gray-500">
                                <i class="fab fa-facebook"></i>
                            </div>
                            <input type="text" name="social_facebook" value="{{ setting('social_facebook') }}" 
                                class="w-full bg-white text-gray-900 px-6 py-4 rounded-r-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-semibold outline-none"
                                placeholder="https://facebook.com/username">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistik Beranda Section -->
            <div class="bg-gray-900 border border-white/5 rounded-[40px] p-10 relative overflow-hidden shadow-2xl transition-all hover:border-primary/20">
                <div class="absolute -right-20 -top-20 w-80 h-80 bg-primary/5 rounded-full blur-3xl"></div>
                
                <h3 class="text-white font-black text-xl tracking-tight mb-8 flex items-center gap-3 uppercase relative z-10">
                    <div class="w-10 h-10 bg-emerald-500/10 rounded-xl flex items-center justify-center text-emerald-500 border border-emerald-500/20">
                        <i class="fas fa-chart-line text-sm"></i>
                    </div>
                    Statistik Beranda
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative z-10">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            <i class="fas fa-check-circle text-primary"></i>
                            Project Selesai
                        </label>
                        <div class="relative group">
                            <input type="text" name="stats_projects" value="{{ setting('stats_projects', '2500+') }}" 
                                class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-black text-lg outline-none"
                                placeholder="Contoh: 2500+">
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 pointer-events-none group-focus-within:text-primary transition-colors">
                                <i class="fas fa-edit"></i>
                            </div>
                        </div>
                        <p class="text-[9px] text-gray-600 font-bold uppercase tracking-tighter px-1 italic">Tampil di bagian 'Projects Finished'</p>
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            <i class="fas fa-users text-primary"></i>
                            Klien Puas
                        </label>
                        <div class="relative group">
                            <input type="text" name="stats_clients" value="{{ setting('stats_clients', '1500+') }}" 
                                class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-black text-lg outline-none"
                                placeholder="Contoh: 1500+">
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 pointer-events-none group-focus-within:text-primary transition-colors">
                                <i class="fas fa-edit"></i>
                            </div>
                        </div>
                        <p class="text-[9px] text-gray-600 font-bold uppercase tracking-tighter px-1 italic">Tampil di bagian 'Happy Clients'</p>
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            <i class="fas fa-award text-primary"></i>
                            Pengalaman (Tahun)
                        </label>
                        <div class="relative group">
                            <input type="text" name="stats_experience" value="{{ setting('stats_experience', '10+') }}" 
                                class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-black text-lg outline-none"
                                placeholder="Contoh: 10+">
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 pointer-events-none group-focus-within:text-primary transition-colors">
                                <i class="fas fa-edit"></i>
                            </div>
                        </div>
                        <p class="text-[9px] text-gray-600 font-bold uppercase tracking-tighter px-1 italic">Tampil di bagian 'Years of Experience'</p>
                    </div>
                </div>
            </div>

            <!-- WhatsApp Configuration Section -->
            <div class="bg-gray-900 border border-white/5 rounded-[40px] p-10 relative overflow-hidden shadow-2xl transition-all hover:border-primary/20">
                <div class="absolute -right-20 -top-20 w-80 h-80 bg-green-500/5 rounded-full blur-3xl"></div>
                
                <h3 class="text-white font-black text-xl tracking-tight mb-8 flex items-center gap-3 uppercase relative z-10">
                    <div class="w-10 h-10 bg-green-500/10 rounded-xl flex items-center justify-center text-green-500 border border-green-500/20">
                        <i class="fab fa-whatsapp text-sm"></i>
                    </div>
                    Pengaturan WhatsApp (Orbit API)
                </h3>
                
                <p class="text-gray-500 text-[10px] uppercase font-bold tracking-widest mb-8 leading-relaxed relative z-10">
                    Konfigurasi ini digunakan untuk mengirimkan notifikasi pesan baru ke WhatsApp Anda melalui Orbit API.<br>
                    Dokumentasi: <a href="https://orbitwaapi.site/docs" target="_blank" class="text-primary hover:underline">orbitwaapi.site/docs</a>
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            Orbit API Key
                        </label>
                        <input type="password" name="orbit_api_key" value="{{ setting('orbit_api_key') }}" 
                            class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-semibold outline-none"
                            placeholder="Masukkan API Key Orbit...">
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            Nomor WA Penerima (Gunakan 62)
                        </label>
                        <input type="text" name="orbit_recipient" value="{{ setting('orbit_recipient') }}" 
                            class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-semibold outline-none"
                            placeholder="Contoh: 628123456789">
                    </div>
                </div>
            </div>

            <!-- Google Reviews Configuration Section -->
            <div class="bg-gray-900 border border-white/5 rounded-[40px] p-10 relative overflow-hidden shadow-2xl transition-all hover:border-primary/20">
                <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-blue-500/5 rounded-full blur-3xl"></div>
                
                <h3 class="text-white font-black text-xl tracking-tight mb-8 flex items-center gap-3 uppercase relative z-10">
                    <div class="w-10 h-10 bg-blue-500/10 rounded-xl flex items-center justify-center text-blue-400 border border-blue-500/20">
                        <i class="fab fa-google text-sm"></i>
                    </div>
                    Google Reviews Widget (Iframe)
                </h3>
                
                <p class="text-gray-500 text-[10px] uppercase font-bold tracking-widest mb-8 leading-relaxed relative z-10">
                    Masukkan URL Iframe dari Elfsight atau penyedia widget Google Reviews lainnya.<br>
                    Contoh: https://5d994d31ef99443986d2ad9bf3283ff9.elf.site
                </p>

                <p class="text-gray-500 text-[10px] uppercase font-bold tracking-widest mb-8 leading-relaxed relative z-10">
                    Konfigurasi ini digunakan untuk menampilkan ulasan Google di halaman testimoni.
                </p>

                <div class="space-y-3 relative z-10">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                        URL Iframe Google Reviews
                    </label>
                    <input type="text" name="google_reviews_iframe" value="{{ setting('google_reviews_iframe', 'https://5d994d31ef99443986d2ad9bf3283ff9.elf.site') }}" 
                        class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-semibold outline-none"
                        placeholder="https://xxx.elf.site">
                </div>
            </div>

            <!-- Blogger Configuration Section -->
            <div class="bg-gray-900 border border-white/5 rounded-[40px] p-10 relative overflow-hidden shadow-2xl transition-all hover:border-primary/20">
                <div class="absolute -left-20 -top-20 w-80 h-80 bg-primary/5 rounded-full blur-3xl"></div>
                
                <h3 class="text-white font-black text-xl tracking-tight mb-8 flex items-center gap-3 uppercase relative z-10">
                    <div class="w-10 h-10 bg-orange-500/10 rounded-xl flex items-center justify-center text-orange-500 border border-orange-500/20">
                        <i class="fab fa-blogger-b text-sm"></i>
                    </div>
                    Pengaturan Blogger API
                </h3>
                
                <p class="text-gray-500 text-[10px] uppercase font-bold tracking-widest mb-8 leading-relaxed relative z-10">
                    Konfigurasi ini digunakan untuk mengambil postingan terbaru dari Blog Anda.<br>
                    Data yang diisi di sini akan mengabaikan nilai di file .env.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            Blogger API Key
                        </label>
                        <input type="password" name="blogger_api_key" value="{{ setting('blogger_api_key', config('services.blogger.key')) }}" 
                            class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-semibold outline-none"
                            placeholder="AIzaSy...">
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            Blogger Blog ID
                        </label>
                        <input type="text" name="blogger_blog_id" value="{{ setting('blogger_blog_id', config('services.blogger.blog_id')) }}" 
                            class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-semibold outline-none"
                            placeholder="67956...">
                    </div>
                </div>
            </div>

            <!-- Footer Section -->
            <div class="bg-gray-900 border border-white/5 rounded-[40px] p-10 relative overflow-hidden shadow-2xl">
                <h3 class="text-white font-black text-xl tracking-tight mb-8 flex items-center gap-3 uppercase relative z-10">
                    <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary border border-primary/20">
                        <i class="fas fa-quote-right text-sm"></i>
                    </div>
                    Footer & Copyright
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                    <!-- Footer Logo Upload -->
                    <div class="md:col-span-2 space-y-4 mb-4">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            Logo Khusus Footer (Opsional)
                        </label>
                        <div class="flex flex-col md:flex-row items-center gap-8 bg-black/20 p-8 rounded-[32px] border border-white/5">
                            <div class="relative group">
                                <div class="w-32 h-32 rounded-2xl bg-white/5 flex items-center justify-center overflow-hidden border border-white/10 group-hover:border-primary/50 transition-all shadow-2xl">
                                    @if(setting('footer_logo'))
                                        <img src="{{ setting('footer_logo') }}" id="footer-logo-preview" class="w-full h-full object-contain">
                                    @else
                                        <div id="footer-logo-placeholder" class="text-gray-600 flex flex-col items-center gap-2">
                                            <i class="fas fa-image text-3xl"></i>
                                            <span class="text-[8px] font-bold uppercase tracking-tighter">Use Main</span>
                                        </div>
                                        <img id="footer-logo-preview" class="hidden w-full h-full object-contain">
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1 space-y-4 text-center md:text-left">
                                <h4 class="text-white font-bold text-sm">Ganti Logo Khusus Footer</h4>
                                <p class="text-gray-500 text-[10px] uppercase font-bold tracking-widest leading-relaxed">
                                    Jika kosong, website akan menggunakan Logo Utama.<br>Simpan logo khusus (misal: versi putih/simpel).
                                </p>
                                <label class="inline-flex items-center gap-2 px-6 py-3 bg-white/5 hover:bg-white/10 text-white text-xs font-black rounded-xl border border-white/5 cursor-pointer transition-all uppercase tracking-widest">
                                    <i class="fas fa-upload text-primary text-[10px]"></i>
                                    <span>Pilih File</span>
                                    <input type="file" name="footer_logo" class="hidden" onchange="previewLogo(this, 'footer-logo-preview', 'footer-logo-placeholder')">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2 space-y-3 relative z-10">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            Copyright Text
                        </label>
                        <input type="text" name="footer_copyright" value="{{ setting('footer_copyright', '© 2026 Andrew.Devlog Digital. All Rights Reserved.') }}" 
                            class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-semibold outline-none">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12 flex justify-end">
            <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-12 py-5 rounded-[24px] font-black text-sm transition-all shadow-2xl shadow-primary/30 flex items-center gap-4 uppercase tracking-[0.2em] group">
                <span>Simpan Perubahan</span>
                <i class="fas fa-check text-xs transition-transform group-hover:scale-125"></i>
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
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

@section('head')
<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.5s ease-out forwards;
    }
</style>
@endsection
