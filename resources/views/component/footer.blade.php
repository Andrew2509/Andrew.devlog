<!-- Footer -->
<footer class="gsap-footer relative bg-slate-900 text-slate-300 pt-20 pb-10 px-6 border-t border-slate-800">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
        
        <!-- Brand Info -->
        <div class="md:col-span-1">
            <div class="flex items-center gap-3 font-bold text-xl tracking-tighter mb-6 text-white cursor-pointer group">
                @if(setting('site_logo'))
                    <img src="{{ setting('site_logo') }}" alt="{{ setting('site_name', 'Andrew.Devlog') }}" class="h-14 md:h-16 w-auto object-contain brightness-0 invert">
                @else
                    <div class="w-14 h-14 md:w-16 md:h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center transform -rotate-6 group-hover:rotate-0 transition-transform shadow-md">
                        <span class="transform rotate-6 group-hover:rotate-0 transition-transform font-bold text-2xl md:text-3xl">{{ substr(setting('site_name', 'Andrew'), 0, 1) }}</span>
                    </div>
                    <span class="text-white text-2xl md:text-3xl">{{ setting('site_name', 'Andrew.Devlog') }}</span>
                @endif
            </div>
            <p class="text-sm leading-relaxed text-slate-400 mb-6">
                {{ setting('site_tagline', 'Arsitek digital terpercaya Anda. Membantu mewujudkan ide menjadi solusi teknologi yang berdampak tinggi.') }}
            </p>
            <div class="flex gap-4">
                @if(setting('social_facebook'))
                    <a href="{{ setting('social_facebook') }}" class="w-10 h-10 bg-slate-800 rounded-full flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors" target="_blank" rel="noopener"><i class="fa-brands fa-facebook-f text-[18px]"></i></a>
                @endif
                @if(setting('social_twitter'))
                    <a href="{{ setting('social_twitter') }}" class="w-10 h-10 bg-slate-800 rounded-full flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors" target="_blank" rel="noopener"><i class="fa-brands fa-x-twitter text-[18px]"></i></a>
                @endif
                @if(setting('social_instagram'))
                    <a href="{{ setting('social_instagram') }}" class="w-10 h-10 bg-slate-800 rounded-full flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors" target="_blank" rel="noopener"><i class="fa-brands fa-instagram text-[18px]"></i></a>
                @endif
                @if(setting('social_linkedin'))
                    <a href="{{ setting('social_linkedin') }}" class="w-10 h-10 bg-slate-800 rounded-full flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors" target="_blank" rel="noopener"><i class="fa-brands fa-linkedin-in text-[18px]"></i></a>
                @endif
            </div>
        </div>

        <!-- Services -->
        <div>
            <h4 class="text-white font-bold mb-6">Layanan</h4>
            @php
                $footerCategories = \App\Models\ServiceCategory::whereNull('parent_id')->orderBy('order')->take(5)->get();
            @endphp
            <ul class="space-y-3 text-sm">
                @forelse($footerCategories as $category)
                    <li><a href="{{ route('harga.layanan', $category->slug) }}" class="hover:text-blue-400 transition-colors">{{ $category->name }}</a></li>
                @empty
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Pembuatan Website</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Aplikasi Mobile</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Joki Tugas IT</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Optimasi SEO</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Desain UI/UX</a></li>
                @endforelse
            </ul>
        </div>

        <!-- Company Links -->
        <div>
            <h4 class="text-white font-bold mb-6">Perusahaan</h4>
            <ul class="space-y-3 text-sm">
                <li><a href="{{ url('/') }}" class="hover:text-blue-400 transition-colors">Tentang Kami</a></li>
                <li><a href="{{ url('/#portofolio') }}" class="hover:text-blue-400 transition-colors">Portofolio</a></li>
                <li><a href="{{ route('harga') }}" class="hover:text-blue-400 transition-colors">Harga & Paket</a></li>
                <li><a href="#" class="hover:text-blue-400 transition-colors">Syarat & Ketentuan</a></li>
                <li><a href="#" class="hover:text-blue-400 transition-colors">Kebijakan Privasi</a></li>
            </ul>
        </div>

        <!-- Contact Info -->
        <div>
            <h4 class="text-white font-bold mb-6">Hubungi Kami</h4>
            <ul class="space-y-4 text-sm">
                <li class="flex items-start gap-3">
                    <i data-lucide="map-pin" class="w-[18px] h-[18px] text-blue-500 shrink-0 mt-0.5"></i>
                    <span>{{ setting('contact_address', 'Surabaya, Jawa Timur, Indonesia') }}</span>
                </li>
                <li class="flex items-center gap-3">
                    <i data-lucide="phone" class="w-[18px] h-[18px] text-blue-500 shrink-0"></i>
                    <span>{{ setting('contact_phone', '+62 812-3456-7890') }}</span>
                </li>
                <li class="flex items-center gap-3">
                    <i data-lucide="mail" class="w-[18px] h-[18px] text-blue-500 shrink-0"></i>
                    <span>{{ setting('site_email', 'hello@sparkdigital.id') }}</span>
                </li>
            </ul>
        </div>

    </div>

    <!-- Copyright Section -->
    <div class="max-w-7xl mx-auto pt-8 border-t border-slate-800 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-slate-500">
        <div>
            {!! setting('footer_copyright', '&copy; ' . date('Y') . ' Spark. All rights reserved.') !!}
        </div>
        <div class="flex gap-6">
            <a href="#" class="hover:text-slate-300">Privacy Policy</a>
            <a href="#" class="hover:text-slate-300">Terms of Service</a>
        </div>
    </div>
</footer>
