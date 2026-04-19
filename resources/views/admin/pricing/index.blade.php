@extends('layouts.admin')

@section('title', 'Daftar Harga - ' . setting('site_name', 'Andrew.Devlog') . ' Admin')
@section('header_title', 'Pricing Manager')
@section('header_subtitle', 'Kelola paket layanan dan penawaran harga Anda.')

@section('admin_content')
<div class="mb-8 flex justify-end">
    <a href="{{ route('admin.pricing.create') }}" class="px-6 py-3 bg-primary hover:bg-primary-dark text-white text-sm font-bold rounded-2xl transition-all shadow-lg shadow-primary/20 flex items-center gap-2 group">
        <i class="fas fa-plus group-hover:rotate-90 transition-transform"></i>
        Tambah Paket Baru
    </a>
</div>

@if(session('success'))
    <div class="mb-8 p-4 bg-green-500/10 border border-green-500/20 text-green-500 rounded-2xl text-sm font-medium flex items-center gap-3 animate-fade-in">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

<div class="bg-gray-900 border border-white/5 rounded-[40px] overflow-hidden shadow-2xl">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-white/5">
                    <th class="px-4 py-4 text-[9px] font-black text-gray-500 uppercase tracking-widest">Layanan</th>
                    <th class="px-4 py-4 text-[9px] font-black text-gray-500 uppercase tracking-widest">Harga</th>
                    <th class="px-4 py-4 text-[9px] font-black text-gray-500 uppercase tracking-widest text-center">Status</th>
                    <th class="px-4 py-4 text-[9px] font-black text-gray-500 uppercase tracking-widest text-center">Home</th>
                    <th class="px-4 py-4 text-[9px] font-black text-gray-500 uppercase tracking-widest text-center">Page</th>
                    <th class="px-4 py-4 text-[9px] font-black text-gray-500 uppercase tracking-widest">Fitur</th>
                    <th class="px-4 py-4 text-[9px] font-black text-gray-500 uppercase tracking-widest text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/2">
                @forelse($prices as $price)
                <tr class="group hover:bg-white/[0.02] transition-colors">
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-4">
                            @if($price->image)
                                <img src="{{ asset('storage/' . $price->image) }}" alt="" class="w-10 h-10 rounded-xl object-cover shadow-lg border border-white/10">
                            @else
                                <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center text-primary font-black text-xs">
                                    {{ substr($price->service_name, 0, 1) }}
                                </div>
                            @endif
                            <span class="text-sm font-bold text-white uppercase tracking-tight">{{ $price->service_name }}</span>
                        </div>
                    </td>
                    <td class="px-4 py-4 text-sm font-bold text-white tracking-widest">
                        Rp {{ number_format($price->price, 0, ',', '.') }}
                    </td>
                    <td class="px-4 py-4 text-center">
                        <form action="{{ route('admin.pricing.toggle', [$price, 'is_popular']) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-3 py-1 {{ $price->is_popular ? 'bg-primary/20 text-primary border-primary/30' : 'bg-white/5 text-gray-600 border-white/5' }} text-[10px] font-black rounded-full tracking-widest border uppercase transition-all hover:scale-105">
                                {{ $price->is_popular ? 'POPULAR' : 'REGULAR' }}
                            </button>
                        </form>
                    </td>
                    <td class="px-4 py-4 text-center">
                        <form action="{{ route('admin.pricing.toggle', [$price, 'is_visible_home']) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-10 h-10 rounded-xl {{ $price->is_visible_home ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500' }} flex items-center justify-center hover:scale-110 transition-all mx-auto" title="Tampilkan di Beranda">
                                <i class="fas {{ $price->is_visible_home ? 'fa-eye' : 'fa-eye-slash' }} text-xs"></i>
                            </button>
                        </form>
                    </td>
                    <td class="px-4 py-4 text-center">
                        <form action="{{ route('admin.pricing.toggle', [$price, 'is_visible_pricing']) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-10 h-10 rounded-xl {{ $price->is_visible_pricing ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500' }} flex items-center justify-center hover:scale-110 transition-all mx-auto" title="Tampilkan di Halaman Harga">
                                <i class="fas {{ $price->is_visible_pricing ? 'fa-eye' : 'fa-eye-slash' }} text-xs"></i>
                            </button>
                        </form>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex flex-wrap gap-2">
                            @foreach(array_slice($price->features, 0, 2) as $feature)
                                <span class="bg-white/5 border border-white/5 text-gray-400 px-3 py-1 rounded-lg text-[10px] font-medium italic">{{ $feature }}</span>
                            @endforeach
                            @if(count($price->features) > 2)
                                <span class="text-gray-600 text-[10px] font-bold italic ml-1">+{{ count($price->features) - 2 }} extra</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.pricing.edit', $price) }}" 
                                class="w-10 h-10 rounded-xl bg-white/2 border border-white/5 text-gray-400 flex items-center justify-center hover:bg-white/5 hover:text-white transition-all shadow-sm">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                            <form action="{{ route('admin.pricing.destroy', $price) }}" method="POST" onsubmit="return confirm('Hapus paket ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    class="w-10 h-10 rounded-xl bg-red-500/10 border border-red-500/10 text-red-500 flex items-center justify-center hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-8 py-20 text-center">
                        <div class="flex flex-col items-center gap-4">
                            <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center text-gray-700 text-2xl">
                                <i class="fas fa-tags"></i>
                            </div>
                            <p class="text-gray-500 text-sm font-bold uppercase tracking-widest leading-relaxed">Belum ada paket harga yang tersedia.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
