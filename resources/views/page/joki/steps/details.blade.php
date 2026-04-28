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
