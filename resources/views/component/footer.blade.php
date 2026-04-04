@php
    $footerCategories = \App\Models\ServiceCategory::whereNull('parent_id')->orderBy('order')->take(4)->get();
@endphp

<!-- Footer -->
<footer class="bg-[#0b0f1a] text-white pt-0 pb-10 relative overflow-hidden">
    <!-- Neon Top Border -->
    <div class="h-[2px] w-full bg-gradient-to-r from-transparent via-primary to-transparent opacity-50 shadow-[0_0_20px_#0ea5e9]"></div>



    <!-- Main Footer Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 mb-20">

            <!-- Column 1: Brand & Contact -->
            <div class="space-y-8">
                <div>
                    <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                        @if(setting('footer_logo') || setting('site_logo'))
                            <img src="{{ setting('footer_logo') ?: setting('site_logo') }}" alt="{{ setting('site_name', 'Andrew.Devlog') }}" class="h-28 w-auto transition-transform group-hover:scale-105">
                        @else
                            <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center shadow-lg shadow-primary/20 group-hover:rotate-12 transition-transform">
                                <i class="fas fa-bolt text-black text-xl"></i>
                            </div>
                            <span class="text-2xl font-black tracking-tighter uppercase">{{ setting('site_name', 'ANDREW.DEVLOG') }}</span>
                        @endif
                    </a>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed">
                    {{ setting('site_tagline', 'Digital Solutions & Identity Creator') }}
                </p>

                <div class="space-y-4 pt-4 border-t border-white/5">
                    <div class="flex items-center gap-4 group">
                        <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-primary border border-white/5 group-hover:bg-primary group-hover:text-black transition-all">
                            <i class="fas fa-envelope text-xs"></i>
                        </div>
                        <span class="text-sm font-bold text-gray-300">{{ setting('site_email', 'hello@andrewdevlog.com') }}</span>
                    </div>
                    <div class="flex items-center gap-4 group">
                        <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-primary border border-white/5 group-hover:bg-primary group-hover:text-black transition-all">
                            <i class="fab fa-whatsapp text-xs"></i>
                        </div>
                        <span class="text-sm font-bold text-gray-300">{{ setting('whatsapp_number', '+62 812 3456 789') }}</span>
                    </div>
                </div>
            </div>

            <!-- Column 2: Services (Dynamic) -->
            <div>
                <h4 class="text-xs font-black mb-10 text-white uppercase tracking-[0.3em] flex items-center gap-3">
                    <span class="w-6 h-[1px] bg-primary"></span>
                    SERVICES
                </h4>
                <ul class="space-y-4">
                    @forelse($footerCategories as $category)
                        <li>
                            <a href="{{ route('harga', ['category' => $category->slug]) }}" class="text-gray-500 text-sm font-bold hover:text-primary transition-all flex items-center gap-2 group/link">
                                <span class="w-0 group-hover/link:w-3 h-[1px] bg-primary transition-all"></span>
                                {{ $category->name }}
                            </a>
                        </li>
                    @empty
                        <li><a href="{{ route('harga') }}" class="text-gray-500 text-sm font-bold hover:text-primary transition-all">Web Development</a></li>
                        <li><a href="{{ route('harga') }}" class="text-gray-500 text-sm font-bold hover:text-primary transition-all">UI/UX Design</a></li>
                        <li><a href="{{ route('harga') }}" class="text-gray-500 text-sm font-bold hover:text-primary transition-all">SEO Optimization</a></li>
                    @endforelse
                </ul>
            </div>

            <!-- Column 3: Quick Links -->
            <div>
                <h4 class="text-xs font-black mb-10 text-white uppercase tracking-[0.3em] flex items-center gap-3">
                    <span class="w-6 h-[1px] bg-primary"></span>
                    EXPLORE
                </h4>
                <ul class="space-y-4">
                    <li><a href="{{ url('/') }}" class="text-gray-500 text-sm font-bold hover:text-primary transition-all flex items-center gap-2 group/link">Beranda</a></li>
                    <li><a href="{{ url('/portofolio') }}" class="text-gray-500 text-sm font-bold hover:text-primary transition-all flex items-center gap-2 group/link">Portofolio</a></li>
                    <li><a href="{{ url('/harga') }}" class="text-gray-500 text-sm font-bold hover:text-primary transition-all flex items-center gap-2 group/link">Daftar Harga</a></li>
                    <li><a href="{{ url('/pesan') }}" class="text-gray-500 text-sm font-bold hover:text-primary transition-all flex items-center gap-2 group/link">Pesan Sekarang</a></li>
                </ul>
            </div>

            <!-- Column 4: Social & Follow -->
            <div>
                <h4 class="text-xs font-black mb-10 text-white uppercase tracking-[0.3em] flex items-center gap-3">
                    <span class="w-6 h-[1px] bg-primary"></span>
                    CONNECT
                </h4>
                <p class="text-gray-500 text-sm font-bold mb-8 leading-relaxed">
                    Follow perjalanan digital saya di berbagai platform sosial media.
                </p>
                <div class="flex gap-4">
                    @php
                        $socials = [
                            ['icon' => 'fab fa-instagram', 'setting' => 'social_instagram', 'color' => '#E1306C'],
                            ['icon' => 'fab fa-facebook-f', 'setting' => 'social_facebook', 'color' => '#1877F2'],
                            ['icon' => 'fab fa-tiktok', 'setting' => 'social_tiktok', 'color' => '#000000'],
                            ['icon' => 'fab fa-github', 'setting' => 'social_github', 'color' => '#ffffff'],
                        ];
                    @endphp
                    @foreach($socials as $social)
                        @if(setting($social['setting']))
                        <a href="{{ setting($social['setting']) }}" target="_blank" class="w-12 h-12 rounded-2xl bg-white/5 border border-white/5 flex items-center justify-center text-gray-400 hover:text-white transition-all transform hover:-translate-y-1 relative group"
                           style="--hover-color: {{ $social['color'] }}">
                            <i class="{{ $social['icon'] }}"></i>
                            <div class="absolute inset-0 rounded-2xl bg-[var(--hover-color)] opacity-0 group-hover:opacity-20 blur-lg transition-opacity"></div>
                        </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Tech Stack Row -->
        <div class="py-12 border-t border-white/5 flex flex-wrap justify-center items-center gap-10 opacity-30 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-700">
            <span class="text-xs font-black tracking-[0.3em] uppercase">Built with:</span>
            <i class="fab fa-laravel text-3xl"></i>
            <i class="fab fa-js text-3xl"></i>
            <i class="fab fa-php text-3xl"></i>
            <i class="fab fa-html5 text-3xl"></i>
            <i class="fab fa-css3-alt text-3xl"></i>
        </div>

        <!-- Bottom Row -->
        <div class="pt-10 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="text-gray-600 text-[10px] font-black uppercase tracking-widest text-center md:text-left">
                {{ setting('footer_copyright', '© 2026 ANDREW.DEVLOG. ALL RIGHTS RESERVED.') }}
            </div>
            <div class="flex items-center gap-10">
                <a href="{{ url('/privacy') }}" class="text-[10px] font-black text-gray-600 hover:text-primary uppercase tracking-widest transition-colors">Privacy</a>
                <a href="{{ url('/terms') }}" class="text-[10px] font-black text-gray-600 hover:text-primary uppercase tracking-widest transition-colors">Terms</a>
                <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="w-12 h-12 rounded-full bg-white/5 border border-white/5 flex items-center justify-center text-primary hover:bg-primary hover:text-black transition-all group">
                    <i class="fas fa-chevron-up group-hover:-translate-y-1 transition-transform"></i>
                </button>
            </div>
        </div>
    </div>
</footer>

<style>
    /* Custom Neon Glow for Social Buttons */
    .group:hover i {
        text-shadow: 0 0 10px var(--hover-color);
    }
</style>
