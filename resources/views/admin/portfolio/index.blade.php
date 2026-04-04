@extends('layouts.admin')

@section('title', 'Daftar Portfolio - ' . setting('site_name', 'Andrew.Devlog') . ' Admin')
@section('header_title', 'Portfolio Manager')
@section('header_subtitle', 'Kelola pameran proyek dan karya digital Anda.')

@section('admin_content')
<div class="mb-8 flex justify-end">
    <a href="{{ route('admin.portfolio.create') }}" class="px-6 py-3 bg-primary hover:bg-primary-dark text-white text-sm font-bold rounded-2xl transition-all shadow-lg shadow-primary/20 flex items-center gap-2 group">
        <i class="fas fa-plus group-hover:rotate-90 transition-transform"></i>
        Tambah Project Baru
    </a>
</div>

@if(session('success'))
    <div class="mb-8 p-4 bg-green-500/10 border border-green-500/20 text-green-500 rounded-2xl text-sm font-medium flex items-center gap-3 animate-fade-in">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

<div class="bg-gray-900 shadow-2xl border border-white/5 rounded-3xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-white/5 bg-white/2">
                    <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest">Project</th>
                    <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest">Kategori</th>
                    <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest">Status</th>
                    <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($portfolios as $portfolio)
                <tr class="hover:bg-white/2 transition-colors">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-12 rounded-xl border border-white/10 overflow-hidden flex-shrink-0">
                                <img src="{{ asset('storage/' . $portfolio->image) }}" alt="" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-white">{{ $portfolio->title }}</h4>
                                <p class="text-[10px] text-gray-500 mt-1 truncate max-w-[200px]">{{ $portfolio->link ?? 'No Link' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-5">
                        <span class="px-3 py-1 bg-white/5 border border-white/5 text-gray-400 text-[10px] font-bold rounded-full uppercase tracking-wider">
                            {{ $portfolio->category }}
                        </span>
                    </td>
                    <td class="px-8 py-5">
                        @if($portfolio->is_featured)
                            <span class="flex items-center gap-2 text-primary text-[10px] font-black uppercase tracking-tighter">
                                <i class="fas fa-star text-[8px]"></i>
                                Featured
                            </span>
                        @else
                            <span class="text-gray-600 text-[10px] font-bold uppercase tracking-tighter">Standard</span>
                        @endif
                    </td>
                    <td class="px-8 py-5">
                        <div class="flex items-center justify-center gap-3">
                            <a href="{{ route('admin.portfolio.edit', $portfolio) }}" class="w-9 h-9 rounded-xl bg-gray-800 text-gray-400 flex items-center justify-center hover:bg-primary/20 hover:text-primary transition-all">
                                <i class="fas fa-edit text-sm"></i>
                            </a>
                            <form action="{{ route('admin.portfolio.destroy', $portfolio) }}" method="POST" onsubmit="return confirm('Hapus project ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-9 h-9 rounded-xl bg-gray-800 text-gray-400 flex items-center justify-center hover:bg-red-500/20 hover:text-red-500 transition-all">
                                    <i class="fas fa-trash-alt text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-20 text-center">
                        <div class="flex flex-col items-center gap-4">
                            <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center text-gray-700 text-2xl">
                                <i class="fas fa-folder-open"></i>
                            </div>
                            <p class="text-gray-500 text-sm font-bold uppercase tracking-widest">Belum ada project di portfolio Anda</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($portfolios->hasPages())
        <div class="p-8 border-t border-white/5 bg-white/2">
            {{ $portfolios->links() }}
        </div>
    @endif
</div>
@endsection
