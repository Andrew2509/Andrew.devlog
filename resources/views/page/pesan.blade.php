@extends('layouts.app')

@section('title', 'Minta Penawaran Kustom - ' . setting('site_name', 'Andrew.Devlog'))

@section('content')
    <main class="pt-32 pb-24 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
            <!-- Hero Content Section -->
            <div class="lg:col-span-5 space-y-8">
                <div class="space-y-4">
                    <span class="text-primary font-bold tracking-widest text-xs uppercase">Konsultasi Gratis</span>
                    <h1 class="text-5xl md:text-6xl font-extrabold tracking-tighter text-gray-900 leading-tight">
                        Minta Penawaran <span class="text-primary">Kustom</span>
                    </h1>
                    <p class="text-lg text-gray-600 leading-relaxed max-w-md">
                        Ayo mulai bangun solusi digital Anda bersama saya hari ini. Saya sebagai arsitek digital siap mewujudkan visi Anda menjadi realitas.
                    </p>
                </div>

                <!-- Trust Indicators (Bento Style) -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white p-6 rounded-2xl shadow-xl shadow-cyan-900/5 border border-cyan-100/50">
                        <i class="fas fa-check-circle text-primary text-2xl mb-3"></i>
                        <h3 class="font-bold text-gray-900">Precision</h3>
                        <p class="text-sm text-gray-500">Pixel-perfect engineering in every project.</p>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-xl shadow-cyan-900/5 border border-cyan-100/50">
                        <i class="fas fa-bolt text-primary text-2xl mb-3"></i>
                        <h3 class="font-bold text-gray-900">Agility</h3>
                        <p class="text-sm text-gray-500">Rapid deployment without compromising quality.</p>
                    </div>
                </div>

                <div class="relative rounded-3xl overflow-hidden aspect-video shadow-2xl group border-4 border-white">
                    <img alt="Modern minimalist office space" class="object-cover w-full h-full transform group-hover:scale-105 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAAZtyPVlCQNapuAj0zoVM-oKc4d5TNKDdzJ10zlfU-_axtSic_TiV6ODMdPpJvtdxoIaq_2D6GoYiX71Agi3fQwN4WSrBZARLyec4J1Xt1IEthJ9_Ie9dHeSs_-yexe6Q99p8VvFVnax-Lr6Jz3jcTCyzPaBFFCQezoQLYmffajawNWwbYqhkjB9FaMEmOWqdIjne_WfEdF321XMltG4i25J2NJyxf64oMbvS9jyDYjDMG5UhJxCKDWZa64Z2aVTtDn396K-x0kxza"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/30 to-transparent"></div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="lg:col-span-7">
                <div class="bg-white p-8 md:p-12 rounded-3xl shadow-2xl shadow-cyan-900/10 relative overflow-hidden border border-cyan-50">
                    <!-- Subtle background accent -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                    
                    @if(session('success'))
                        <div class="mb-8 p-6 bg-green-500/10 border border-green-500/20 text-green-600 rounded-2xl flex items-center gap-4 animate-bounce-soft">
                            <div class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center text-white shadow-lg shadow-green-500/20">
                                <i class="fas fa-check"></i>
                            </div>
                            <p class="font-bold">{{ session('success') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('inquiry.store') }}" method="POST" class="space-y-8 relative z-10">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Nama Lengkap -->
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-gray-400" for="name">Nama Lengkap</label>
                                <div class="relative">
                                    <input name="name" class="w-full bg-slate-50 border-0 focus:ring-2 focus:ring-primary rounded-xl py-4 px-4 text-gray-900 placeholder:text-gray-400 transition-all" id="name" placeholder="John Doe" type="text" required/>
                                </div>
                            </div>
                            <!-- Email -->
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-gray-400" for="email">Email Bisnis</label>
                                <input name="email" class="w-full bg-slate-50 border-0 focus:ring-2 focus:ring-primary rounded-xl py-4 px-4 text-gray-900 placeholder:text-gray-400 transition-all" id="email" placeholder="hello@company.com" type="email" required/>
                            </div>
                            <!-- Nomor Telepon -->
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-gray-400" for="phone">Nomor WhatsApp</label>
                                <input name="phone" class="w-full bg-slate-50 border-0 focus:ring-2 focus:ring-primary rounded-xl py-4 px-4 text-gray-900 placeholder:text-gray-400 transition-all" id="phone" placeholder="081234567890" type="tel" required/>
                            </div>
                            <!-- Kategori Layanan -->
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-gray-400" for="service_category_id">Layanan Utama</label>
                                <select name="service_category_id" id="service_category_id" class="w-full bg-slate-50 border-0 focus:ring-2 focus:ring-primary rounded-xl py-4 px-4 text-gray-900 transition-all cursor-pointer appearance-none">
                                    <option value="">Pilih Layanan</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Nama Layanan / Paket -->
                            <div class="space-y-2 md:col-span-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-gray-400" for="service_name">Nama Layanan / Paket</label>
                                <input name="service_name" class="w-full bg-slate-50 border-0 focus:ring-2 focus:ring-primary rounded-xl py-4 px-4 text-gray-900 placeholder:text-gray-400 transition-all" id="service_name" placeholder="Misal: Paket Bronze / Custom Website E-commerce" type="text"/>
                            </div>
                        </div>

                        <!-- Deskripsi Proyek -->
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-gray-400" for="message">Deskripsi Proyek</label>
                            <textarea name="message" class="w-full bg-slate-50 border-0 focus:ring-2 focus:ring-primary rounded-xl py-4 px-4 text-gray-900 placeholder:text-gray-400 transition-all resize-none" id="message" placeholder="Ceritakan tentang proyek Anda..." rows="5" required></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button class="w-full md:w-auto bg-primary text-white px-12 py-5 rounded-full font-bold text-lg hover:bg-primary-dark shadow-xl shadow-primary/20 transition-all flex items-center justify-center gap-3 active:scale-[0.98] group" type="submit">
                                Kirim Permintaan
                                <i class="fas fa-paper-plane text-sm group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Contact Secondary Option -->
                <div class="mt-8 flex flex-col md:flex-row items-center justify-between p-6 bg-white rounded-3xl border border-cyan-100/50 shadow-xl shadow-cyan-900/5">
                    <div class="flex items-center gap-4 mb-4 md:mb-0">
                        <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center shadow-inner">
                            <i class="fas fa-comment text-primary"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">Butuh bantuan cepat?</p>
                            <p class="text-sm text-gray-500">Hubungi saya via WhatsApp Messenger</p>
                        </div>
                    </div>
                    <a class="text-primary font-bold flex items-center gap-2 hover:underline underline-offset-4 group transition-all" href="https://wa.me/628123456789" target="_blank">
                        Chat Sekarang
                        <i class="fas fa-external-link-alt text-xs group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const package = urlParams.get('package');
            const categoryId = urlParams.get('category_id');
            
            if (categoryId) {
                const categorySelect = document.getElementById('service_category_id');
                if (categorySelect) categorySelect.value = categoryId;
            }
            
            if (package) {
                const serviceNameInput = document.getElementById('service_name');
                const messageArea = document.getElementById('message');
                
                if (serviceNameInput) serviceNameInput.value = package;
                
                if (messageArea && !messageArea.value) {
                    messageArea.value = `Halo Andrew.Devlog,\n\nSaya tertarik untuk memesan paket: *${package}*.\n\nBerikut rincian kebutuhan saya:\n- \n\n(Silakan lengkapi detail di atas)`;
                }
            }
        });
    </script>
</main>
@endsection
