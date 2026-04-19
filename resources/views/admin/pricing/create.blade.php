@extends('layouts.admin')

@section('title', 'Tambah Paket Harga - ' . setting('site_name', 'Andrew.Devlog') . ' Admin')
@section('header_title', 'Tambah Paket')
@section('header_subtitle', 'Tawarkan layanan terbaik Anda kepada calon klien.')

@section('admin_content')
<div class="mb-8">
    <a href="{{ route('admin.pricing.index') }}" class="text-gray-500 hover:text-primary text-xs font-bold uppercase tracking-widest flex items-center gap-2 transition-colors">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Daftar
    </a>
</div>

<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.pricing.store') }}" method="POST" enctype="multipart/form-data" class="bg-gray-900 shadow-2xl border border-white/5 rounded-[40px] p-10 space-y-10">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Basic Info -->
            <div class="space-y-6">
                <div>
                    <label class="block text-gray-500 text-[10px] font-black uppercase tracking-widest mb-3 ml-1" for="service_category_id">Kategori Layanan</label>
                    <select name="service_category_id" id="service_category_id" required
                        class="w-full bg-white border border-white/5 text-gray-900 px-6 py-4 rounded-2xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none font-medium appearance-none">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('service_category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-gray-500 text-[10px] font-black uppercase tracking-widest mb-3 ml-1" for="service_name">Nama Layanan</label>
                    <input type="text" name="service_name" id="service_name" required value="{{ old('service_name') }}"
                        class="w-full bg-white border {{ $errors->has('service_name') ? 'border-red-500/50' : 'border-white/5' }} text-gray-900 px-6 py-4 rounded-2xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none font-medium"
                        placeholder="Contoh: Jasa Landing Page / Website Profil">
                    @error('service_name')
                        <p class="mt-2 text-red-500 text-[10px] font-bold ml-1 uppercase">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-500 text-[10px] font-black uppercase tracking-widest mb-3 ml-1" for="image">Gambar Layanan (Karakter) - Max 2MB</label>
                    <input type="file" name="image" id="image"
                        class="w-full bg-white border {{ $errors->has('image') ? 'border-red-500/50' : 'border-white/5' }} text-gray-900 px-6 py-4 rounded-2xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none font-medium file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-primary file:text-white hover:file:bg-primary-dark">
                    @error('image')
                        <p class="mt-2 text-red-500 text-[10px] font-bold ml-1 uppercase">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-500 text-[10px] font-black uppercase tracking-widest mb-3 ml-1" for="price">Harga (Numeric)</label>
                    <div class="relative">
                        <span class="absolute left-6 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-bold uppercase">Rp</span>
                        <input type="number" name="price" id="price" required value="{{ old('price', 0) }}"
                            class="w-full bg-white border {{ $errors->has('price') ? 'border-red-500/50' : 'border-white/5' }} text-gray-900 pl-14 pr-6 py-4 rounded-2xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none font-medium"
                            placeholder="500000">
                    </div>
                </div>
            </div>

            <!-- Features -->
            <div class="space-y-6 flex flex-col h-full">
                <div class="grow">
                    <label class="block text-gray-500 text-[10px] font-black uppercase tracking-widest mb-3 ml-1" for="features">Daftar Fitur (Satu baris per fitur)</label>
                    <textarea name="features" id="features" required rows="10"
                        class="w-full h-[calc(100%-40px)] bg-white border {{ $errors->has('features') ? 'border-red-500/50' : 'border-white/5' }} text-gray-900 px-6 py-6 rounded-[32px] focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none font-medium"
                        placeholder="Custom Domain&#10;SSL Certificate&#10;5 Pages Design...">{{ old('features') }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-500 text-[10px] font-black uppercase tracking-widest mb-3 ml-1" for="button_text">Teks Tombol</label>
                        <input type="text" name="button_text" id="button_text" required value="{{ old('button_text', 'Pesan Sekarang') }}"
                            class="w-full bg-white border border-white/5 text-gray-900 px-6 py-4 rounded-2xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none font-medium">
                    </div>
                    <div>
                        <label class="block text-gray-500 text-[10px] font-black uppercase tracking-widest mb-3 ml-1" for="button_link">Link Tombol</label>
                        <input type="text" name="button_link" id="button_link" required value="{{ old('button_link', '/page/pesan') }}"
                            class="w-full bg-white border border-white/5 text-gray-900 px-6 py-4 rounded-2xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none font-medium">
                    </div>
                </div>
            </div>
        </div>

        <!-- Popular Status -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="flex items-center gap-4 bg-white/2 border border-white/5 p-6 rounded-3xl">
                <label class="relative inline-flex items-center cursor-pointer group">
                    <input type="checkbox" name="is_popular" value="1" class="sr-only peer">
                    <div class="w-14 h-7 bg-gray-800 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-gray-500 after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary peer-checked:after:bg-white"></div>
                </label>
                <div class="leading-tight">
                    <p class="text-[10px] font-black text-white uppercase tracking-tighter">Paket Populer</p>
                    <p class="text-[8px] text-gray-500 font-medium">Highlight paket.</p>
                </div>
            </div>

            <div class="flex items-center gap-4 bg-white/2 border border-white/5 p-6 rounded-3xl">
                <label class="relative inline-flex items-center cursor-pointer group">
                    <input type="checkbox" name="is_visible_home" value="1" class="sr-only peer" checked>
                    <div class="w-14 h-7 bg-gray-800 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-gray-500 after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500 peer-checked:after:bg-white"></div>
                </label>
                <div class="leading-tight">
                    <p class="text-[10px] font-black text-white uppercase tracking-tighter">Tampil Beranda</p>
                    <p class="text-[8px] text-gray-500 font-medium">Muncul di landing page.</p>
                </div>
            </div>

            <div class="flex items-center gap-4 bg-white/2 border border-white/5 p-6 rounded-3xl">
                <label class="relative inline-flex items-center cursor-pointer group">
                    <input type="checkbox" name="is_visible_pricing" value="1" class="sr-only peer" checked>
                    <div class="w-14 h-7 bg-gray-800 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-gray-500 after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500 peer-checked:after:bg-white"></div>
                </label>
                <div class="leading-tight">
                    <p class="text-[10px] font-black text-white uppercase tracking-tighter">Tampil Harga</p>
                    <p class="text-[8px] text-gray-500 font-medium">Muncul di menu harga.</p>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-black py-5 rounded-[32px] transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-3">
                <span>SIMPAN PAKET HARGA</span>
                <i class="fas fa-save group-hover:scale-125 transition-transform"></i>
            </button>
        </div>
    </form>
</div>
@endsection
