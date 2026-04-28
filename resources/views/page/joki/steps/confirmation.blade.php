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
