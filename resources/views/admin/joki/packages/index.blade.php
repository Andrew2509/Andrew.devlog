@extends('layouts.admin')

@section('title', 'Manajemen Paket - ' . $service->title . ' - Admin')
@section('header_title', 'Package Manager')
@section('header_subtitle', 'Kelola paket untuk layanan: ' . $service->title)

@section('admin_content')
<div class="mb-8 flex items-center justify-between">
    <a href="{{ route('admin.joki.index') }}" class="text-gray-500 hover:text-white flex items-center gap-2 text-xs font-black transition-colors uppercase tracking-widest">
        <i class="fas fa-arrow-left text-[10px]"></i>
        Kembali ke Layanan
    </a>
    <a href="{{ route('admin.joki.packages.create', $service) }}" class="px-6 py-3 bg-primary hover:bg-primary-dark text-white text-sm font-bold rounded-2xl transition-all shadow-lg shadow-primary/20 flex items-center gap-2 group">
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
                    <th class="px-6 py-4 text-[9px] font-black text-gray-500 uppercase tracking-widest">Nama Paket</th>
                    <th class="px-6 py-4 text-[9px] font-black text-gray-500 uppercase tracking-widest">Harga</th>
                    <th class="px-6 py-4 text-[9px] font-black text-gray-500 uppercase tracking-widest">Fitur</th>
                    <th class="px-6 py-4 text-[9px] font-black text-gray-500 uppercase tracking-widest text-center">Urutan</th>
                    <th class="px-6 py-4 text-[9px] font-black text-gray-500 uppercase tracking-widest text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/2">
                @forelse($packages as $package)
                <tr class="group hover:bg-white/2 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-white uppercase tracking-tight">{{ $package->title }}</span>
                            <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest mt-0.5 opacity-70">{{ $package->desc }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm font-bold text-white tracking-widest">
                        {{ $package->price }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-2">
                            @foreach(array_slice($package->features, 0, 3) as $feature)
                                <span class="bg-white/5 border border-white/5 text-gray-400 px-3 py-1 rounded-lg text-[10px] font-medium italic">{{ $feature }}</span>
                            @endforeach
                            @if(count($package->features) > 3)
                                <span class="text-gray-600 text-[10px] font-bold italic ml-1">+{{ count($package->features) - 3 }} extra</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center text-xs font-bold text-gray-400">
                        {{ $package->order }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.joki.packages.edit', [$service, $package]) }}"
                                class="w-10 h-10 rounded-xl bg-white/2 border border-white/5 text-gray-400 flex items-center justify-center hover:bg-white/5 hover:text-white transition-all shadow-sm">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                            <form action="{{ route('admin.joki.packages.destroy', [$service, $package]) }}" method="POST" onsubmit="return confirm('Hapus paket ini?')">
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
                                <i class="fas fa-box-open"></i>
                            </div>
                            <p class="text-gray-500 text-sm font-bold uppercase tracking-widest leading-relaxed">Belum ada paket untuk layanan ini.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
