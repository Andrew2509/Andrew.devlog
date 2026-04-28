@extends('layouts.app')

@section('title', 'Order Joki - ' . setting('site_name', 'Andrew.Devlog'))

@section('head')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    [x-cloak] { display: none !important; }

    .glass-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(226, 232, 240, 0.8);
    }

    .step-active-bg {
        background: linear-gradient(135deg, #1877F2 0%, #0052cc 100%);
    }

    .service-card-active {
        border-color: #1877F2;
        background: linear-gradient(145deg, #ffffff 0%, #f0f7ff 100%);
        box-shadow: 0 10px 25px -5px rgba(24, 119, 242, 0.1), 0 8px 10px -6px rgba(24, 119, 242, 0.1);
    }

    input:focus, select:focus, textarea:focus {
        box-shadow: 0 0 0 4px rgba(24, 119, 242, 0.1);
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 6px;
    }
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
@endsection

@section('content')
<div x-data="{
    step: 1,
    selectedService: null,
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
    services: @json($services->map(fn($s) => [
        'id' => $s->id,
        'title' => $s->title,
        'desc' => $s->desc,
        'icon' => $s->icon,
        'price' => $s->price
    ])),
    packages: [],
    updatePackages(serviceId) {
        const service = this.services_raw.find(s => s.id === serviceId);
        this.packages = service ? service.packages.map(p => ({
            id: p.id,
            title: p.title,
            desc: p.desc,
            features: p.features,
            price: p.price
        })) : [];
    },
    services_raw: @json($services),
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
        if(this.selectedService === 2 && !this.formData.urgency) return false;
        if(this.selectedService === 3 && (!this.formData.designType || !this.formData.designScope)) return false;
        if(this.selectedService === 4 && (!this.formData.apiType || !this.formData.endpointCount)) return false;
        if(this.selectedService === 5 && (!this.formData.mobilePlatform || !this.formData.screenCount)) return false;
        if(this.selectedService !== 2 && !this.formData.deadline) return false;
        return true;
    },
    sendOrder() {
        let msg = `*ORDER JOKI DEVELOPMENT*%0A%0A` +
                   `🔹 *Layanan:* ${this.getSelectedServiceTitle()}%0A`;

        if(this.selectedPackage) {
            msg += `📦 *Paket:* ${this.getSelectedPackageTitle()}%0A`;
        }

        if(this.selectedService === 2) msg += `⚡ *Urgensi:* ${this.formData.urgency}%0A`;
        if(this.selectedService === 3) msg += `🎨 *Desain:* ${this.formData.designType} (${this.formData.designScope})%0A`;
        if(this.selectedService === 4) msg += `🔌 *API:* ${this.formData.apiType} (${this.formData.endpointCount})%0A`;
        if(this.selectedService === 5) msg += `📱 *Platform:* ${this.formData.mobilePlatform} (${this.formData.screenCount})%0A`;

        msg += `📝 *Judul:* ${this.formData.title}%0A` +
               (this.selectedService !== 2 ? `📅 *Deadline:* ${this.formData.deadline}%0A` : '') +
               `🛠️ *Tech:* ${this.formData.tech || '-'}%0A` +
               `💰 *Budget:* ${this.formData.budget || '-'}%0A%0A` +
               `💬 *Deskripsi:*%0A${this.formData.description}%0A%0A` +
               `👤 *Nama:* ${this.formData.name}%0A` +
               `📞 *WhatsApp:* ${this.formData.whatsapp}`;

        window.open(`https://wa.me/{{ setting('site_whatsapp', '628123456789') }}?text=${msg}`, '_blank');
    }
}" class="min-h-screen bg-[#F8FAFC] pt-36 pb-20">

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
                    <div @click="selectedService = service.id; updatePackages(service.id); selectedPackage = null"
                        :class="selectedService === service.id ? 'service-card-active' : 'bg-white border-slate-200 hover:border-primary/40'"
                        class="cursor-pointer p-6 rounded-[2rem] border-2 transition-all duration-300 group flex flex-col items-start text-left">

                        <div :class="selectedService === service.id ? 'bg-primary text-white' : 'bg-slate-50 text-slate-400 group-hover:bg-primary/10 group-hover:text-primary'"
                            class="w-14 h-14 rounded-2xl flex items-center justify-center mb-6 transition-colors duration-300">
                            <i :class="service.icon" class="text-2xl"></i>
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

                            <h3 class="text-xl font-black text-slate-900 mb-2" x-text="pkg.title"></h3>
                            <p class="text-slate-500 text-xs leading-relaxed mb-6" x-text="pkg.desc"></p>

                            <ul class="space-y-4 mb-8">
                                <template x-for="feature in pkg.features" :key="feature">
                                    <li class="flex items-center gap-3">
                                        <div class="w-5 h-5 rounded-full bg-green-50 flex items-center justify-center">
                                            <i class="fas fa-check text-[8px] text-green-500"></i>
                                        </div>
                                        <span class="text-[11px] font-bold text-slate-600" x-text="feature"></span>
                                    </li>
                                </template>
                            </ul>

                            <div class="mt-auto">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Investasi</p>
                                <p class="text-2xl font-black text-primary" x-text="pkg.price"></p>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Button Next Step 1 -->
            <div class="flex justify-center pt-10">
                <button @click="if(canContinue()) { step = 2; window.scrollTo(0,0); }"
                    :disabled="!canContinue()"
                    :class="canContinue() ? 'bg-primary text-white shadow-xl shadow-primary/30 hover:-translate-y-1' : 'bg-slate-200 text-slate-400 cursor-not-allowed'"
                    class="group flex items-center gap-4 px-12 py-5 rounded-2xl font-black text-sm transition-all duration-300">
                    Lanjutkan Detail Proyek
                    <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                </button>
            </div>
        </div>

        <!-- Step 2: Detail Proyek -->
        <div x-show="step === 2" x-cloak x-transition class="max-w-4xl mx-auto">
            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                <div class="bg-slate-900 p-10 text-white flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <h2 class="text-2xl font-black mb-1">Detail Spesifikasi</h2>
                        <p class="text-slate-400 text-sm italic">"Semakin detail, semakin akurat pengerjaan kami."</p>
                    </div>
                    <div class="bg-white/10 px-5 py-3 rounded-2xl backdrop-blur-md">
                        <p class="text-[10px] font-bold text-slate-300 uppercase mb-1">Layanan Terpilih</p>
                        <p class="text-sm font-black" x-text="getSelectedServiceTitle()"></p>
                    </div>
                </div>

                <div class="p-8 md:p-12 space-y-10">
                    <!-- Basic Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2">
                                <i class="fas fa-tag text-primary/60"></i> Judul Project
                            </label>
                            <input type="text" x-model="formData.title" placeholder="e.g. Sistem Absensi QR Code"
                                class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary outline-none font-semibold text-slate-900 transition-all">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2">
                                <i class="fas fa-layer-group text-primary/60"></i> Tech Stack (Opsional)
                            </label>
                            <input type="text" x-model="formData.tech" placeholder="e.g. Laravel, React, Python"
                                class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary outline-none font-semibold text-slate-900 transition-all">
                        </div>
                    </div>

                    <!-- Dynamic Fields based on Service -->
                    <div class="p-8 bg-primary/[0.02] border-2 border-dashed border-primary/10 rounded-3xl space-y-8">

                        <!-- Bantuan Tugas (ID 2) -->
                        <div x-show="selectedService === 2" x-transition class="space-y-3">
                            <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2">Urgensi Pengerjaan</label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <template x-for="opt in ['Sangat Mendesak (1-2 hari)', 'Normal (3-7 hari)', 'Fleksibel (1-2 minggu)']">
                                    <button @click="formData.urgency = opt"
                                        :class="formData.urgency === opt ? 'bg-primary text-white border-primary' : 'bg-white text-slate-600 border-slate-200 hover:border-primary/40'"
                                        class="px-4 py-3 rounded-xl border-2 text-[11px] font-black transition-all" x-text="opt"></button>
                                </template>
                            </div>
                        </div>

                        <!-- UI/UX (ID 3) -->
                        <div x-show="selectedService === 3" x-transition class="grid md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2">Jenis Desain</label>
                                <select x-model="formData.designType" class="w-full px-6 py-4 bg-white border border-slate-200 rounded-2xl outline-none font-semibold">
                                    <option value="">Pilih Jenis</option>
                                    <option>Web Application</option>
                                    <option>Mobile App</option>
                                    <option>Landing Page</option>
                                </select>
                            </div>
                            <div class="space-y-3">
                                <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2">Scope Desain</label>
                                <select x-model="formData.designScope" class="w-full px-6 py-4 bg-white border border-slate-200 rounded-2xl outline-none font-semibold">
                                    <option value="">Pilih Scope</option>
                                    <option>Wireframe Saja</option>
                                    <option>Interactive Prototype</option>
                                    <option>Full Design System</option>
                                </select>
                            </div>
                        </div>

                        <!-- API / Mobile (ID 4 & 5) - Menggunakan logic serupa -->
                        <div x-show="selectedService === 4" x-transition class="grid md:grid-cols-2 gap-8">
                             <div class="space-y-3">
                                <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2">Jenis API</label>
                                <select x-model="formData.apiType" class="w-full px-6 py-4 bg-white border border-slate-200 rounded-2xl outline-none font-semibold">
                                    <option value="">Pilih Tipe</option>
                                    <option>REST API</option>
                                    <option>GraphQL</option>
                                </select>
                            </div>
                            <div class="space-y-3">
                                <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2">Jumlah Endpoint</label>
                                <input type="text" x-model="formData.endpointCount" placeholder="e.g. 10 Endpoints" class="w-full px-6 py-4 bg-white border border-slate-200 rounded-2xl outline-none font-semibold">
                            </div>
                        </div>
                    </div>

                    <!-- Deadline & Budget -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div x-show="selectedService !== 2" class="space-y-3">
                            <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2">
                                <i class="fas fa-calendar-check text-primary/60"></i> Target Deadline
                            </label>
                            <input type="date" x-model="formData.deadline" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none font-semibold">
                        </div>
                        <div class="space-y-3" :class="selectedService === 2 ? 'col-span-2' : ''">
                            <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2">
                                <i class="fas fa-wallet text-primary/60"></i> Estimasi Budget (Opsional)
                            </label>
                            <div class="relative">
                                <span class="absolute left-6 top-1/2 -translate-y-1/2 font-bold text-slate-400">Rp</span>
                                <input type="text" x-model="formData.budget" placeholder="1.000.000" class="w-full pl-14 pr-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none font-semibold">
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="space-y-3">
                        <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2">
                            <i class="fas fa-align-left text-primary/60"></i> Deskripsi Kebutuhan
                        </label>
                        <textarea rows="5" x-model="formData.description" placeholder="Jelaskan alur aplikasi, fitur utama, atau lampirkan link referensi jika ada..."
                            class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary outline-none font-semibold text-slate-900 transition-all resize-none"></textarea>
                    </div>
                </div>
            </div>

            <!-- Footer Buttons Step 2 -->
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 mt-12">
                <button @click="step = 1; window.scrollTo(0,0);" class="flex items-center gap-2 text-slate-400 font-black hover:text-primary transition-colors group">
                    <i class="fas fa-chevron-left text-[10px] group-hover:-translate-x-1 transition-transform"></i> Kembali Pilih Layanan
                </button>
                <button @click="if(isStep2Valid()) { step = 3; window.scrollTo(0,0); }"
                    :disabled="!isStep2Valid()"
                    :class="isStep2Valid() ? 'bg-slate-900 text-white shadow-2xl shadow-slate-900/20 hover:scale-[1.02]' : 'bg-slate-200 text-slate-400 cursor-not-allowed'"
                    class="px-16 py-5 rounded-2xl font-black text-sm transition-all duration-300">
                    Konfirmasi Order
                </button>
            </div>
        </div>

        <!-- Step 3: Konfirmasi -->
        <div x-show="step === 3" x-cloak x-transition class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

                <!-- Summary Column -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                        <h4 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-8 border-b border-slate-50 pb-4">Order Summary</h4>

                        <div class="space-y-6">
                            <div class="flex justify-between items-start">
                                <span class="text-[10px] font-bold text-slate-400 uppercase">Layanan</span>
                                <span class="text-xs font-black text-slate-900 text-right" x-text="getSelectedServiceTitle()"></span>
                            </div>
                            <div x-show="selectedPackage" class="flex justify-between items-start">
                                <span class="text-[10px] font-bold text-slate-400 uppercase">Paket</span>
                                <span class="text-xs font-black text-primary text-right" x-text="getSelectedPackageTitle()"></span>
                            </div>
                            <div class="flex justify-between items-start">
                                <span class="text-[10px] font-bold text-slate-400 uppercase">Judul</span>
                                <span class="text-xs font-bold text-slate-700 text-right max-w-[150px] truncate" x-text="formData.title"></span>
                            </div>
                            <div x-show="formData.deadline" class="flex justify-between items-start">
                                <span class="text-[10px] font-bold text-slate-400 uppercase">Estimasi Selesai</span>
                                <span class="text-xs font-black text-slate-900 text-right" x-text="formData.deadline"></span>
                            </div>
                        </div>

                        <div class="mt-8 pt-8 border-t border-slate-50 bg-slate-50/50 -mx-8 px-8 rounded-b-[2.5rem]">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-green-500/10 flex items-center justify-center text-green-600">
                                    <i class="fas fa-shield-halved"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-900 uppercase">Jaminan Kualitas</p>
                                    <p class="text-[9px] text-slate-500 font-medium italic">Revisi sampai puas & support deployment.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Personal Info Column -->
                <div class="lg:col-span-7">
                    <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm space-y-8">
                        <div>
                            <h2 class="text-2xl font-black text-slate-900 mb-2">Data Pemesan</h2>
                            <p class="text-slate-500 text-sm">Sedikit lagi! Isi kontakmu agar tim kami bisa langsung menghubungi.</p>
                        </div>

                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest ml-1">Nama Panggilan</label>
                                <div class="relative">
                                    <i class="fas fa-user absolute left-6 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                    <input type="text" x-model="formData.name" placeholder="Siapa nama kamu?"
                                        class="w-full pl-14 pr-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary outline-none font-semibold transition-all">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest ml-1">No. WhatsApp Aktif</label>
                                <div class="relative">
                                    <i class="fab fa-whatsapp absolute left-6 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                    <input type="tel" x-model="formData.whatsapp" placeholder="e.g. 081234567XXX"
                                        class="w-full pl-14 pr-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary outline-none font-semibold transition-all">
                                </div>
                            </div>
                        </div>

                        <button @click="sendOrder()"
                            :disabled="!formData.name || !formData.whatsapp"
                            :class="formData.name && formData.whatsapp ? 'bg-[#25D366] text-white shadow-xl shadow-green-500/20 hover:scale-[1.02]' : 'bg-slate-200 text-slate-400 cursor-not-allowed'"
                            class="w-full py-6 rounded-3xl font-black flex items-center justify-center gap-4 transition-all text-lg group">
                            <i class="fab fa-whatsapp text-2xl group-hover:rotate-12 transition-transform"></i>
                            Kirim ke WhatsApp
                        </button>

                        <div class="text-center">
                            <p class="text-[9px] text-slate-400 font-bold uppercase tracking-[0.2em]">Respons admin biasanya <span class="text-green-500">di bawah 15 menit</span></p>
                        </div>
                    </div>

                    <button @click="step = 2; window.scrollTo(0,0);" class="mt-8 flex items-center gap-2 text-slate-400 font-black hover:text-primary transition-colors group mx-auto">
                        <i class="fas fa-chevron-left text-[10px] group-hover:-translate-x-1 transition-transform"></i> Edit Detail Project
                    </button>
                </div>

            </div>
        </div>

    </main>

</div>
@endsection
