@extends('layouts.app')

@section('title', 'Kebijakan Privasi - ' . setting('site_name', 'Andrew.Devlog'))

@section('content')
    <!-- Header Section -->
    <section class="pt-32 pb-16 bg-[#0b0f1a] relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-primary/10 to-transparent"></div>
        <div class="max-w-4xl mx-auto px-4 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-black text-white mb-4 tracking-tight">Kebijakan <span class="text-primary">Privasi</span></h1>
            <p class="text-gray-400 text-lg">Terakhir diperbarui: 2 April 2026</p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-20">
        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-white rounded-3xl p-8 md:p-12 shadow-sm border border-gray-100 prose prose-cyan max-w-none">
                
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <i class="fas fa-shield-alt text-primary"></i> 1. Informasi yang Saya Kumpulkan
                    </h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Saya mengumpulkan informasi yang Anda berikan langsung kepada saya saat Anda mengisi formulir penawaran atau menghubungi saya melalui WhatsApp, termasuk:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-gray-600">
                        <li>Nama Lengkap</li>
                        <li>Alamat Email</li>
                        <li>Nomor Telepon/WhatsApp</li>
                        <li>Detail Proyek atau Bisnis Anda</li>
                    </ul>
                </div>

                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <i class="fas fa-user-check text-primary"></i> 2. Penggunaan Informasi
                    </h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Informasi yang saya kumpulkan digunakan untuk:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-gray-600">
                        <li>Memberikan penawaran harga yang akurat untuk proyek Anda.</li>
                        <li>Menghubungi Anda kembali terkait permintaan layanan.</li>
                        <li>Mengirimkan informasi pembaruan atau penawaran khusus (jika Anda berlangganan newsletter).</li>
                        <li>Meningkatkan kualitas layanan dan fungsionalitas website saya.</li>
                    </ul>
                </div>

                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <i class="fas fa-lock text-primary"></i> 3. Keamanan Data
                    </h2>
                    <p class="text-gray-600 leading-relaxed">
                        Keamanan data Anda adalah prioritas saya. Saya menggunakan teknologi enkripsi SSL (Secure Socket Layer) untuk melindungi data yang dikirimkan melalui website saya. Saya tidak akan pernah menjual, menyewakan, atau membagikan data pribadi Anda kepada pihak ketiga tanpa izin eksplisit dari Anda.
                    </p>
                </div>

                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <i class="fas fa-cookie-bite text-primary"></i> 4. Kebijakan Cookie
                    </h2>
                    <p class="text-gray-600 leading-relaxed">
                        Website saya menggunakan cookie untuk meningkatkan pengalaman navigasi Anda. Cookie membantu saya memahami bagaimana pengunjung berinteraksi dengan website saya sehingga saya dapat terus melakukan optimasi fungsional.
                    </p>
                </div>

                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <i class="fas fa-edit text-primary"></i> 5. Perubahan Kebijakan
                    </h2>
                    <p class="text-gray-600 leading-relaxed">
                        {{ setting('site_name', 'Andrew.Devlog') }} berhak memperbarui Kebijakan Privasi ini kapan saja. Kami akan mencantumkan tanggal pembaruan terbaru di bagian atas halaman ini.
                    </p>
                </div>

                <div class="pt-8 border-t border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <i class="fas fa-headset text-primary"></i> Hubungi Saya
                    </h2>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Jika Anda memiliki pertanyaan mengenai Kebijakan Privasi ini, Anda dapat menghubungi saya melalui:
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-2xl">
                            <i class="fas fa-envelope text-primary text-xl"></i>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase">Email</p>
                                <p class="text-gray-900 font-bold">{{ setting('contact_email', 'halo@andrew.devlog') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-2xl">
                            <i class="fab fa-whatsapp text-primary text-xl"></i>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase">WhatsApp</p>
                                <p class="text-gray-900 font-bold">0812-3456-7890</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
