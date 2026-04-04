@extends('layouts.app')

@section('title', 'Daftar Harga Layanan - ' . setting('site_name', 'Andrew.Devlog'))

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 bg-primary-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 mb-6 underline-animation inline-block">
                Daftar Harga & <span class="text-primary">Paket Lengkap</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Pilih paket yang paling sesuai dengan target dan skala bisnis Anda. Transparan tanpa biaya tersembunyi.
            </p>
        </div>
    </section>

    <!-- Detailed Pricing Comparison -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row gap-12">
            
            <!-- Sidebar (Desktop) -->
            <aside class="w-full lg:w-1/4 hidden lg:block sticky top-32 self-start bg-white z-20">
                @include('component.category-sidebar')
            </aside>

            <!-- Sidebar Drawer (Mobile) -->
            <div id="sidebar-backdrop" class="fixed inset-0 bg-black/50 z-[100] hidden transition-opacity lg:hidden" onclick="toggleSidebar()"></div>
            <aside id="mobile-sidebar" class="fixed inset-y-0 left-0 z-[110] w-72 bg-white transform -translate-x-full transition-transform duration-300 lg:hidden overflow-y-auto">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-8 pb-4 border-b border-gray-50">
                        <h3 class="font-bold text-gray-900 uppercase tracking-widest text-xs">Pilih Kategori</h3>
                        <button onclick="toggleSidebar()" class="w-8 h-8 rounded-full bg-gray-50 text-gray-400 flex items-center justify-center hover:bg-primary-50 hover:text-primary transition-all">
                            <i class="fas fa-times text-sm"></i>
                        </button>
                    </div>
                    @include('component.category-sidebar')
                </div>
            </aside>

            <!-- Content Area (Pricing Cards) -->
            <div class="w-full lg:w-3/4">
                <!-- Floating Mobile Toggle Button -->
                <!-- Floating Mobile Toggle Button (Uiverse Hamburger) -->
                <div class="lg:hidden fixed top-24 left-4 z-[50] scale-[0.4] origin-top-left p-2 bg-white/95 rounded-2xl shadow-xl border border-gray-100 backdrop-blur-sm">
                    <input type="checkbox" class="check" id="mobile-sidebar-check" onchange="toggleSidebar()" />
                    <label for="mobile-sidebar-check" class="hamburger-button">
                      <div class="line1"></div>
                      <div class="line2"></div>
                      <div class="line3"></div>
                    </label>
                </div>

                <div class="mb-10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <h2 class="text-2xl font-black text-gray-900 tracking-tight uppercase">
                        {{ $currentCategory ? 'Biaya ' . $currentCategory->name : 'Daftar Harga & Paket' }}
                    </h2>
                    @if($currentCategory)
                        <a href="{{ route('harga') }}" class="text-gray-400 hover:text-primary text-xs font-bold uppercase tracking-widest flex items-center gap-2">
                            <i class="fas fa-times text-[10px]"></i>
                            Reset Filter
                        </a>
                    @endif
                </div>



                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                    @forelse($prices as $price)
                    <div id="package-{{ $price->id }}" class="fade-in-up-element bg-{{ $price->is_popular ? 'primary shadow-2xl' : 'white border-gray-100 shadow-sm hover:shadow-2xl' }} rounded-3xl p-8 border {{ $price->is_popular ? 'border-primary relative transform lg:scale-105 z-10' : '' }} transition-all duration-300 group flex flex-col h-full" style="transition-delay: {{ 0.1 + ($loop->index * 0.1) }}s;">
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
                        <ul class="space-y-4 mb-8 flex-grow {{ $price->is_popular ? 'text-white' : 'text-gray-600' }}">
                            @foreach($price->features as $feature)
                            <li class="flex items-start gap-3 text-sm">
                                <i class="fas fa-check-circle {{ $price->is_popular ? 'text-yellow-400' : 'text-green-500' }} mt-0.5"></i> <span>{{ $feature }}</span>
                            </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('pesan', ['package' => $price->service_name, 'category_id' => $price->service_category_id]) }}" class="block w-full text-center {{ $price->is_popular ? 'bg-white text-primary hover:bg-gray-50 hover:shadow-white/20' : 'bg-gray-900 text-white hover:bg-gray-800 hover:shadow-gray-900/20' }} py-4 rounded-2xl font-bold transition-all shadow-lg">
                            {{ $price->button_text }}
                        </a>
                    </div>
                    @empty
                    <div class="col-span-1 md:col-span-2 xl:col-span-3 py-20 text-center">
                        <p class="text-gray-500 font-bold uppercase tracking-widest italic text-xl">Layanan belum tersedia.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Note -->
    <section class="py-16 bg-gray-50 border-t border-gray-100">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h3 class="text-2xl font-bold text-gray-900 mb-4">Butuh Penawaran Khusus?</h3>
            <p class="text-gray-600 mb-8">Setiap bisnis memiliki kebutuhan yang unik. Jika paket di atas belum sesuai dengan spesifikasi yang Anda inginkan, saya siap membuatkan penawaran khusus sesuai budget dan kebutuhan fungsional Anda.</p>
            <a href="{{ url('/#kontak') }}" class="inline-flex items-center gap-2 text-primary font-bold hover:underline">
                Hubungi Saya Sekarang <i class="fas fa-arrow-right text-sm"></i>
            </a>
        </div>
    </section>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('mobile-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            const checkbox = document.getElementById('mobile-sidebar-check');
            
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
    </script>

    <style>
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
          background-color: #333; /* Mengganti ke hitam/abu sesuai permintaan */
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
@endsection
