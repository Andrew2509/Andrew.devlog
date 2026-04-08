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
    <section class="relative pt-32 pb-16 bg-primary-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 mb-6 underline-animation inline-block tracking-tight">
                Daftar Harga & <span class="text-primary">Paket Lengkap</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Pilih paket yang paling sesuai dengan target dan skala bisnis Anda. Transparan tanpa biaya tersembunyi.
            </p>
        </div>
    </section>

    <!-- Pricing Content -->
    <section class="py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Category Navigation -->
            <div class="mb-12 space-y-6">
                <!-- Parent Categories -->
                <div class="flex flex-wrap justify-center gap-3">
                    <a href="{{ route('harga') }}" 
                       class="px-6 py-3 rounded-2xl font-bold text-sm transition-all duration-300 border {{ !$currentCategory ? 'bg-primary text-white shadow-xl shadow-primary/20 border-primary' : 'bg-white text-gray-600 border-gray-100 hover:border-primary/30 hover:bg-primary/5' }}">
                        Semua Layanan
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('harga', ['category' => $category->slug]) }}" 
                           class="flex items-center gap-2.5 px-6 py-3 rounded-2xl font-bold text-sm transition-all duration-300 border {{ $activeParent && $activeParent->id == $category->id ? 'bg-primary text-white shadow-xl shadow-primary/20 border-primary' : 'bg-white text-gray-600 border-gray-100 hover:border-primary/30 hover:bg-primary/5' }}">
                            <i class="{{ $category->icon ?? 'fas fa-th-large' }} text-sm {{ $activeParent && $activeParent->id == $category->id ? 'text-white' : 'text-primary/60' }}"></i>
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>

                <!-- Child Categories (Sub-menu) -->
                @if($activeParent && $activeParent->children->count() > 0)
                <div class="flex flex-wrap justify-center gap-2 pb-2 bg-gray-50/50 p-4 rounded-3xl border border-dashed border-gray-200">
                    @foreach($activeParent->children as $child)
                        <a href="{{ route('harga', ['category' => $child->slug]) }}" 
                           class="px-4 py-2 rounded-xl text-xs font-bold transition-all duration-300 border {{ $currentCategory && $currentCategory->id == $child->id ? 'bg-white text-primary border-primary/20 shadow-sm' : 'text-gray-400 border-transparent hover:text-gray-700' }}">
                            {{ $child->name }}
                        </a>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Current Selection Header -->
            <div class="mb-10 text-center">
                <h2 class="text-2xl md:text-3xl font-black text-gray-900 tracking-tight uppercase">
                    {{ $currentCategory ? 'Biaya ' . $currentCategory->name : 'Semua Paket Layanan' }}
                </h2>
                <div class="w-12 h-1.5 bg-primary mx-auto mt-4 rounded-full"></div>
            </div>

            <!-- Pricing Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($prices as $price)
                <div id="package-{{ $price->id }}" class="fade-in-up-element bg-{{ $price->is_popular ? 'primary shadow-2xl' : 'white border-gray-100 shadow-sm hover:shadow-2xl' }} rounded-3xl p-8 border {{ $price->is_popular ? 'border-primary relative transform lg:hover:scale-[1.02] z-10' : '' }} transition-all duration-300 group flex flex-col h-full">
                    @if($price->is_popular)
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-yellow-400 to-yellow-500 text-yellow-900 px-6 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest shadow-lg flex items-center gap-2">
                        <i class="fas fa-star"></i> Paling Populer
                    </div>
                    @endif
                    <div class="mb-4">
                        <h4 class="text-lg font-bold {{ $price->is_popular ? 'text-white' : 'text-gray-900' }} uppercase tracking-tight">{{ $price->service_name }}</h4>
                    </div>
                    <div class="mb-6 {{ $price->is_popular ? 'text-white' : 'text-gray-900' }}">
                        <span class="text-2xl {{ $price->is_popular ? 'lg:text-3xl' : '' }} font-extrabold">Rp {{ number_format($price->price, 0, ',', '.') }}</span>
                        <span class="{{ $price->is_popular ? 'text-primary-100' : 'text-gray-400' }} text-xs font-medium block mt-1">Satu kali bayar</span>
                    </div>
                    <ul class="space-y-4 mb-8 grow {{ $price->is_popular ? 'text-white' : 'text-gray-600' }}">
                        @foreach($price->features as $feature)
                        <li class="flex items-start gap-3 text-sm">
                            <i class="fas fa-check-circle {{ $price->is_popular ? 'text-yellow-400' : 'text-green-500' }} mt-0.5"></i> <span>{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('pesan', ['package' => $price->service_name, 'category_id' => $price->service_category_id]) }}" class="block w-full text-center {{ $price->is_popular ? 'bg-white text-primary hover:bg-gray-50' : 'bg-gray-900 text-white hover:bg-gray-800' }} py-4 rounded-2xl font-bold transition-all shadow-lg">
                        {{ $price->button_text }}
                    </a>
                </div>
                @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 py-20 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-50 rounded-full mb-6">
                        <i class="fas fa-search text-gray-300 text-3xl"></i>
                    </div>
                    <p class="text-gray-400 font-bold uppercase tracking-widest italic text-xl">Layanan belum tersedia.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Additional Note -->
    <section class="py-20 bg-gray-50/50 border-t border-gray-100">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h3 class="text-3xl font-extrabold text-gray-900 mb-4 tracking-tight">Butuh Penawaran Khusus?</h3>
            <p class="text-gray-600 mb-8 text-lg">Setiap bisnis memiliki kebutuhan yang unik. Jika paket di atas belum sesuai dengan spesifikasi yang Anda inginkan, saya siap membuatkan penawaran khusus sesuai budget dan kebutuhan fungsional Anda.</p>
            <a href="{{ url('/#kontak') }}" class="inline-flex items-center gap-3 bg-white px-8 py-4 rounded-2xl shadow-sm border border-gray-100 text-primary font-bold hover:shadow-xl transition-all group">
                Hubungi Saya Sekarang <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </section>
@endsection
@endsection
