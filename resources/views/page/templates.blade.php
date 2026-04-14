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
    getSnapshotUrl() {
        if (!this.previewUrl) return '';
        return `https://s.wordpress.com/mshots/v1/${encodeURIComponent(this.previewUrl)}?w=1280`;
    },
    openPreview(url, type, name) {
        this.previewUrl = url;
        this.contentType = type;
        this.templateName = name;
        this.isOpen = true;
        this.loading = true;
        this.device = 'desktop';
        document.body.style.overflow = 'hidden';
    },
    closePreview() {
        this.isOpen = false;
        document.body.style.overflow = 'auto';
        this.previewUrl = '';
    }
}" @keydown.escape.window="closePreview()">

    <!-- Hero Section -->
    <header class="pt-32 pb-24 bg-gradient-to-b from-primary-50 to-white overflow-hidden relative">
        <div class="absolute top-20 right-[-10%] w-[40%] h-[40%] bg-primary-100/50 rounded-full blur-3xl -z-10 animate-pulse-soft"></div>
        <div class="absolute bottom-[-10%] left-[-5%] w-[30%] h-[30%] bg-primary-100/30 rounded-full blur-3xl -z-10"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary/10 text-primary text-xs font-bold mb-6 tracking-wider uppercase backdrop-blur-sm border border-primary/20">
                <i class="fas fa-sparkles"></i> Premium Website Templates
            </div>
            <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 mb-8 tracking-tight leading-tight">
                Pilih <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary to-primary-dark italic">Template Impian</span> Anda
            </h1>
            <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto mb-12 leading-relaxed">
                Koleksi desain website modern yang siap pakai, dioptimalkan untuk performa tinggi dan konversi maksimal untuk bisnis Anda.
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
                                @if($template->content_type === 'link')
                                    <button 
                                        @click="openPreview('{{ $template->content }}', 'link', '{{ $template->name }}')"
                                        class="w-full bg-white text-gray-900 py-4 rounded-2xl font-bold flex items-center justify-center gap-2 shadow-xl hover:bg-primary hover:text-white transition-all transform active:scale-95"
                                    >
                                        <i class="fas fa-eye text-sm"></i> Live Preview
                                    </button>
                                @else
                                    <button 
                                        @click="openPreview('{{ route('template.preview', $template->id) }}', 'html', '{{ $template->name }}')"
                                        class="w-full bg-white text-gray-900 py-4 rounded-2xl font-bold flex items-center justify-center gap-2 shadow-xl hover:bg-primary hover:text-white transition-all transform active:scale-95"
                                    >
                                        <i class="fas fa-eye text-sm"></i> Detail Template
                                    </button>
                                @endif
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

    <!-- Premium Preview Modal -->
    <template x-teleport="body">
        <div 
            x-show="isOpen" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[100] flex flex-col bg-gray-900/90 backdrop-blur-md"
            x-cloak
            @click.away="closePreview()"
        >
            <!-- Modal Header -->
            <div class="flex items-center justify-between px-6 py-4 bg-white/10 backdrop-blur-md border-b border-white/10">
                <div class="flex items-center gap-4">
                    <button @click="closePreview()" class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-white hover:bg-red-500 transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                    <div>
                        <h4 class="text-white font-bold leading-none" x-text="templateName"></h4>
                        <p class="text-white/50 text-[10px] font-bold uppercase tracking-widest mt-1">Sistem Live Preview</p>
                    </div>
                </div>

                <!-- Device Controls -->
                <div class="hidden md:flex items-center gap-2 bg-black/20 p-1.5 rounded-2xl border border-white/5">
                    <button @click="device = 'desktop'" :class="device === 'desktop' ? 'bg-primary text-white' : 'text-white/40 hover:text-white'" class="w-10 h-10 rounded-xl flex items-center justify-center transition-all">
                        <i class="fas fa-desktop"></i>
                    </button>
                    <button @click="device = 'tablet'" :class="device === 'tablet' ? 'bg-primary text-white' : 'text-white/40 hover:text-white'" class="w-10 h-10 rounded-xl flex items-center justify-center transition-all">
                        <i class="fas fa-tablet-alt"></i>
                    </button>
                    <button @click="device = 'mobile'" :class="device === 'mobile' ? 'bg-primary text-white' : 'text-white/40 hover:text-white'" class="w-10 h-10 rounded-xl flex items-center justify-center transition-all">
                        <i class="fas fa-mobile-alt"></i>
                    </button>
                </div>

                <div class="flex items-center gap-3">
                    <a :href="previewUrl" target="_blank" class="px-6 py-2.5 rounded-xl bg-white text-gray-900 text-xs font-bold hover:bg-primary hover:text-white transition-all flex items-center gap-2">
                        Buka Tab Baru <i class="fas fa-external-link-alt text-[10px]"></i>
                    </a>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="flex-1 relative overflow-hidden flex items-center justify-center p-4 md:p-8">
                <!-- Loading State -->
                <div x-show="loading" class="absolute inset-0 flex flex-col items-center justify-center z-10">
                    <div class="w-12 h-12 border-4 border-primary/20 border-t-primary rounded-full animate-spin mb-4"></div>
                    <p class="text-white/50 font-bold text-xs uppercase tracking-widest animate-pulse">Menyiapkan Preview...</p>
                </div>

                <div 
                    class="h-full transition-all duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)] relative overflow-hidden"
                    :class="{
                        'w-full max-w-none': device === 'desktop',
                        'w-[768px] h-full max-h-[1024px] rounded-[2rem] border-[12px] border-gray-800 shadow-2xl': device === 'tablet',
                        'w-[375px] h-full max-h-[667px] rounded-[3rem] border-[12px] border-gray-800 shadow-2xl': device === 'mobile'
                    }"
                >
                    <!-- Iframe for HTML Template -->
                    <template x-if="contentType === 'html'">
                        <iframe 
                            :src="previewUrl" 
                            class="w-full h-full bg-white"
                            @load="loading = false"
                            frameborder="0"
                        ></iframe>
                    </template>

                    <!-- Snapshot for External Links (bypass iframe blocking) -->
                    <template x-if="contentType === 'link'">
                        <div class="w-full h-full bg-white overflow-y-auto custom-scrollbar">
                            <img 
                                :src="getSnapshotUrl()" 
                                class="w-full h-auto min-h-full object-top"
                                @load="loading = false"
                                @error="loading = false"
                            >
                        </div>
                    </template>

                    <!-- Reflection / Glass effect for devices -->
                    <div x-show="device !== 'desktop'" class="absolute inset-0 pointer-events-none bg-gradient-to-tr from-transparent via-white/5 to-transparent opacity-30"></div>
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
