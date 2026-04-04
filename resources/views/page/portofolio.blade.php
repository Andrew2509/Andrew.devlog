@extends('layouts.app')

@section('title', 'Portofolio Karya - ' . setting('site_name', 'Andrew.Devlog'))

@section('content')
    <!-- Hero Section -->
    <header class="pt-32 pb-20 bg-gradient-to-b from-primary-50 to-white overflow-hidden relative">
        <div class="absolute top-20 right-[-10%] w-[40%] h-[40%] bg-primary-100/50 rounded-full blur-3xl -z-10 animate-pulse-soft"></div>
        <div class="absolute bottom-[-10%] left-[-5%] w-[30%] h-[30%] bg-primary-100/30 rounded-full blur-3xl -z-10"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 mb-6 tracking-tight fade-in-up-element">
                Koleksi <span class="text-primary italic">Karya Terbaik</span> Saya
            </h1>
            <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto mb-10 leading-relaxed fade-in-up-element" style="transition-delay: 0.1s;">
                Jelajahi berbagai solusi digital yang telah saya bangun untuk membantu bisnis bertumbuh di era digital.
            </p>
        </div>
    </header>

    <!-- Portfolio Gallery -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Full Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($portfolios as $portfolio)
                <div id="project-{{ $portfolio->id }}" class="portfolio-item group bg-white rounded-3xl overflow-hidden border border-gray-100 hover:shadow-2xl transition-all duration-500">
                    <div class="relative overflow-hidden aspect-video">
                        <img src="{{ asset('storage/' . $portfolio->image) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-[2px]">
                             <a href="{{ $portfolio->link ?? '#' }}" target="{{ $portfolio->link ? '_blank' : '_self' }}" class="bg-white text-gray-900 px-6 py-2 rounded-full font-bold shadow-lg hover:bg-primary hover:text-white transition-colors">Lihat Website</a>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-4">
                            <span class="bg-primary/10 text-primary text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">{{ $portfolio->category }}</span>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $portfolio->title }}</h4>
                        <p class="text-gray-500 text-sm mb-6 line-clamp-2">{{ $portfolio->description }}</p>
                        <hr class="border-gray-50 mb-6">
                        <div class="flex items-center text-gray-400 text-xs gap-4">
                            <span><i class="fas fa-calendar-alt mr-1"></i> {{ $portfolio->created_at->format('M Y') }}</span>
                            <span><i class="fas fa-tag mr-1"></i> {{ $portfolio->category }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20 text-center border-2 border-dashed border-gray-100 rounded-[40px]">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-300 text-3xl">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <p class="text-gray-500 font-bold uppercase tracking-widest italic">Belum ada karya yang ditampilkan.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer CTA -->
    <section class="py-24 bg-gray-900 overflow-hidden relative">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(14,165,233,0.1)_0%,transparent_70%)] animate-pulse-soft"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-8">Siap Memulai <span class="text-primary italic">Karya Besar</span> Anda?</h2>
            <p class="text-xl text-gray-400 max-w-2xl mx-auto mb-10 leading-relaxed">
                Mari diskusikan visi Anda dan biarkan saya mengubahnya menjadi kenyataan digital yang luar biasa.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ url('/#kontak') }}" class="bg-primary hover:bg-primary-dark text-white px-10 py-5 rounded-2xl font-bold text-lg transition-all shadow-xl shadow-primary/20">Mulai Proyek Sekarang</a>
                <a href="https://wa.me/628123456789" class="bg-white/10 hover:bg-white/20 text-white border border-white/20 backdrop-blur-md px-10 py-5 rounded-2xl font-bold text-lg transition-all">Konsultasi Gratis</a>
            </div>
        </div>
    </section>
@endsection
