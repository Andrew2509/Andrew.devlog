@extends('layouts.admin')

@section('title', 'Manajemen Joki - ' . setting('site_name', 'Andrew.Devlog') . ' Admin')
@section('header_title', 'Joki Service Manager')
@section('header_subtitle', 'Kelola layanan joki dan paket pengerjaan project.')

@section('admin_content')
<div class="mb-8 flex justify-end">
    <a href="{{ route('admin.joki.create') }}" class="px-6 py-3 bg-primary hover:bg-primary-dark text-white text-sm font-bold rounded-2xl transition-all shadow-lg shadow-primary/20 flex items-center gap-2 group">
        <i class="fas fa-plus group-hover:rotate-90 transition-transform"></i>
        Tambah Layanan Joki
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
                    <th class="px-6 py-4 text-[9px] font-black text-gray-500 uppercase tracking-widest">Layanan</th>
                    <th class="px-6 py-4 text-[9px] font-black text-gray-500 uppercase tracking-widest">Harga Dasar</th>
                    <th class="px-6 py-4 text-[9px] font-black text-gray-500 uppercase tracking-widest text-center">Urutan</th>
                    <th class="px-6 py-4 text-[9px] font-black text-gray-500 uppercase tracking-widest text-center">Paket</th>
                    <th class="px-6 py-4 text-[9px] font-black text-gray-500 uppercase tracking-widest text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/2">
                @forelse($services as $service)
                <tr class="group hover:bg-white/2 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary border border-primary/20">
                                <i class="{{ $service->icon }} text-lg"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-white uppercase tracking-tight">{{ $service->title }}</span>
                                <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest mt-0.5 opacity-70 truncate max-w-[200px]">{{ $service->desc }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm font-bold text-white tracking-widest">
                        {{ $service->price ?? 'Custom Price' }}
                    </td>
                    <td class="px-6 py-4 text-center text-xs font-bold text-gray-400">
                        {{ $service->order }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('admin.joki.packages.index', $service) }}" class="px-3 py-1 bg-white/5 text-gray-400 border border-white/5 text-[10px] font-black rounded-full tracking-widest uppercase transition-all hover:bg-primary hover:text-white hover:border-primary">
                            {{ $service->packages_count }} PAKET
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.joki.edit', $service) }}"
                                class="w-10 h-10 rounded-xl bg-white/2 border border-white/5 text-gray-400 flex items-center justify-center hover:bg-white/5 hover:text-white transition-all shadow-sm">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                            <form action="{{ route('admin.joki.destroy', $service) }}" method="POST" onsubmit="return confirm('Hapus layanan ini?')">
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
                    <td colspan="5" class="px-8 py-20 text-center">
                        <div class="flex flex-col items-center gap-4">
                            <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center text-gray-700 text-2xl">
                                <i class="fas fa-keyboard"></i>
                            </div>
                            <p class="text-gray-500 text-sm font-bold uppercase tracking-widest leading-relaxed">Belum ada layanan joki yang tersedia.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
