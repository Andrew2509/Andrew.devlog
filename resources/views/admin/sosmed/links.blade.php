@extends('layouts.admin')

@section('title', 'Daftar Link - Sosmed Bio')
@section('header_title', 'Sosmed: Daftar Link')
@section('header_subtitle', 'Kelola 7 tombol link utama yang muncul di halaman Bio Anda.')

@section('admin_content')
<div class="max-w-6xl">
    @if(session('success'))
        <div class="mb-8 bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 px-6 py-4 rounded-2xl text-sm font-bold flex items-center gap-3 animate-fade-in">
            <i class="fas fa-check-circle text-lg"></i>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.sosmed.links.update') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $icons = [
                    'fas fa-globe text-cyan-500',
                    'fab fa-whatsapp text-emerald-500',
                    'fas fa-tag text-amber-500',
                    'fas fa-briefcase text-indigo-500',
                    'fab fa-github text-white',
                    'fab fa-linkedin text-blue-500',
                    'fas fa-envelope text-rose-500'
                ];
            @endphp
            @foreach($links as $index => $link)
            <div class="bg-gray-900 border border-white/5 rounded-[40px] p-8 relative overflow-hidden shadow-2xl transition-all hover:border-primary/30 group">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/5 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                
                <div class="flex items-center gap-4 mb-6 relative z-10">
                    <div class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center text-xl border border-white/5 group-hover:bg-primary/10 group-hover:border-primary/30 transition-all">
                        <i class="{{ $icons[$index] ?? 'fas fa-link text-primary' }}"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-black text-xs tracking-widest uppercase opacity-70">
                            Tombol 0{{ $index + 1 }}
                        </h4>
                    </div>
                </div>

                <div class="space-y-6 relative z-10">
                    <div class="space-y-2">
                        <label class="text-[9px] font-bold text-gray-500 uppercase tracking-[0.2em] ml-1">Label Tombol</label>
                        <input type="text" name="links[{{ $index }}][title]" value="{{ $link['title'] }}" 
                            class="w-full bg-white text-gray-900 px-5 py-3.5 rounded-xl border-0 focus:ring-2 focus:ring-primary transition-all font-bold text-xs outline-none shadow-lg"
                            required>
                    </div>
                    
                    <div class="space-y-2">
                        <label class="text-[9px] font-bold text-gray-500 uppercase tracking-[0.2em] ml-1">URL / Link Tujuan</label>
                        <input type="text" name="links[{{ $index }}][url]" value="{{ $link['url'] }}" 
                            class="w-full bg-slate-100 text-gray-600 px-5 py-3.5 rounded-xl border-0 focus:ring-2 focus:ring-primary transition-all font-medium text-[10px] outline-none shadow-inner"
                            required>
                    </div>

                    <input type="hidden" name="links[{{ $index }}][id]" value="{{ $link['id'] }}">
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-12 flex justify-center">
            <button type="submit" class="flex items-center gap-4 px-12 py-5 bg-primary hover:bg-primary-dark text-white font-black rounded-2xl transition-all neon-shadow group">
                <i class="fas fa-save text-xl group-hover:scale-110 transition-transform"></i>
                <span class="uppercase tracking-[0.3em] text-xs">Update Semua Link</span>
            </button>
        </div>
    </form>
</div>
@endsection
