@extends('layouts.admin')

@section('title', 'Edit Paket - ' . $package->title . ' - Admin')
@section('header_title', 'Edit Paket')
@section('header_subtitle', 'Layanan: ' . $service->title)

@section('admin_content')
<div class="max-w-4xl">
    <form action="{{ route('admin.joki.packages.update', [$service, $package]) }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')
        
        <div class="bg-gray-900 border border-white/5 rounded-[40px] p-8 md:p-12 shadow-2xl space-y-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Nama Paket</label>
                    <input type="text" name="title" value="{{ old('title', $package->title) }}" placeholder="e.g. Paket CRUD Santai" required
                        class="w-full px-6 py-4 bg-white/5 border border-white/10 rounded-2xl focus:border-primary outline-none font-bold text-white transition-all">
                </div>
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Harga (Teks)</label>
                    <input type="text" name="price" value="{{ old('price', $package->price) }}" placeholder="e.g. Rp 1.000.000" required
                        class="w-full px-6 py-4 bg-white/5 border border-white/10 rounded-2xl focus:border-primary outline-none font-bold text-white transition-all">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Urutan Tampil</label>
                    <input type="number" name="order" value="{{ old('order', $package->order) }}" required
                        class="w-full px-6 py-4 bg-white/5 border border-white/10 rounded-2xl focus:border-primary outline-none font-bold text-white transition-all">
                </div>
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Deskripsi Singkat (Opsional)</label>
                    <input type="text" name="desc" value="{{ old('desc', $package->desc) }}" placeholder="e.g. Sistem administrasi data dasar..."
                        class="w-full px-6 py-4 bg-white/5 border border-white/10 rounded-2xl focus:border-primary outline-none font-bold text-white transition-all">
                </div>
            </div>

            <div class="space-y-3">
                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Fitur Paket (Pisahkan dengan baris baru)</label>
                <textarea name="features" rows="6" placeholder="Operasi CRUD Lengkap&#10;Validasi Form&#10;Database Ready..." required
                    class="w-full px-6 py-4 bg-white/5 border border-white/10 rounded-2xl focus:border-primary outline-none font-bold text-white transition-all resize-none">{{ old('features', implode("\n", $package->features)) }}</textarea>
                <p class="text-[9px] text-gray-600 font-bold italic">Setiap baris akan menjadi satu poin fitur bertanda ceklis di halaman depan.</p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="px-10 py-4 bg-primary hover:bg-primary-dark text-white text-sm font-black rounded-2xl transition-all shadow-lg shadow-primary/20">
                Update Paket
            </button>
            <a href="{{ route('admin.joki.packages.index', $service) }}" class="px-10 py-4 bg-white/5 hover:bg-white/10 text-gray-400 text-sm font-black rounded-2xl transition-all">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
