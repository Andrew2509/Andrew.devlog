@extends('layouts.admin')

@section('title', 'About Me - Sosmed Bio')
@section('header_title', 'Sosmed: Profil & About Me')
@section('header_subtitle', 'Kelola identitas profil dan deskripsi singkat diri Anda.')

@section('admin_content')
<div class="max-w-4xl">
    @if(session('success'))
        <div class="mb-8 bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 px-6 py-4 rounded-2xl text-sm font-bold flex items-center gap-3 animate-fade-in">
            <i class="fas fa-check-circle text-lg"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-gray-900 border border-white/5 rounded-[40px] p-10 relative overflow-hidden shadow-2xl">
        <div class="absolute -right-20 -top-20 w-80 h-80 bg-primary/5 rounded-full blur-3xl"></div>
        
        <form action="{{ route('admin.sosmed.about.update') }}" method="POST">
            @csrf
            <div class="space-y-8 relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            Nama Lengkap
                        </label>
                        <input type="text" name="name" value="{{ $name }}" 
                            class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-4 focus:ring-primary/20 transition-all font-bold outline-none shadow-sm"
                            placeholder="Contoh: Princenton Andrew Brightly Masrikat">
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            Tagline / Jabatan
                        </label>
                        <input type="text" name="tagline" value="{{ $tagline }}" 
                            class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-4 focus:ring-primary/20 transition-all font-bold outline-none shadow-sm"
                            placeholder="Contoh: Tech Innovator & Developer">
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                            Lokasi
                        </label>
                        <input type="text" name="location" value="{{ $location }}" 
                            class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-4 focus:ring-primary/20 transition-all font-bold outline-none shadow-sm"
                            placeholder="Contoh: Surabaya, Indonesia">
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2 ml-1">
                        Deskripsi Profil (About Me)
                    </label>
                    <textarea name="about" rows="8" 
                        class="w-full bg-white text-gray-900 px-8 py-6 rounded-3xl border-0 focus:ring-4 focus:ring-primary/20 transition-all font-medium resize-none outline-none text-lg leading-relaxed shadow-inner"
                        placeholder="Tuliskan tentang diri Anda...">{{ $about }}</textarea>
                    <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-2 ml-1 opacity-60">
                        Tips: Gunakan bahasa yang profesional namun tetap santai.
                    </p>
                </div>

                <div class="pt-6">
                    <button type="submit" class="flex items-center gap-3 px-8 py-4 bg-primary hover:bg-primary-dark text-white font-black rounded-2xl transition-all neon-shadow group">
                        <i class="fas fa-save group-hover:scale-110 transition-transform"></i>
                        <span class="uppercase tracking-widest text-xs">Simpan Perubahan</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
