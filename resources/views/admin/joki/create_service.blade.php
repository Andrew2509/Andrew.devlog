@extends('layouts.admin')

@section('title', 'Tambah Layanan Joki - ' . setting('site_name', 'Andrew.Devlog') . ' Admin')
@section('header_title', 'Tambah Layanan Joki')
@section('header_subtitle', 'Tambahkan kategori layanan joki baru.')

@section('admin_content')
<div class="max-w-4xl">
    <form action="{{ route('admin.joki.store') }}" method="POST" class="space-y-8">
        @csrf
        
        <div class="bg-gray-900 border border-white/5 rounded-[40px] p-8 md:p-12 shadow-2xl space-y-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Judul Layanan</label>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Bantuan Tugas Koding" required
                        class="w-full px-6 py-4 bg-white/5 border border-white/10 rounded-2xl focus:border-primary outline-none font-bold text-white transition-all">
                </div>
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Icon (FontAwesome)</label>
                    <input type="text" name="icon" value="{{ old('icon') }}" placeholder="e.g. fa-code" required
                        class="w-full px-6 py-4 bg-white/5 border border-white/10 rounded-2xl focus:border-primary outline-none font-bold text-white transition-all">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Harga Dasar (Opsional)</label>
                    <input type="text" name="price" value="{{ old('price') }}" placeholder="e.g. Rp 10k"
                        class="w-full px-6 py-4 bg-white/5 border border-white/10 rounded-2xl focus:border-primary outline-none font-bold text-white transition-all">
                </div>
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Urutan Tampil</label>
                    <input type="number" name="order" value="{{ old('order', 0) }}" required
                        class="w-full px-6 py-4 bg-white/5 border border-white/10 rounded-2xl focus:border-primary outline-none font-bold text-white transition-all">
                </div>
            </div>

            <div class="space-y-3">
                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Deskripsi Singkat</label>
                <textarea name="desc" rows="4" placeholder="Jelaskan secara singkat apa yang ditawarkan layanan ini..." required
                    class="w-full px-6 py-4 bg-white/5 border border-white/10 rounded-2xl focus:border-primary outline-none font-bold text-white transition-all resize-none">{{ old('desc') }}</textarea>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="px-10 py-4 bg-primary hover:bg-primary-dark text-white text-sm font-black rounded-2xl transition-all shadow-lg shadow-primary/20">
                Simpan Layanan
            </button>
            <a href="{{ route('admin.joki.index') }}" class="px-10 py-4 bg-white/5 hover:bg-white/10 text-gray-400 text-sm font-black rounded-2xl transition-all">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
