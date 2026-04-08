@extends('layouts.admin')

@section('title', 'Layanan Saya - Sosmed Bio')
@section('header_title', 'Sosmed: Layanan Saya')
@section('header_subtitle', 'Kelola daftar layanan profesional yang Anda tawarkan.')

@section('admin_content')
<div class="max-w-6xl">
    @if(session('success'))
        <div class="mb-8 bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 px-6 py-4 rounded-2xl text-sm font-bold flex items-center gap-3 animate-fade-in">
            <i class="fas fa-check-circle text-lg"></i>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.sosmed.services.update') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($services as $index => $service)
            <div class="bg-gray-900 border border-white/5 rounded-[40px] p-8 relative overflow-hidden shadow-2xl transition-all hover:border-primary/30 group">
                <div class="absolute -right-20 -bottom-20 w-60 h-60 bg-primary/2 rounded-full blur-3xl group-hover:bg-primary/5 transition-all"></div>
                
                <h4 class="text-white font-black text-sm tracking-widest mb-6 flex items-center gap-3 uppercase relative z-10 opacity-70">
                    <span class="w-8 h-8 bg-white/5 rounded-lg flex items-center justify-center text-[10px] text-primary border border-white/5">0{{ $index + 1 }}</span>
                    Layanan {{ $index + 1 }}
                </h4>

                <div class="space-y-6 relative z-10">
                    <div class="space-y-2">
                        <label class="text-[9px] font-bold text-gray-500 uppercase tracking-[0.2em] ml-1">Nama Layanan</label>
                        <input type="text" name="services[{{ $index }}][name]" value="{{ $service['name'] }}" 
                            class="w-full bg-white text-gray-900 px-5 py-3.5 rounded-xl border-0 focus:ring-2 focus:ring-primary transition-all font-bold text-sm outline-none shadow-lg"
                            required>
                    </div>
                    
                    <div class="space-y-2">
                        <label class="text-[9px] font-bold text-gray-500 uppercase tracking-[0.2em] ml-1">Deskripsi Singkat</label>
                        <textarea name="services[{{ $index }}][desc]" rows="3" 
                            class="w-full bg-white text-gray-900 px-5 py-3.5 rounded-xl border-0 focus:ring-2 focus:ring-primary transition-all font-medium text-xs resize-none outline-none shadow-lg"
                            required>{{ $service['desc'] }}</textarea>
                    </div>

                    <input type="hidden" name="services[{{ $index }}][id]" value="{{ $service['id'] }}">
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-12 flex justify-center">
            <button type="submit" class="flex items-center gap-4 px-12 py-5 bg-primary hover:bg-primary-dark text-white font-black rounded-2xl transition-all neon-shadow group">
                <i class="fas fa-save text-xl group-hover:scale-110 transition-transform"></i>
                <span class="uppercase tracking-[0.3em] text-xs">Simpan Semua Layanan</span>
            </button>
        </div>
    </form>
</div>

@push('styles')
<style>
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
    .group:hover .fa-save {
        animation: bounce 1s infinite;
    }
</style>
@endpush
@endsection
