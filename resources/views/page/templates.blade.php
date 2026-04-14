@extends('layouts.app')

@section('title', 'Katalog Template Website - ' . setting('site_name', 'Andrew.Devlog'))

@section('head')
    <!-- Alpine.js for interactive Modal -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .preview-iframe {
            width: 100%;
            height: 100%;
            border: none;
            background: white;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .device-mobile { width: 375px; height: 667px; margin: 0 auto; border-radius: 32px; ring: 8px solid #1f2937; }
        .device-tablet { width: 768px; height: 1024px; margin: 0 auto; border-radius: 24px; ring: 6px solid #1f2937; }
        .device-desktop { width: 100%; height: 100%; border-radius: 0; }
    </style>
@endsection

@section('content')
<div x-data="{ 
    isOpen: false, 
    previewUrl: '', 
    contentType: 'link', 
    templateName: '',
    device: 'desktop',
    loading: false,
    isFullscreen: false,
    openPreview(url, type, name) {
        this.templateName = name;
        this.contentType = type;
        this.previewUrl = (type === 'link') ? '{{ route('template.external_preview') }}?url=' + encodeURIComponent(url) : url;
        this.isOpen = true;
        this.loading = true;
        this.device = 'desktop';
        this.isFullscreen = false;
        document.body.style.overflow = 'hidden';
    },
    closePreview() {
        this.isOpen = false;
        document.body.style.overflow = 'auto';
        this.previewUrl = '';
        if (this.isFullscreen) this.toggleFullscreen();
    },
    toggleFullscreen() {
        const elem = document.getElementById('preview-container');
        if (!this.isFullscreen) {
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.webkitRequestFullscreen) {
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) {
                elem.msRequestFullscreen();
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        }
        this.isFullscreen = !this.isFullscreen;
    }
}" x-on:keydown.escape.window="closePreview()">

    <!-- Hero Section -->
    <header class="pt-32 pb-24 bg-gradient-to-b from-primary-50 to-white overflow-hidden relative">
        <div class="absolute top-20 right-[-10%] w-[40%] h-[40%] bg-primary-100/50 rounded-full blur-3xl -z-10 animate-pulse-soft"></div>
        <div class="absolute bottom-[-10%] left-[-5%] w-[30%] h-[30%] bg-primary-100/30 rounded-full blur-3xl -z-10"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary/10 text-primary text-xs font-bold mb-6 tracking-wider uppercase backdrop-blur-sm border border-primary/20">
                <i class="fas fa-sparkles"></i> Premium Website Templates
            </div>
            <h1 class="text-4xl md:text-6xl font-display font-black text-gray-900 mb-6 leading-tight">
                Pilih <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-primary-600 italic">Desain Impian</span><br>Untuk Bisnis Anda
            </h1>
            <p class="text-gray-600 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">
                Koleksi template premium yang responsif, modern, dan dioptimalkan untuk performa tinggi. Siap pakai untuk meningkatkan konversi.
            </p>
            
            <!-- Category Filter (Static for now) -->
            <div class="flex flex-wrap justify-center gap-3 md:gap-4 max-w-4xl mx-auto">
                <button class="px-6 py-3 rounded-2xl bg-primary text-white font-bold shadow-lg shadow-primary/20 transition-all">Semua Template</button>
                <button class="px-6 py-3 rounded-2xl bg-white border border-gray-100 text-gray-600 font-medium hover:border-primary/50 hover:text-primary transition-all">Company Profile</button>
                <button class="px-6 py-3 rounded-2xl bg-white border border-gray-100 text-gray-600 font-medium hover:border-primary/50 hover:text-primary transition-all">E-Commerce</button>
                <button class="px-6 py-3 rounded-2xl bg-white border border-gray-100 text-gray-600 font-medium hover:border-primary/50 hover:text-primary transition-all">Landing Page</button>
                <button class="px-6 py-3 rounded-2xl bg-white border border-gray-100 text-gray-600 font-medium hover:border-primary/50 hover:text-primary transition-all">Personal Portfolio</button>
            </div>
        </div>
    </header>

    <!-- Templates Grid -->
    <section class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                
                @forelse($templates as $template)
                    @php
                        $types = \App\Models\Template::getTypes();
                        $typeName = $types[$template->type] ?? $template->type;
                    @endphp
                    <!-- Template Item -->
                    <div class="group bg-white rounded-[2.5rem] overflow-hidden border border-gray-100 hover:shadow-[0_32px_64px_-16px_rgba(0,0,0,0.1)] transition-all duration-700 hover:-translate-y-4">
                        <div class="relative overflow-hidden aspect-[4/3]">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10"></div>
                            
                            {{-- Image handling - using random unplash based on category for now, or you could add image field to Template model later --}}
                            @php
                                $placeholderImages = [
                                    'company' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2426&auto=format&fit=crop',
                                    'ecommerce' => 'https://images.unsplash.com/photo-1557821552-17105176677c?q=80&w=2689&auto=format&fit=crop',
                                    'landing' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?q=80&w=2070&auto=format&fit=crop',
                                    'portfolio' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=2670&auto=format&fit=crop',
                                    'other' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=2072&auto=format&fit=crop'
                                ];
                                $imgUrl = $placeholderImages[$template->type] ?? $placeholderImages['other'];
                            @endphp

                            <img src="{{ $imgUrl }}" alt="{{ $template->name }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                            
                            <div class="absolute inset-x-0 bottom-0 p-6 translate-y-full group-hover:translate-y-0 transition-transform duration-500 z-20">
                                <button 
                                    x-on:click="openPreview('{{ $template->content_type === 'link' ? $template->content : route('template.preview', $template->id) }}', '{{ $template->content_type }}', '{{ $template->name }}')"
                                    class="w-full bg-white text-gray-900 py-4 rounded-2xl font-bold flex items-center justify-center gap-2 shadow-xl hover:bg-primary hover:text-white transition-all transform active:scale-95"
                                >
                                    <i class="fas fa-eye text-sm"></i> {{ $template->content_type === 'link' ? 'Live Preview' : 'Detail Template' }}
                                </button>
                            </div>

                            
                            @if($loop->first)
                            <div class="absolute top-6 left-6 z-20">
                                <span class="bg-primary text-white text-[10px] font-black px-3 py-1.5 rounded-full uppercase tracking-widest shadow-lg shadow-primary/20">Terbaru</span>
                            </div>
                            @endif
                        </div>
                        <div class="p-10">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="text-primary/60 text-[10px] font-black uppercase tracking-widest">{{ $typeName }}</span>
                            </div>
                            <h3 class="text-2xl font-black text-gray-900 mb-3 tracking-tight">{{ $template->name }}</h3>
                            
                            <div class="text-gray-500 text-sm leading-relaxed mb-8 line-clamp-3">
                                {!! strip_tags($template->content) !!}
                            </div>
                            
                            <div class="flex items-center justify-between pt-6 border-t border-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex -space-x-2">
                                        <div class="w-6 h-6 rounded-full border-2 border-white bg-blue-500 flex items-center justify-center text-[10px] text-white font-bold"><i class="fab fa-react"></i></div>
                                        <div class="w-6 h-6 rounded-full border-2 border-white bg-sky-400 flex items-center justify-center text-[10px] text-white font-bold"><i class="fab fa-laravel"></i></div>
                                        <div class="w-6 h-6 rounded-full border-2 border-white bg-indigo-500 flex items-center justify-center text-[10px] text-white font-bold"><i class="fab fa-js"></i></div>
                                    </div>
                                    <span class="text-[10px] text-gray-400 font-bold">Tech Stack</span>
                                </div>
                                <span class="text-xs text-gray-400 font-bold uppercase tracking-wider">Premium Design</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 py-20 text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-50 mb-6 text-gray-300 text-3xl">
                            <i class="fas fa-folder-open"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Katalog Sedang Diperbarui</h3>
                        <p class="text-gray-500">Kami sedang menyiapkan koleksi template premium untuk Anda. Silakan cek kembali beberapa saat lagi.</p>
                    </div>
                @endforelse


            </div>

            <!-- More Coming Soon -->
            <div class="mt-32 text-center">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-gray-50 mb-10 text-gray-300 text-4xl animate-bounce-slow border border-gray-100">
                    <i class="fas fa-plus"></i>
                </div>
                <h3 class="text-3xl font-black text-gray-900 mb-4 tracking-tight">Butuh Template <span class="text-primary">Kustom?</span></h3>
                <p class="text-gray-500 max-w-xl mx-auto mb-10 leading-relaxed text-lg">Kami terus menambahkan koleksi baru setiap minggu. Hubungi kami jika Anda memiliki permintaan khusus untuk desain bisnis Anda.</p>
                <a href="{{ url('/#kontak') }}" class="inline-flex items-center gap-3 bg-gray-900 hover:bg-black text-white px-10 py-5 rounded-2xl font-black transition-all shadow-2xl hover:shadow-black/20 hover:-translate-y-1">
                    Hubungi Kami Sekarang <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Trust & Quality Section -->
    <section class="py-24 bg-gray-50/50 overflow-hidden relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center p-8 bg-white rounded-3xl border border-gray-100 shadow-sm transition-all hover:shadow-md">
                    <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-6 text-primary text-2xl">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h4 class="font-black text-gray-900 mb-2 tracking-tight">Fully Responsive</h4>
                    <p class="text-gray-500 text-xs font-bold leading-relaxed uppercase tracking-wider">Tampilan Sempurna di Semua Perangkat</p>
                </div>
                <div class="text-center p-8 bg-white rounded-3xl border border-gray-100 shadow-sm transition-all hover:shadow-md">
                    <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-6 text-primary text-2xl">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h4 class="font-black text-gray-900 mb-2 tracking-tight">High Performance</h4>
                    <p class="text-gray-500 text-xs font-bold leading-relaxed uppercase tracking-wider">Loading Cepat & SEO Friendly</p>
                </div>
                <div class="text-center p-8 bg-white rounded-3xl border border-gray-100 shadow-sm transition-all hover:shadow-md">
                    <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-6 text-primary text-2xl">
                        <i class="fas fa-code"></i>
                    </div>
                    <h4 class="font-black text-gray-900 mb-2 tracking-tight">Clean Code</h4>
                    <p class="text-gray-500 text-xs font-bold leading-relaxed uppercase tracking-wider">Struktur Rapi & Mudah Dimodifikasi</p>
                </div>
                <div class="text-center p-8 bg-white rounded-3xl border border-gray-100 shadow-sm transition-all hover:shadow-md">
                    <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-6 text-primary text-2xl">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4 class="font-black text-gray-900 mb-2 tracking-tight">Full Support</h4>
                    <p class="text-gray-500 text-xs font-bold leading-relaxed uppercase tracking-wider">Bantuan Instalasi & Kustomisasi</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-32 bg-primary relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_30%,rgba(255,255,255,0.15)_0%,transparent_50%)]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_70%,rgba(255,255,255,0.15)_0%,transparent_50%)]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-4xl md:text-6xl font-black text-white mb-8 tracking-tighter">Sudah Menemukan <span class="text-gray-900 italic">Desain</span> yang Cocok?</h2>
            <p class="text-xl text-white/80 max-w-2xl mx-auto mb-12 font-bold leading-relaxed">Jangan tunda lagi untuk membuat bisnis Anda online dengan kualitas terbaik.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <a href="{{ url('/#kontak') }}" class="bg-white text-primary px-12 py-5 rounded-[2rem] font-black text-lg transition-all shadow-2xl hover:scale-105 active:scale-95">Konsultasi via WhatsApp</a>
                <a href="{{ url('/#layanan') }}" class="bg-primary-dark text-white px-12 py-5 rounded-[2rem] font-black text-lg transition-all border border-white/20 hover:bg-white hover:text-primary">Lihat Layanan Lainnya</a>
            </div>
        </div>
    </section>

    <!-- Scalar Style Modal (Live Preview) -->
    <template x-if="isOpen">
        <div 
            class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6 lg:p-10"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        >
            <!-- Backdrop -->
            <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-md" x-on:click="closePreview()"></div>

            <!-- Modal Content -->
            <div 
                id="preview-container"
                class="bg-white border border-slate-200 rounded-[2.5rem] overflow-hidden shadow-2xl relative w-full h-full max-w-7xl flex flex-col transition-all duration-500"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 scale-95 translate-y-10"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                :class="isFullscreen ? 'max-w-none rounded-none' : ''"
            >
                <!-- Controls Header (Scalar Style) -->
                <div class="absolute top-6 left-0 right-0 z-[120] px-6 flex items-center justify-between pointer-events-none">
                    <!-- Left: Close -->
                    <button 
                        x-on:click="closePreview()"
                        class="pointer-events-auto bg-white/90 backdrop-blur-sm border border-slate-200 p-3 rounded-2xl text-slate-600 hover:text-red-500 transition-all shadow-lg hover:shadow-xl group"
                    >
                        <i class="fas fa-times group-hover:rotate-90 transition-transform"></i>
                    </button>

                    <!-- Center: Device Switcher -->
                    <div class="pointer-events-auto flex items-center gap-1 p-1.5 bg-white/90 backdrop-blur-sm border border-slate-200 rounded-2xl shadow-lg">
                        <button 
                            x-on:click="device = 'desktop'"
                            class="w-10 h-10 flex items-center justify-center rounded-xl transition-all"
                            :class="device === 'desktop' ? 'bg-primary text-white shadow-md' : 'text-slate-400 hover:bg-slate-50 hover:text-slate-600'"
                        >
                            <i class="fas fa-desktop text-xs"></i>
                        </button>
                        <button 
                            x-on:click="device = 'tablet'"
                            class="w-10 h-10 flex items-center justify-center rounded-xl transition-all"
                            :class="device === 'tablet' ? 'bg-primary text-white shadow-md' : 'text-slate-400 hover:bg-slate-50 hover:text-slate-600'"
                        >
                            <i class="fas fa-tablet-alt text-xs"></i>
                        </button>
                        <button 
                            x-on:click="device = 'mobile'"
                            class="w-10 h-10 flex items-center justify-center rounded-xl transition-all"
                            :class="device === 'mobile' ? 'bg-primary text-white shadow-md' : 'text-slate-400 hover:bg-slate-50 hover:text-slate-600'"
                        >
                            <i class="fas fa-mobile-alt text-xs"></i>
                        </button>
                    </div>

                    <!-- Right: Fullscreen & New Tab -->
                    <div class="pointer-events-auto flex items-center gap-3">
                        <button 
                            x-on:click="toggleFullscreen()"
                            class="bg-white/90 backdrop-blur-sm border border-slate-200 p-3 rounded-2xl text-slate-600 hover:text-primary transition-all shadow-lg hover:shadow-xl"
                            title="Penuhi Layar"
                        >
                            <i class="fas" :class="isFullscreen ? 'fa-compress' : 'fa-expand'"></i>
                        </button>
                        <a 
                            :href="previewUrl" 
                            target="_blank"
                            class="bg-primary text-white px-6 py-3 rounded-2xl font-bold flex items-center gap-2 shadow-lg hover:shadow-primary/30 transition-all hover:-translate-y-0.5"
                        >
                            <span class="text-xs">Buka Tab Baru</span>
                            <i class="fas fa-external-link-alt text-[10px]"></i>
                        </a>
                    </div>
                </div>

                <!-- Template Info Floating Label -->
                <div class="absolute bottom-6 left-6 z-[120]">
                    <div class="bg-slate-900/80 backdrop-blur-md text-white px-5 py-2.5 rounded-2xl border border-white/10 shadow-2xl flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></div>
                        <span class="text-xs font-bold tracking-wide" x-text="templateName"></span>
                    </div>
                </div>

                <!-- Preview Area -->
                <div class="flex-1 overflow-hidden bg-slate-100 flex items-center justify-center p-4">
                    <!-- Loading State -->
                    <template x-if="loading">
                        <div class="absolute inset-0 z-50 flex flex-col items-center justify-center bg-white">
                            <div class="relative w-20 h-20 mb-6">
                                <div class="absolute inset-0 border-4 border-primary/20 rounded-full"></div>
                                <div class="absolute inset-0 border-4 border-primary border-t-transparent rounded-full animate-spin"></div>
                            </div>
                            <p class="text-slate-400 text-sm font-medium animate-pulse">Menghubungkan ke server demo...</p>
                        </div>
                    </template>

                    <!-- Viewport Simulation -->
                    <div 
                        class="h-full transition-all duration-700 ease-[cubic-bezier(0.34,1.56,0.64,1)] relative overflow-hidden bg-white shadow-2xl"
                        :class="{
                            'w-full rounded-none': device === 'desktop',
                            'w-[768px] h-full max-h-[95%] rounded-[2rem] border-[12px] border-slate-900': device === 'tablet',
                            'w-[375px] h-full max-h-[85%] rounded-[3rem] border-[12px] border-slate-900': device === 'mobile'
                        }"
                    >
                        <iframe 
                            :src="previewUrl" 
                            class="w-full h-full transition-opacity duration-300"
                            :class="loading ? 'opacity-0' : 'opacity-100'"
                            x-on:load="loading = false"
                            frameborder="0"
                        ></iframe>

                        <!-- Speaker/Camera details for mobile/tablet -->
                        <div x-show="device === 'mobile'" class="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-6 bg-slate-900 rounded-b-2xl z-10"></div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>


    <style>
        .animate-pulse-soft {
            animation: pulse-soft 8s infinite ease-in-out;
        }
        @keyframes pulse-soft {
            0%, 100% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 0.6; transform: scale(1.1); }
        }
        .animate-bounce-slow {
            animation: bounce-slow 3s infinite ease-in-out;
        }
        @keyframes bounce-slow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
    </style>
@endsection
