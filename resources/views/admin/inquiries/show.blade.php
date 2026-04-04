@extends('layouts.admin')

@section('title', 'Detail Pesan - ' . setting('site_name', 'Andrew.Devlog') . ' Admin')
@section('header_title', 'Baca Pesan')
@section('header_subtitle', 'Detail komunikasi dari calon klien.')

@section('admin_content')
<div class="mb-8 flex items-center justify-between">
    <a href="{{ route('admin.inquiries.index') }}" class="text-gray-500 hover:text-primary text-xs font-bold uppercase tracking-widest flex items-center gap-2 transition-colors">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Inbox
    </a>
    
    <div class="flex items-center gap-3">
        @php 
            $waNumber = preg_replace('/[^0-9]/', '', $inquiry->phone ?? ''); 
            if(substr($waNumber, 0, 1) == '0') $waNumber = '62' . substr($waNumber, 1);
        @endphp
        <a href="https://wa.me/{{ $waNumber }}" target="_blank" class="px-5 py-2.5 bg-[#25D366]/10 text-[#25D366] text-[10px] font-black uppercase tracking-widest rounded-full border border-[#25D366]/20 hover:bg-[#25D366] hover:text-white transition-all flex items-center gap-2">
            <i class="fab fa-whatsapp text-sm"></i>
            Balas via WhatsApp
        </a>
    </div>
</div>

<div class="max-w-4xl mx-auto">
    <div class="bg-gray-900 shadow-2xl border border-white/5 rounded-[40px] p-10 space-y-8 relative overflow-hidden">
        <div class="absolute -top-20 -right-20 w-64 h-64 bg-primary/5 rounded-full blur-3xl"></div>

        <div class="flex items-start justify-between relative z-10 border-b border-white/5 pb-8 mb-4">
            <div class="flex items-center gap-6">
                <div class="w-20 h-20 rounded-[32px] bg-primary/10 border border-primary/20 flex items-center justify-center text-primary text-3xl font-black uppercase">
                    {{ substr($inquiry->name, 0, 1) }}
                </div>
                <div>
                    <h3 class="text-2xl font-black text-white tracking-tight uppercase">{{ $inquiry->name }}</h3>
                    <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mt-1">
                        {{ $inquiry->created_at->format('l, d F Y - H:i') }}
                    </p>
                </div>
            </div>
            <div class="text-right">
                <span class="px-4 py-2 bg-white/2 border border-white/5 rounded-full text-[10px] text-gray-500 font-black uppercase tracking-widest leading-relaxed">
                    ID: #MSG-{{ str_pad($inquiry->id, 4, '0', STR_PAD_LEFT) }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
            <div class="p-6 bg-white/2 border border-white/5 rounded-3xl space-y-4">
                <h4 class="text-[10px] font-black text-primary uppercase tracking-widest border-b border-white/5 pb-3">Informasi Kontak</h4>
                <div class="space-y-4">
                    <div>
                        <p class="text-[9px] text-gray-600 font-bold uppercase tracking-widest mb-1">Email Address</p>
                        <p class="text-sm font-bold text-white">{{ $inquiry->email ?? 'Tidak dicantumkan' }}</p>
                    </div>
                    <div>
                        <p class="text-[9px] text-gray-600 font-bold uppercase tracking-widest mb-1">Phone / WhatsApp</p>
                        <p class="text-sm font-bold text-white">{{ $inquiry->phone ?? 'Tidak dicantumkan' }}</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6 bg-white/2 border border-white/5 rounded-3xl space-y-4">
                <h4 class="text-[10px] font-black text-[#eab308] uppercase tracking-widest border-b border-white/5 pb-3">Status Pesan</h4>
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-2xl bg-white/5 flex items-center justify-center text-[#eab308]">
                            <i class="fas fa-history"></i>
                        </div>
                        <div>
                            <p class="text-[9px] text-gray-600 font-bold uppercase tracking-widest mb-0.5">Diterima</p>
                            <p class="text-[10px] font-bold text-white uppercase tracking-tighter">{{ $inquiry->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative z-10">
            <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-6 ml-1">Pesan Utama</h4>
            <div class="p-8 bg-white/2 border border-white/10 rounded-[32px] text-gray-300 text-sm leading-relaxed font-medium italic">
                "{{ $inquiry->message }}"
            </div>
        </div>

        <div class="pt-8 border-t border-white/5 flex items-center justify-between relative z-10">
            <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" onsubmit="return confirm('Hapus pesan ini permanen?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-8 py-4 bg-red-500/10 text-red-500 text-[10px] font-black uppercase tracking-widest rounded-full border border-red-500/20 hover:bg-red-500 hover:text-white transition-all flex items-center gap-3">
                    <i class="fas fa-trash-alt"></i>
                    Hapus Selamanya
                </button>
            </form>

            <p class="text-[9px] text-gray-700 font-black uppercase tracking-widest italic">
                &bull; Protected by {{ setting('site_name', 'Andrew.Devlog') }} Security &bull;
            </p>
        </div>
    </div>
</div>
@endsection
