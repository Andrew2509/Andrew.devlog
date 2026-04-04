@extends('layouts.app')

@section('title', 'Syarat & Ketentuan - ' . setting('site_name', 'Andrew.Devlog'))

@section('content')
    <!-- Header Section -->
    <section class="pt-32 pb-16 bg-[#0b0f1a] relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-primary/10 to-transparent"></div>
        <div class="max-w-4xl mx-auto px-4 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-black text-white mb-4 tracking-tight">Syarat & <span class="text-primary">Ketentuan</span></h1>
            <p class="text-gray-400 text-lg">Terakhir diperbarui: 2 April 2026</p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-20">
        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-white rounded-3xl p-8 md:p-12 shadow-sm border border-gray-100 prose prose-cyan max-w-none">
                
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <i class="fas fa-file-contract text-primary"></i> 1. Persetujuan Layanan
                    </h2>
                    <p class="text-gray-600 leading-relaxed">
                        Dengan menggunakan layanan {{ setting('site_name', 'Andrew.Devlog') }}, Anda setuju untuk terikat oleh Syarat & Ketentuan ini. Layanan saya mencakup pembuatan website, redesign, optimasi SEO, dan pemeliharaan website sebagaimana disepakati dalam kontrak proyek.
                    </p>
                </div>

                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <i class="fas fa-money-bill-wave text-primary"></i> 2. Ketentuan Pembayaran
                    </h2>
                    <ul class="list-disc pl-6 space-y-2 text-gray-600">
                        <li>Pembayaran uang muka (DP) sebesar 50% wajib dilakukan sebelum proyek dimulai.</li>
                        <li>Pelunasan sisa 50% dilakukan setelah proyek selesai dan sebelum penyerahan akses penuh (Final Handover).</li>
                        <li>Harga yang tertera di website belum termasuk biaya fitur pihak ketiga (API berbayar, Plugin Premium khusus) kecuali disebutkan dalam paket.</li>
                    </ul>
                </div>

                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <i class="fas fa-clock text-primary"></i> 3. Waktu Pengerjaan
                    </h2>
                    <p class="text-gray-600 leading-relaxed">
                        Estimasi waktu pengerjaan akan diberikan di awal proyek. Keterlambatan dalam pemberian konten (teks, gambar, data) dari pihak klien dapat menyebabkan pergeseran jadwal penyelesaian proyek.
                    </p>
                </div>

                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <i class="fas fa-copyright text-primary"></i> 4. Hak Kekayaan Intelektual
                    </h2>
                    <p class="text-gray-600 leading-relaxed">
                        Setelah pelunasan dilakukan, seluruh hak cipta atas desain dan kode website akan diserahkan sepenuhnya kepada klien. {{ setting('site_name', 'Andrew.Devlog') }} memiliki hak untuk menampilkan proyek tersebut dalam portofolio saya kecuali ada perjanjian kerahasiaan (NDA) sebelumnya.
                    </p>
                </div>

                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <i class="fas fa-tools text-primary"></i> 5. Dukungan & Pemeliharaan
                    </h2>
                    <p class="text-gray-600 leading-relaxed">
                        Setiap paket pembuatan website mencakup garansi perbaikan bug selama 30-90 hari (tergantung paket) setelah peluncuran. Pemeliharaan rutin setelah masa garansi akan dikenakan biaya berlangganan sesuai paket maintenance yang dipilih.
                    </p>
                </div>

                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <i class="fas fa-exclamation-triangle text-primary"></i> 6. Batasan Tanggung Jawab
                    </h2>
                    <p class="text-gray-600 leading-relaxed">
                        {{ setting('site_name', 'Andrew.Devlog') }} tidak bertanggung jawab atas kehilangan data, penurunan peringkat SEO, atau kerugian bisnis yang disebabkan oleh faktor eksternal seperti perubahan algoritma Google, kegagalan server hosting pihak ketiga, atau modifikasi kode yang dilakukan oleh pihak lain tanpa sepengetahuan saya.
                    </p>
                </div>

                <div class="pt-8 border-t border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <i class="fas fa-question-circle text-primary"></i> Pertanyaan?
                    </h2>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Jika Anda memerlukan klarifikasi lebih lanjut mengenai Syarat & Ketentuan ini, jangan ragu untuk menghubungi saya:
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="https://wa.me/6281234567890" target="_blank" class="flex items-center gap-3 px-6 py-3 bg-green-500 text-white rounded-full font-bold hover:bg-green-600 transition-all shadow-lg shadow-green-500/20">
                            <i class="fab fa-whatsapp"></i> Chat Admin
                        </a>
                        <a href="mailto:{{ setting('contact_email', 'halo@andrew.devlog') }}" class="flex items-center gap-3 px-6 py-3 bg-gray-900 text-white rounded-full font-bold hover:bg-gray-800 transition-all shadow-lg shadow-gray-900/20">
                            <i class="fas fa-envelope"></i> Kirim Email
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
