@extends('layouts.app')

@section('title', 'Joki Development - Layanan Pengerjaan Proyek Koding')
@section('meta_description', 'Layanan joki koding profesional untuk tugas kuliah, mini project, hingga pengembangan aplikasi enterprise dengan harga transparan.')

@section('header_extra')
<style>
    .service-card-active {
        border-color: #0066FF !important;
        background: white !important;
        box-shadow: 0 20px 40px -15px rgba(0, 102, 255, 0.1) !important;
        transform: translateY(-5px);
    }
    .step-active-bg { background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%); }
    .glass-input {
        background: white;
        border: 2px solid #F1F5F9;
        transition: all 0.3s ease;
    }
    .glass-input:focus {
        border-color: #0066FF;
        background: white;
        box-shadow: 0 0 0 4px rgba(0, 102, 255, 0.05);
    }
</style>
@endsection

@section('content')
<div x-data="jokiData()" class="min-h-screen bg-slate-50 pt-32 pb-20">

    <!-- Stepper Modern -->
    <div class="max-w-xl mx-auto px-6 mb-16">
        <div class="flex items-center justify-between relative">
            <!-- Progress Line -->
            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-1 bg-slate-200 rounded-full">
                <div class="h-full step-active-bg rounded-full transition-all duration-700 ease-in-out" :style="'width: ' + ((step - 1) * 50) + '%'"></div>
            </div>

            <!-- Step Indicators -->
            <template x-for="i in [1,2,3]">
                <div class="relative z-10 flex flex-col items-center group">
                    <button
                        @click="if(step > i) step = i"
                        :class="step >= i ? 'step-active-bg text-white scale-110 shadow-lg' : 'bg-white text-slate-400 border-2 border-slate-200'"
                        class="w-10 h-10 rounded-2xl flex items-center justify-center font-bold transition-all duration-300">
                        <i x-show="step > i" class="fas fa-check text-xs"></i>
                        <span x-show="step <= i" x-text="i"></span>
                    </button>
                    <span :class="step >= i ? 'text-primary font-bold' : 'text-slate-400 font-medium'" class="absolute -bottom-7 text-[10px] whitespace-nowrap uppercase tracking-tighter">
                        <span x-text="i === 1 ? 'Layanan' : (i === 2 ? 'Detail' : 'Konfirmasi')"></span>
                    </span>
                </div>
            </template>
        </div>
    </div>

    <!-- Container Utama -->
    <main class="max-w-6xl mx-auto px-6">

        <!-- Step 1: Pilih Layanan -->
        <div x-show="step === 1" x-transition class="space-y-10">
            <header class="text-center max-w-2xl mx-auto">
                <h1 class="text-4xl font-black text-slate-900 tracking-tight mb-4">Mulai Proyek Impianmu</h1>
                <p class="text-slate-500 leading-relaxed">Pilih kategori layanan yang ingin Anda kerjakan. Kami menyediakan tim ahli untuk setiap bidang spesifik.</p>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                <template x-for="service in services" :key="service.id">
                    <div @click="selectService(service)"
                        :class="selectedService === service.id ? 'service-card-active' : 'bg-white border-slate-200 hover:border-primary/40'"
                        class="cursor-pointer p-6 rounded-[2rem] border-2 transition-all duration-300 group flex flex-col items-start text-left">

                        <div :class="selectedService === service.id ? 'bg-primary text-white' : 'bg-slate-50 text-slate-400 group-hover:bg-primary/10 group-hover:text-primary'"
                            class="w-14 h-14 rounded-2xl flex items-center justify-center mb-6 transition-colors duration-300">
                            <i :class="'fas ' + service.icon" class="text-2xl"></i>
                        </div>

                        <h3 class="text-lg font-black text-slate-900 mb-2" x-text="service.title"></h3>
                        <p class="text-slate-500 text-sm leading-relaxed mb-4 flex-1" x-text="service.desc"></p>

                        <div class="w-full pt-4 border-t border-slate-50 flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest" x-text="service.price ? 'Mulai ' + service.price : 'Custom Price'"></span>
                            <div :class="selectedService === service.id ? 'bg-primary' : 'bg-slate-100'" class="w-6 h-6 rounded-full flex items-center justify-center transition-colors">
                                <i class="fas fa-chevron-right text-[10px] text-white"></i>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Pilih Paket (Conditional) -->
            <div x-show="packages.length > 0" x-transition class="mt-20 space-y-10">
                <div class="text-center">
                    <h2 class="text-2xl font-black text-slate-900 uppercase tracking-tight">Pilih Paket Layanan</h2>
                    <p class="text-slate-500 text-sm">Pilih spesifikasi yang paling pas dengan skala kebutuhan Anda.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <template x-for="pkg in packages" :key="pkg.id">
                        <div @click="selectedPackage = pkg.id"
                            :class="selectedPackage === pkg.id ? 'border-primary ring-4 ring-primary/5 bg-white' : 'border-slate-100 bg-white opacity-80 hover:opacity-100'"
                            class="relative cursor-pointer p-8 rounded-[2.5rem] border-2 transition-all duration-300 overflow-hidden group">

                            <!-- Active Badge -->
                            <div x-show="selectedPackage === pkg.id" class="absolute top-0 right-0 bg-primary text-white px-4 py-1 rounded-bl-2xl text-[10px] font-black uppercase tracking-widest">Selected</div>

                            <h4 class="text-xl font-black text-slate-900 mb-2" x-text="pkg.title"></h4>
                            <p class="text-slate-500 text-xs mb-6" x-text="pkg.desc"></p>

                            <div class="space-y-3 mb-8">
                                <template x-for="feature in pkg.features" :key="feature">
                                    <div class="flex items-center gap-3 text-xs font-medium text-slate-600">
                                        <i class="fas fa-check-circle text-primary"></i>
                                        <span x-text="feature"></span>
                                    </div>
                                </template>
                            </div>

                            <div class="pt-6 border-t border-slate-50 flex items-center justify-between">
                                <span class="text-lg font-black text-slate-900" x-text="pkg.price"></span>
                                <i class="fas fa-arrow-right text-slate-300 group-hover:text-primary transition-colors"></i>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <div class="flex justify-center pt-10">
                <button
                    @click="if(canContinue()) { step = 2; window.scrollTo(0,0); }"
                    :disabled="!canContinue()"
                    :class="canContinue() ? 'bg-slate-900 hover:bg-black shadow-xl shadow-slate-900/10' : 'bg-slate-200 cursor-not-allowed'"
                    class="px-12 py-5 rounded-3xl text-white font-black text-sm uppercase tracking-widest transition-all">
                    Lanjutkan ke Detail Proyek
                </button>
            </div>
        </div>

        <!-- Step 2: Form Detail -->
        <div x-show="step === 2" x-transition class="max-w-4xl mx-auto">
            <div class="bg-white rounded-[3rem] p-8 md:p-16 shadow-2xl shadow-slate-200/50 border border-slate-100">
                <div class="mb-12">
                    <h2 class="text-3xl font-black text-slate-900 mb-2">Ceritakan Proyekmu</h2>
                    <p class="text-slate-500">Berikan detail sebanyak mungkin agar kami bisa memberikan estimasi terbaik.</p>
                </div>

                <div class="space-y-8">
                    <!-- Judul Proyek -->
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Judul Proyek / Aplikasi</label>
                        <input type="text" x-model="formData.title" placeholder="Misal: Aplikasi Marketplace Sampah"
                            class="w-full px-6 py-5 rounded-2xl glass-input outline-none font-bold text-slate-900">
                    </div>

                    <!-- Input Khusus Berdasarkan Layanan -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Deadline (Semua kecuali tugas mendadak) -->
                        <div x-show="selectedServiceSlug !== 'bantuan-tugas-koding'" class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Kapan Harus Selesai?</label>
                            <input type="date" x-model="formData.deadline"
                                class="w-full px-6 py-5 rounded-2xl glass-input outline-none font-bold text-slate-900">
                        </div>

                        <!-- Urgensi (Tugas Kuliah) -->
                        <div x-show="selectedServiceSlug === 'bantuan-tugas-koding'" class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Seberapa Mendesak?</label>
                            <select x-model="formData.urgency" class="w-full px-6 py-5 rounded-2xl glass-input outline-none font-bold text-slate-900 appearance-none bg-no-repeat bg-[right_1.5rem_center]">
                                <option value="">Pilih Tingkat Urgensi</option>
                                <option value="Sangat Mendesak (Hari Ini)">⚡ Sangat Mendesak (Hari Ini)</option>
                                <option value="Mendesak (1-2 Hari)">⏳ Mendesak (1-2 Hari)</option>
                                <option value="Santai (>3 Hari)">🌱 Santai (>3 Hari)</option>
                            </select>
                        </div>

                        <!-- Tech Stack Preference -->
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Pilihan Teknologi (Opsional)</label>
                            <input type="text" x-model="formData.tech" placeholder="Misal: Laravel, React, Flutter"
                                class="w-full px-6 py-5 rounded-2xl glass-input outline-none font-bold text-slate-900">
                        </div>
                    </div>

                    <!-- Desain UI/UX Fields -->
                    <div x-show="selectedServiceSlug === 'desain-uiux-aplikasi'" class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Tipe Desain</label>
                            <select x-model="formData.designType" class="w-full px-6 py-5 rounded-2xl glass-input outline-none font-bold text-slate-900">
                                <option value="">Pilih Tipe</option>
                                <option value="Redesign (Existing)">Redesign (Aplikasi Lama)</option>
                                <option value="Brand New (Dari Nol)">Brand New (Dari Nol)</option>
                            </select>
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Jumlah Screen (Estimasi)</label>
                            <input type="number" x-model="formData.designScope" placeholder="Misal: 10"
                                class="w-full px-6 py-5 rounded-2xl glass-input outline-none font-bold text-slate-900">
                        </div>
                    </div>

                    <!-- API Backend Fields -->
                    <div x-show="selectedServiceSlug === 'pengembangan-api-backend'" class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Tipe API</label>
                            <select x-model="formData.apiType" class="w-full px-6 py-5 rounded-2xl glass-input outline-none font-bold text-slate-900">
                                <option value="">Pilih Tipe</option>
                                <option value="RESTful API">RESTful API</option>
                                <option value="GraphQL">GraphQL</option>
                            </select>
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Estimasi Endpoint</label>
                            <input type="number" x-model="formData.endpointCount" placeholder="Misal: 15"
                                class="w-full px-6 py-5 rounded-2xl glass-input outline-none font-bold text-slate-900">
                        </div>
                    </div>

                    <!-- Mobile App Fields -->
                    <div x-show="selectedServiceSlug === 'pembuatan-aplikasi-mobile'" class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Platform</label>
                            <select x-model="formData.mobilePlatform" class="w-full px-6 py-5 rounded-2xl glass-input outline-none font-bold text-slate-900">
                                <option value="">Pilih Platform</option>
                                <option value="Android Only">Android Only</option>
                                <option value="iOS Only">iOS Only</option>
                                <option value="Cross-Platform (Android & iOS)">Cross-Platform (Android & iOS)</option>
                            </select>
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Estimasi Jumlah Screen</label>
                            <input type="number" x-model="formData.screenCount" placeholder="Misal: 20"
                                class="w-full px-6 py-5 rounded-2xl glass-input outline-none font-bold text-slate-900">
                        </div>
                    </div>

                    <!-- Deskripsi Lengkap -->
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Deskripsi & Fitur Utama</label>
                        <textarea x-model="formData.description" rows="6" placeholder="Jelaskan alur aplikasi atau fitur apa saja yang wajib ada..."
                            class="w-full px-6 py-5 rounded-3xl glass-input outline-none font-bold text-slate-900 resize-none"></textarea>
                    </div>

                    <!-- Budget Range -->
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Estimasi Budget (Opsional)</label>
                        <input type="text" x-model="formData.budget" placeholder="Misal: Rp 2jt - 5jt"
                            class="w-full px-6 py-5 rounded-2xl glass-input outline-none font-bold text-slate-900">
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-12">
                    <button @click="step = 1; window.scrollTo(0,0);" class="px-8 py-5 rounded-2xl bg-slate-50 text-slate-400 font-black text-xs uppercase tracking-widest hover:bg-slate-100 transition-all">Kembali</button>
                    <button
                        @click="if(isStep2Valid()) { step = 3; window.scrollTo(0,0); }"
                        :disabled="!isStep2Valid()"
                        :class="isStep2Valid() ? 'bg-primary hover:bg-primary-dark shadow-xl shadow-primary/20' : 'bg-slate-200 cursor-not-allowed'"
                        class="flex-1 py-5 rounded-3xl text-white font-black text-sm uppercase tracking-widest transition-all">
                        Lanjut ke Konfirmasi
                    </button>
                </div>
            </div>
        </div>

        <!-- Step 3: Konfirmasi -->
        <div x-show="step === 3" x-transition class="max-w-xl mx-auto">
            <div class="bg-white rounded-[3rem] p-12 shadow-2xl border border-slate-100 text-center">
                <div class="w-20 h-20 bg-green-50 text-green-500 rounded-[2rem] flex items-center justify-center mx-auto mb-8">
                    <i class="fas fa-paper-plane text-3xl"></i>
                </div>

                <h2 class="text-3xl font-black text-slate-900 mb-4">Siap Dikirim!</h2>
                <p class="text-slate-500 mb-10 text-sm">Data akan diteruskan ke tim konsultan kami via WhatsApp untuk review teknis dan penawaran harga resmi.</p>

                <div class="space-y-4 mb-10 text-left">
                    <div class="space-y-2">
                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                        <input type="text" x-model="formData.name" placeholder="E.g. Andrew Princenton"
                            class="w-full px-6 py-4 rounded-2xl glass-input outline-none font-bold text-slate-900">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-1">WhatsApp Aktif</label>
                        <input type="text" x-model="formData.whatsapp" placeholder="E.g. 0812xxxx"
                            class="w-full px-6 py-4 rounded-2xl glass-input outline-none font-bold text-slate-900">
                    </div>
                </div>

                <div class="space-y-4">
                    <button @click="sendOrder()" class="w-full py-5 rounded-3xl bg-[#25D366] hover:bg-[#1fb355] text-white font-black text-sm uppercase tracking-widest transition-all shadow-xl shadow-green-500/20 flex items-center justify-center gap-3">
                        <i class="fab fa-whatsapp text-xl"></i>
                        Kirim via WhatsApp
                    </button>
                    <button @click="step = 2; window.scrollTo(0,0);" class="text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-slate-600 transition-colors">Periksa Kembali Detail</button>
                </div>
            </div>
        </div>

    </main>
</div>

@push('scripts')
<script>
function jokiData() {
    return {
        step: 1,
        selectedService: null,
        selectedServiceSlug: null,
        selectedPackage: null,
        formData: {
            title: '',
            description: '',
            deadline: '',
            urgency: '',
            designType: '',
            designScope: '',
            apiType: '',
            endpointCount: '',
            mobilePlatform: '',
            screenCount: '',
            budget: '',
            tech: '',
            name: '',
            whatsapp: ''
        },
        services: {!! $services_json !!},
        services_raw: {!! $services_raw_json !!},
        packages: [],
        
        selectService(service) {
            this.selectedService = service.id;
            this.selectedServiceSlug = service.slug;
            this.selectedPackage = null;
            
            // Update packages list
            const raw = this.services_raw.find(s => s.id === service.id);
            this.packages = raw ? raw.packages.map(p => ({
                id: p.id,
                title: p.title,
                desc: p.desc,
                features: p.features,
                price: p.price
            })) : [];
        },
        
        getSelectedServiceTitle() {
            const s = this.services.find(i => i.id === this.selectedService);
            return s ? s.title : '';
        },
        
        getSelectedPackageTitle() {
            if(!this.selectedPackage) return '';
            const p = this.packages.find(i => i.id === this.selectedPackage);
            return p ? p.title : '';
        },
        
        canContinue() {
            if(!this.selectedService) return false;
            if(this.packages.length > 0 && !this.selectedPackage) return false;
            return true;
        },
        
        isStep2Valid() {
            if(!this.formData.title || !this.formData.description) return false;
            
            // Logic validation based on SLUG
            if(this.selectedServiceSlug === 'bantuan-tugas-koding' && !this.formData.urgency) return false;
            if(this.selectedServiceSlug === 'desain-uiux-aplikasi' && (!this.formData.designType || !this.formData.designScope)) return false;
            if(this.selectedServiceSlug === 'pengembangan-api-backend' && (!this.formData.apiType || !this.formData.endpointCount)) return false;
            if(this.selectedServiceSlug === 'pembuatan-aplikasi-mobile' && (!this.formData.mobilePlatform || !this.formData.screenCount)) return false;
            
            // Deadline is mandatory except for tugas koding (which uses urgency)
            if(this.selectedServiceSlug !== 'bantuan-tugas-koding' && !this.formData.deadline) return false;
            
            return true;
        },
        
        sendOrder() {
            let msg = `*ORDER JOKI DEVELOPMENT*%0A%0A` +
                       `🔹 *Layanan:* ${this.getSelectedServiceTitle()}%0A`;

            if(this.selectedPackage) {
                msg += `📦 *Paket:* ${this.getSelectedPackageTitle()}%0A`;
            }

            if(this.selectedServiceSlug === 'bantuan-tugas-koding') msg += `⚡ *Urgensi:* ${this.formData.urgency}%0A`;
            if(this.selectedServiceSlug === 'desain-uiux-aplikasi') msg += `🎨 *Desain:* ${this.formData.designType} (${this.formData.designScope})%0A`;
            if(this.selectedServiceSlug === 'pengembangan-api-backend') msg += `🔌 *API:* ${this.formData.apiType} (${this.formData.endpointCount})%0A`;
            if(this.selectedServiceSlug === 'pembuatan-aplikasi-mobile') msg += `📱 *Platform:* ${this.formData.mobilePlatform} (${this.formData.screenCount})%0A`;

            msg += `📝 *Judul:* ${this.formData.title}%0A` +
                   (this.selectedServiceSlug !== 'bantuan-tugas-koding' ? `📅 *Deadline:* ${this.formData.deadline}%0A` : '') +
                   `🛠️ *Tech:* ${this.formData.tech || '-'}%0A` +
                   `💰 *Budget:* ${this.formData.budget || '-'}%0A%0A` +
                   `💬 *Deskripsi:*%0A${this.formData.description}%0A%0A` +
                   `👤 *Nama:* ${this.formData.name}%0A` +
                   `📞 *WhatsApp:* ${this.formData.whatsapp}`;

            window.open(`https://wa.me/{{ setting('site_whatsapp', '628123456789') }}?text=${msg}`, '_blank');
        }
    };
}
</script>
@endpush

@endsection
