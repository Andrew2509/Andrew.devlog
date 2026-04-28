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
        @include('page.joki.steps.services')
        @include('page.joki.steps.details')
        @include('page.joki.steps.confirmation')
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
