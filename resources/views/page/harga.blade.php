@extends('layouts.app')

@section('title', 'Daftar Layanan - ' . setting('site_name', 'Andrew.Devlog'))

@section('content')
    @php
        $categories = \App\Models\ServiceCategory::whereNull('parent_id')
                        ->with(['children' => function($q) {
                            $q->orderBy('order')->orderBy('name');
                        }])
                        ->orderBy('order')
                        ->orderBy('name')
                        ->get();
    @endphp

    <!-- Hero Section -->
    <header class="pt-32 pb-16 px-4 bg-gradient-to-b from-primary-50 to-white overflow-hidden relative">
        <!-- Background Decorations -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary/5 rounded-full blur-2xl translate-y-1/2 -translate-x-1/2"></div>

        <div class="max-w-7xl mx-auto text-center space-y-6 relative z-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary/10 border border-primary/20 text-primary text-xs font-bold uppercase tracking-widest mb-4">
                <i class="fas fa-rocket"></i> Pilih Solusi Digital Anda
            </div>
            <h1 class="text-4xl md:text-6xl font-black text-gray-900 tracking-tight leading-tight">
                Layanan <span class="text-primary underline decoration-primary/20 decoration-8 underline-offset-8">Profesional</span> Untuk Anda
            </h1>
            <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Temukan kategori layanan yang sesuai dengan kebutuhan bisnis atau proyek Anda. Klik kategori untuk melihat detail paket harga.
            </p>
            
            <div class="relative max-w-2xl mx-auto mt-10">
                <div class="absolute inset-y-0 left-5 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input 
                    type="text"
                    id="category-search"
                    placeholder="Cari kategori layanan (Web, Mobile, Skripsi, dll)..."
                    class="w-full pl-14 pr-32 py-5 bg-white border border-gray-100 rounded-3xl shadow-xl focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all outline-none text-gray-700 font-medium"
                />
            </div>
        </div>
    </header>

    <!-- Category Selection Portal -->
    <section class="pb-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" id="category-grid">
                @foreach($categories as $category)
                <a href="{{ route('harga.layanan', $category->slug) }}" 
                   data-name="{{ strtolower($category->name) }}"
                   class="category-card group flex flex-col h-full bg-white rounded-[2.5rem] border border-gray-100 shadow-sm transition-all duration-500 hover:shadow-2xl hover:shadow-primary/10 hover:-translate-y-2 relative overflow-hidden">
                    
                    <!-- Card Header with Image -->
                    <div class="relative h-64 overflow-hidden">
                        @php
                            $imageUrl = $category->image ?: "https://images.unsplash.com/featured/?" . strtolower(str_replace(' ', ',', $category->name));
                        @endphp
                        <img src="{{ $imageUrl }}" alt="{{ $category->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        <!-- Dark Overlay Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
                        
                        <!-- Title Overlay -->
                        <div class="absolute bottom-6 left-8 right-8">
                            <h3 class="text-3xl font-black text-white uppercase tracking-tighter leading-tight">
                                {{ $category->name }}
                            </h3>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-primary">Eksplor Layanan</span>
                                <i class="fas fa-arrow-right text-[10px] text-primary transition-transform group-hover:translate-x-1"></i>
                            </div>
                        </div>

                        <!-- Icon Badge -->
                        <div class="absolute top-6 left-8 w-12 h-12 rounded-xl bg-white/10 backdrop-blur-md border border-white/10 flex items-center justify-center text-white">
                            <i class="{{ $category->icon ?? 'fas fa-th-large' }} text-xl"></i>
                        </div>
                    </div>

                    <div class="p-8 grow flex flex-col bg-white">
                        <p class="text-gray-500 text-sm font-medium leading-relaxed mb-6">
                            {{ $category->description ?? 'Lihat berbagai pilihan paket ' . strtolower($category->name) . ' profesional yang kami sediakan untuk kebutuhan Anda.' }}
                        </p>
                        
                        <div class="mt-auto flex items-center justify-between pt-6 border-t border-gray-50">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest group-hover:text-primary transition-colors">Lihat Detail</span>
                            <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-primary group-hover:text-white transition-all">
                                <i class="fas fa-chevron-right text-xs"></i>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach

                <!-- Custom Request Portal Card -->
                <div class="category-card group flex flex-col h-full bg-[#0b0f1a] rounded-[2.5rem] text-white relative overflow-hidden hover:shadow-2xl transition-all duration-500 hover:-translate-y-2" data-name="kustom custom khusus">
                    <div class="absolute -top-24 -right-24 w-48 h-48 bg-primary/20 rounded-full blur-3xl"></div>
                    
                    <div class="p-10 flex flex-col h-full relative z-10">
                        <div class="w-16 h-16 rounded-2xl mb-8 bg-white/10 backdrop-blur-md border border-white/10 flex items-center justify-center text-primary">
                            <i class="fas fa-magic text-2xl"></i>
                        </div>

                        <h3 class="text-3xl font-black mb-4">Request Kustom</h3>
                        <p class="text-gray-400 text-sm font-medium leading-relaxed mb-10 grow">
                            Punya kebutuhan spesifik yang tidak ada di daftar? Kami siap membantu membangun solusi digital kustom yang dipersonalisasi khusus untuk bisnis Anda.
                        </p>

                        <a href="{{ url('/#kontak') }}" class="w-full py-5 bg-primary text-white font-black text-center rounded-[1.5rem] hover:bg-white hover:text-primary transition-all uppercase tracking-widest text-sm shadow-lg shadow-primary/20">
                            Mulai Konsultasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us / Features -->
    <section class="bg-gray-50/50 py-24 border-y border-gray-100 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-black text-gray-900 uppercase tracking-widest mb-4">Kenapa Memilih Kami?</h2>
                <div class="w-20 h-1.5 bg-primary/20 mx-auto rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
                <div class="space-y-4 group">
                    <div class="inline-flex p-6 bg-white rounded-[2rem] mb-4 shadow-sm group-hover:shadow-xl transition-all group-hover:-translate-y-2">
                        <i class="fas fa-clock text-4xl text-primary"></i>
                    </div>
                    <h4 class="text-xl font-black text-gray-900">Pengerjaan Cepat</h4>
                    <p class="text-gray-500 leading-relaxed px-6">Proses development efisien dengan timeline yang terukur dan tepat waktu.</p>
                </div>
                
                <div class="space-y-4 group">
                    <div class="inline-flex p-6 bg-white rounded-[2rem] mb-4 shadow-sm group-hover:shadow-xl transition-all group-hover:-translate-y-2">
                        <i class="fas fa-award text-4xl text-primary"></i>
                    </div>
                    <h4 class="text-xl font-black text-gray-900">Kualitas Premium</h4>
                    <p class="text-gray-500 leading-relaxed px-6">Standar kode tinggi, performa optimal, dan desain UI/UX yang modern.</p>
                </div>
                
                <div class="space-y-4 group">
                    <div class="inline-flex p-6 bg-white rounded-[2rem] mb-4 shadow-sm group-hover:shadow-xl transition-all group-hover:-translate-y-2">
                        <i class="fas fa-headset text-4xl text-primary"></i>
                    </div>
                    <h4 class="text-xl font-black text-gray-900">Support Berkelanjutan</h4>
                    <p class="text-gray-500 leading-relaxed px-6">Layanan maintenance dan konsultasi gratis pasca proyek selesai.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 px-4 bg-white">
        <div class="max-w-6xl mx-auto relative overflow-hidden bg-[#0b0f1a] rounded-[3rem] p-12 md:p-24 text-center group">
            <!-- Neon Glow Borders -->
            <div class="absolute inset-0 border border-primary/10 rounded-[3rem]"></div>
            <div class="absolute top-0 left-0 w-80 h-80 bg-primary/10 rounded-full -translate-x-1/2 -translate-y-1/2 blur-[100px]"></div>
            <div class="absolute bottom-0 right-0 w-80 h-80 bg-primary/5 rounded-full translate-x-1/3 translate-y-1/3 blur-[100px]"></div>
            
            <div class="relative z-10 space-y-10">
                <h2 class="text-4xl md:text-6xl font-black text-white leading-tight tracking-tight">
                    Siap Membangun <span class="text-primary">Masa Depan</span> Digital Anda?
                </h2>
                <p class="text-gray-400 text-lg md:text-xl max-w-2xl mx-auto font-medium">
                    Konsultasikan ide brilian Anda sekarang dan dapatkan estimasi harga terbaik secara gratis bersama tim ahli kami.
                </p>
                <div class="flex flex-col sm:flex-row gap-6 justify-center pt-6">
                    <a href="{{ url('/#kontak') }}" class="px-12 py-5 bg-primary text-white rounded-3xl font-black text-lg hover:bg-primary-dark transition-all shadow-2xl shadow-primary/40 transform hover:scale-105 active:scale-95">
                        Mulai Proyek
                    </a>
                    <a href="{{ setting('whatsapp_link', 'https://wa.me/xxx') }}" target="_blank" class="px-12 py-5 bg-white/5 text-white backdrop-blur-xl border border-white/10 rounded-3xl font-black text-lg hover:bg-white/10 transition-all flex items-center justify-center gap-3">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>

    <style>
        .animate-fade-in { animation: fadeIn 0.5s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('category-search');
            const cards = document.querySelectorAll('.category-card');

            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const term = e.target.value.toLowerCase();
                    cards.forEach(card => {
                        const name = card.getAttribute('data-name');
                        if (name.includes(term)) {
                            card.style.display = 'flex';
                            card.classList.add('animate-fade-in');
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            }
        });
    </script>
@endsection
