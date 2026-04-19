@extends('layouts.app')

@section('title', $currentCategory->name . ' - ' . setting('site_name', 'Andrew.Devlog'))

@section('content')
    @php
        $activeParent = $currentCategory->parent_id 
            ? \App\Models\ServiceCategory::find($currentCategory->parent_id) 
            : $currentCategory;
        
        $siblings = $activeParent->children;
    @endphp

    <!-- Hero Section -->
    <header class="pt-32 pb-16 px-4 bg-gradient-to-b from-primary-50 to-white overflow-hidden relative">
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        
        <div class="max-w-7xl mx-auto relative z-10 text-center md:text-left">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="w-24 h-24 md:w-32 md:h-32 rounded-[2.5rem] bg-white shadow-2xl shadow-primary/20 flex items-center justify-center text-primary border border-primary/10">
                    <i class="{{ $currentCategory->icon ?? 'fas fa-rocket' }} text-4xl md:text-5xl"></i>
                </div>
                <div class="flex-grow space-y-4">
                    <div class="flex items-center justify-center md:justify-start gap-3">
                        <a href="{{ route('harga') }}" class="text-xs font-black uppercase tracking-widest text-primary hover:underline flex items-center gap-2">
                            <i class="fas fa-arrow-left text-[10px]"></i> Semua Layanan
                        </a>
                        @if($currentCategory->parent_id)
                        <span class="text-gray-300">/</span>
                        <span class="text-xs font-black uppercase tracking-widest text-gray-400">{{ $activeParent->name }}</span>
                        @endif
                    </div>
                    <h1 class="text-4xl md:text-6xl font-black text-gray-900 tracking-tight leading-tight">
                        Paket <span class="text-primary">{{ $currentCategory->name }}</span>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl leading-relaxed">
                        {{ $currentCategory->description ?? 'Solusi pengerjaan ' . strtolower($currentCategory->name) . ' profesional yang disesuaikan dengan kebutuhan bisnis Anda.' }}
                    </p>
                </div>
            </div>

            <!-- Sub-categories / Siblings Filter -->
            @if($siblings->count() > 0 || $currentCategory->parent_id)
            <div class="mt-12 flex flex-col items-center md:items-start">
                <div class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-4">Varian Layanan</div>
                <div class="flex flex-wrap justify-center md:justify-start gap-3">
                    <a href="{{ route('harga.layanan', $activeParent->slug) }}" 
                       class="px-6 py-3 rounded-2xl text-xs font-bold transition-all border {{ $currentCategory->id == $activeParent->id ? 'bg-primary text-white border-primary shadow-xl shadow-primary/20' : 'bg-white text-gray-500 border-gray-100 hover:border-primary/30 hover:text-primary' }}">
                        Semua {{ $activeParent->name }}
                    </a>
                    @foreach($siblings as $sibling)
                    <a href="{{ route('harga.layanan', $sibling->slug) }}" 
                       class="px-6 py-3 rounded-2xl text-xs font-bold transition-all border {{ $currentCategory->id == $sibling->id ? 'bg-primary text-white border-primary shadow-xl shadow-primary/20' : 'bg-white text-gray-500 border-gray-100 hover:border-primary/30 hover:text-primary' }}">
                        {{ $sibling->name }}
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </header>

    <!-- Pricing Content -->
    <section class="pb-24 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Search within category -->
            <div class="relative max-w-xl mx-auto mb-16 -mt-8">
                <div class="absolute inset-y-0 left-5 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input 
                    type="text"
                    id="pricing-search"
                    placeholder="Cari paket atau fitur di kategori ini..."
                    class="w-full pl-14 pr-6 py-5 bg-white border border-gray-100 rounded-[2rem] shadow-xl focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all outline-none text-gray-700 font-medium"
                />
            </div>

            <!-- Pricing Grid -->
            <div id="pricing-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($prices as $price)
                <div class="pricing-card group bg-white rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col h-full relative overflow-hidden" data-name="{{ strtolower($price->service_name) }}">
                    <!-- Card Header with Image -->
                    <div class="relative h-56 overflow-hidden">
                        @php
                            $imageUrl = $currentCategory->image ?: "https://images.unsplash.com/featured/?" . strtolower(str_replace(' ', ',', $currentCategory->name . ' ' . $price->service_name));
                        @endphp
                        <img src="{{ $imageUrl }}" alt="{{ $price->service_name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        <!-- Dark Overlay Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        
                        <!-- Title Overlay -->
                        <div class="absolute bottom-6 left-8 right-8">
                            <h4 class="text-2xl font-black text-white uppercase tracking-tighter leading-tight drop-shadow-lg">
                                {{ $price->service_name }}
                            </h4>
                        </div>

                        <!-- Popular Badge -->
                        @if($price->is_popular)
                        <div class="absolute top-4 right-4 bg-primary text-white text-[10px] font-black uppercase tracking-widest px-4 py-1.5 rounded-full shadow-lg">
                            Best Sell
                        </div>
                        @endif
                    </div>

                    <!-- Card Body -->
                    <div class="p-8 grow flex flex-col">
                        <div class="mb-4">
                            <p class="text-gray-500 text-sm font-medium leading-relaxed">
                                {{ $price->subtitle ?? 'Layanan profesional dengan standar kualitas terbaik untuk mendukung pertumbuhan digital Anda.' }}
                            </p>
                        </div>
                        
                        <div class="mb-8">
                            <div class="flex items-baseline gap-1">
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Mulai</span>
                                <span class="text-3xl font-black text-gray-950">Rp {{ number_format($price->price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <ul class="space-y-4 mb-10">
                            @foreach($price->features as $feature)
                            <li class="flex items-start gap-4 text-sm font-semibold text-gray-600 hover:text-gray-900 transition-colors">
                                <div class="w-5 h-5 rounded-full bg-primary/10 flex items-center justify-center shrink-0 mt-0.5 group-hover:bg-primary transition-colors">
                                    <i class="fas fa-check text-[10px] text-primary group-hover:text-white transition-colors"></i>
                                </div>
                                <span class="leading-snug">{{ $feature }}</span>
                            </li>
                            @endforeach
                        </ul>

                        <div class="mt-auto">
                            <a href="{{ route('pesan', ['package' => $price->service_name, 'category_id' => $price->service_category_id]) }}" class="w-full flex items-center justify-center py-5 bg-primary text-white rounded-[2rem] font-black text-lg hover:bg-primary-dark transition-all shadow-xl shadow-primary/20 transform active:scale-95 uppercase tracking-widest">
                                Pesan Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20 text-center">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-50 rounded-full mb-8 border border-dashed border-gray-200">
                        <i class="fas fa-cube text-gray-200 text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-300 uppercase tracking-widest italic">Layanan Belum Tersedia</h3>
                    <p class="text-gray-400 mt-2">Segera hadir paket spesial untuk {{ $currentCategory->name }}.</p>
                </div>
                @endforelse

                <!-- Custom Request Card -->
                <div class="bg-gradient-to-br from-[#0b0f1a] to-black p-10 rounded-[2.5rem] text-white flex flex-col justify-between shadow-2xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-primary/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 group-hover:bg-primary/20 transition-all"></div>
                    
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white/10 backdrop-blur-md border border-white/10 rounded-[1.5rem] flex items-center justify-center mb-8">
                            <i class="fas fa-magic text-2xl text-primary"></i>
                        </div>
                        <h3 class="text-3xl font-black mb-4">Butuh Custom?</h3>
                        <p class="text-gray-400 leading-relaxed mb-10 font-medium">
                            Punya kebutuhan spesifik untuk {{ $currentCategory->name }} yang tidak tertera di paket? Konsultasikan ide Anda secara gratis.
                        </p>
                    </div>
                    <a href="{{ url('/#kontak') }}" class="w-full py-5 bg-primary text-white rounded-[1.25rem] font-black text-center hover:bg-white hover:text-primary transition-all shadow-xl transform active:scale-95">
                        Konsultasi Gratis
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Navigation Breadcrumb at Bottom -->
    <div class="py-12 bg-gray-50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <a href="{{ route('harga') }}" class="flex items-center gap-3 text-gray-500 hover:text-primary transition-colors font-bold group">
                <i class="fas fa-chevron-left text-xs transition-transform group-hover:-translate-x-1"></i>
                Kembali ke Kategori
            </a>
            
            <div class="hidden md:flex items-center gap-6">
                <span class="text-xs font-black uppercase tracking-widest text-gray-300 italic">Lihat Kategori Lain</span>
                <div class="flex gap-2">
                    @php
                        $otherCategories = \App\Models\ServiceCategory::whereNull('parent_id')
                            ->where('id', '!=', $activeParent->id)
                            ->take(3)
                            ->get();
                    @endphp
                    @foreach($otherCategories as $other)
                    <a href="{{ route('harga.layanan', $other->slug) }}" class="p-2 w-10 h-10 rounded-xl bg-white border border-gray-100 flex items-center justify-center text-gray-400 hover:text-primary hover:border-primary transition-all shadow-sm" title="{{ $other->name }}">
                        <i class="{{ $other->icon ?? 'fas fa-rocket' }} text-xs"></i>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('pricing-search');
            const cards = document.querySelectorAll('.pricing-card');

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

    <style>
        .animate-fade-in { animation: fadeIn 0.5s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>
@endsection
