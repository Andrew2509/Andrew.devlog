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
    <div id="packages-section" x-show="packages.length > 0" x-transition class="mt-20 space-y-10">
        <div class="text-center">
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">Pilih Paket</h2>
            <p class="text-slate-500 text-sm">Pilih paket yang sesuai dengan kebutuhan dan budget Anda.</p>
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
