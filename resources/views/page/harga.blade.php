@extends('layouts.app')

@section('title', 'Daftar Harga Layanan - ' . setting('site_name', 'Andrew.Devlog'))

@section('content')
    @php
        $categories = \App\Models\ServiceCategory::whereNull('parent_id')
                        ->with(['children' => function($q) {
                            $q->orderBy('order')->orderBy('name');
                        }])
                        ->orderBy('order')
                        ->orderBy('name')
                        ->get();
        $currentCategory = $currentCategory ?? null;
        $activeParent = $currentCategory 
            ? ($currentCategory->parent_id ? \App\Models\ServiceCategory::find($currentCategory->parent_id) : $currentCategory)
            : null;
    @endphp

    <!-- Hero Section -->
    <header class="pt-32 pb-16 px-4 bg-gradient-to-b from-primary-50 to-white overflow-hidden relative">
        <!-- Background Decorations -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary/5 rounded-full blur-2xl translate-y-1/2 -translate-x-1/2"></div>

        <div class="max-w-7xl mx-auto text-center space-y-6 relative z-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary/10 border border-primary/20 text-primary text-xs font-bold uppercase tracking-widest mb-4">
                <i class="fas fa-tag"></i> Harga Terbaik & Transparan
            </div>
            <h1 class="text-4xl md:text-6xl font-black text-gray-900 tracking-tight leading-tight">
                Dapatkan <span class="text-primary underline decoration-primary/20 decoration-8 underline-offset-8">Layanan</span> Impian Anda
            </h1>
            <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                {{ $currentCategory ? 'Solusi pengerjaan ' . $currentCategory->name . ' profesional yang disesuaikan dengan kebutuhan bisnis Anda.' : 'Pilih paket yang paling sesuai dengan target dan skala bisnis Anda. Transparan tanpa biaya tersembunyi.' }}
            </p>
            
            <div class="relative max-w-2xl mx-auto mt-10">
                <div class="absolute inset-y-0 left-5 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input 
                    type="text"
                    id="pricing-search"
                    placeholder="Cari paket atau fitur layanan..."
                    class="w-full pl-14 pr-32 py-5 bg-white border border-gray-100 rounded-3xl shadow-xl focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all outline-none text-gray-700"
                />
                <button class="absolute right-2.5 top-2.5 bottom-2.5 bg-primary text-white px-8 rounded-2xl font-bold hover:bg-primary-dark transition-colors shadow-lg shadow-primary/20">
                    Cari
                </button>
            </div>
        </div>
    </header>

    <!-- Pricing Content -->
    <section class="pb-24 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Category Navigation -->
            <div class="sticky top-20 z-30 bg-white/95 backdrop-blur-md py-6 mb-16 -mx-4 px-4 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 border-b border-gray-100/50">
                <!-- Parent Categories -->
                <div class="flex overflow-x-auto sm:flex-wrap justify-start sm:justify-center gap-3 hide-scrollbar pb-1 sm:pb-0">
                    <a href="{{ route('harga') }}" 
                       class="whitespace-nowrap px-6 py-3 rounded-2xl font-bold text-sm transition-all duration-300 border {{ !$currentCategory ? 'bg-primary text-white shadow-xl shadow-primary/20 border-primary' : 'bg-gray-50 text-gray-500 border-transparent hover:bg-primary/5 hover:text-primary hover:border-primary/20' }}">
                        Semua Layanan
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('harga', ['category' => $category->slug]) }}" 
                           class="whitespace-nowrap flex items-center gap-2 px-6 py-3 rounded-2xl font-bold text-sm transition-all duration-300 border {{ $activeParent && $activeParent->id == $category->id ? 'bg-primary text-white shadow-xl shadow-primary/20 border-primary' : 'bg-gray-50 text-gray-500 border-transparent hover:bg-primary/5 hover:text-primary hover:border-primary/20' }}">
                            <i class="{{ $category->icon ?? 'fas fa-th-large' }} {{ $activeParent && $activeParent->id == $category->id ? 'text-white' : 'text-primary/40' }}"></i>
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>

                <!-- Child Categories (Sub-menu) -->
                @if($activeParent && $activeParent->children->count() > 0)
                <div class="flex overflow-x-auto sm:flex-wrap justify-start sm:justify-center gap-2 mt-4 pb-2 p-2 rounded-2xl border border-dashed border-gray-100 bg-gray-50/30 hide-scrollbar">
                    @foreach($activeParent->children as $child)
                        <a href="{{ route('harga', ['category' => $child->slug]) }}" 
                           class="whitespace-nowrap px-4 py-2 rounded-xl text-xs font-bold transition-all duration-300 border {{ $currentCategory && $currentCategory->id == $child->id ? 'bg-white text-primary border-primary/20 shadow-md' : 'text-gray-400 border-transparent hover:text-gray-600' }}">
                            {{ $child->name }}
                        </a>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Pricing Grid -->
            <div id="pricing-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($prices as $price)
                <div id="package-{{ $price->id }}" class="pricing-card group bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col h-full relative overflow-hidden" data-name="{{ strtolower($price->service_name) }}">
                    <!-- Popular Badge -->
                    @if($price->is_popular)
                    <div class="absolute top-0 right-0">
                        <div class="bg-primary text-white text-[10px] font-black uppercase tracking-[0.2em] px-10 py-1.5 rotate-45 translate-x-[40px] translate-y-[20px] shadow-sm">
                            Best Sell
                        </div>
                    </div>
                    @endif

                    <!-- Icon / Label -->
                    <div class="w-16 h-16 bg-primary/5 text-primary rounded-[1.5rem] flex items-center justify-center mb-8 group-hover:bg-primary group-hover:text-white transition-all duration-300 shadow-inner">
                        <i class="{{ $currentCategory->icon ?? 'fas fa-rocket' }} text-2xl"></i>
                    </div>

                    <div class="mb-2">
                        <h4 class="text-xl font-black text-gray-900 group-hover:text-primary transition-colors">{{ $price->service_name }}</h4>
                    </div>
                    
                    <div class="mb-8">
                        <div class="flex items-baseline gap-1">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Mulai</span>
                            <span class="text-3xl font-black text-gray-900">Rp {{ number_format($price->price, 0, ',', '.') }}</span>
                        </div>
                        <span class="text-[10px] font-bold text-primary/60 uppercase tracking-widest block mt-2 px-3 py-1 bg-primary/5 rounded-full w-fit italic">Satu kali pengerjaan</span>
                    </div>

                    <ul class="space-y-4 mb-10 grow">
                        @foreach($price->features as $feature)
                        <li class="flex items-start gap-3 text-sm font-medium text-gray-500 hover:text-gray-900 transition-colors">
                            <i class="fas fa-check-circle text-primary mt-0.5 opacity-40 group-hover:opacity-100 transition-opacity"></i> 
                            <span>{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>

                    <a href="{{ route('pesan', ['package' => $price->service_name, 'category_id' => $price->service_category_id]) }}" class="w-full flex items-center justify-center gap-3 py-4 bg-gray-950 text-white rounded-2xl font-bold group-hover:bg-primary transition-all shadow-xl shadow-gray-200 group-hover:shadow-primary/30">
                        Pesan Sekarang
                        <i class="fas fa-chevron-right text-xs group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
                @empty
                <div class="col-span-full py-20 text-center">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-50 rounded-full mb-8 border border-dashed border-gray-200">
                        <i class="fas fa-cube text-gray-200 text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-300 uppercase tracking-widest italic">Layanan Belum Tersedia</h3>
                    <p class="text-gray-400 mt-2">Segera hadir paket spesial untuk {{ $currentCategory->name ?? 'kategori ini' }}.</p>
                </div>
                @endforelse

                <!-- Custom Request Card -->
                <div class="bg-gradient-to-br from-primary to-primary-dark p-10 rounded-[2.5rem] text-white flex flex-col justify-between shadow-2xl shadow-primary/30 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 group-hover:bg-white/20 transition-all"></div>
                    
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-[1.5rem] flex items-center justify-center mb-8">
                            <i class="fas fa-magic text-2xl text-white"></i>
                        </div>
                        <h3 class="text-3xl font-black mb-4">Request Khusus?</h3>
                        <p class="text-primary-100 leading-relaxed mb-10 font-medium">
                            Punya ide unik yang membutuhkan penanganan spesifik? Kami siap membangun solusi kustom dari nol sesuai spesifikasi Anda.
                        </p>
                    </div>
                    <a href="{{ url('/#kontak') }}" class="w-full py-5 bg-white text-primary rounded-[1.25rem] font-black text-center hover:bg-gray-50 transition-all shadow-xl transform active:scale-95">
                        Konsultasi Gratis
                    </a>
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
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        .pricing-card {
            backface-visibility: hidden;
        }

        .underline-animation::after {
            content: '';
            display: block;
            width: 0;
            height: 8px;
            background: rgba(14, 165, 233, 0.2);
            transition: width .3s;
            margin-top: -12px;
        }
        .underline-animation:hover::after {
            width: 100%;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('pricing-search');
            const cards = document.querySelectorAll('.pricing-card');

            searchInput.addEventListener('input', function(e) {
                const term = e.target.value.toLowerCase();
                
                cards.forEach(card => {
                    const name = card.getAttribute('data-name');
                    if (name.includes(term)) {
                        card.style.display = 'flex';
                        card.classList.add('fade-in');
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection
