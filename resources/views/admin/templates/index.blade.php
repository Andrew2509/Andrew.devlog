@extends('layouts.admin')

@section('header_title', 'Manajemen Template')
@section('header_subtitle', 'Kelola konten template untuk berbagai kebutuhan sistem.')

@section('admin_content')
<div class="px-6 py-4">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Manajemen Template</h1>
            <p class="text-gray-400 text-sm">Kelola konten template untuk berbagai kebutuhan sistem.</p>
        </div>
        <a href="{{ route('admin.templates.create') }}" class="flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition-all shadow-lg shadow-blue-900/20 group">
            <i class="fas fa-plus text-sm group-hover:rotate-90 transition-transform"></i>
            <span class="font-semibold text-sm">Tambah Template</span>
        </a>
    </div>

    @if(session('success'))
    <div class="mb-6 px-4 py-3 bg-green-500/10 border border-green-500/20 rounded-xl text-green-500 text-sm flex items-center gap-3">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white/[0.03] border border-white/10 rounded-3xl overflow-hidden backdrop-blur-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-white/10">
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Template</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Jenis</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Tipe Konten</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($templates as $template)
                    <tr class="hover:bg-white/[0.02] transition-colors group">
                        <td class="px-6 py-5">
                            <div class="flex flex-col">
                                <span class="text-sm font-semibold text-white group-hover:text-blue-400 transition-colors">{{ $template->name }}</span>
                                <span class="text-[10px] text-gray-500 mt-1 uppercase tracking-widest font-bold">Dibuat {{ $template->created_at->format('d M Y') }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <span class="px-3 py-1 bg-white/5 text-gray-400 rounded-full text-[11px] font-medium">
                                {{ \App\Models\Template::getTypes()[$template->type] ?? $template->type }}
                            </span>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-2">
                                @if($template->content_type == 'html')
                                    <i class="fas fa-code text-orange-400 text-xs"></i>
                                @elseif($template->content_type == 'link')
                                    <i class="fas fa-link text-blue-400 text-xs"></i>
                                @else
                                    <i class="fas fa-align-left text-green-400 text-xs"></i>
                                @endif
                                <span class="text-sm text-gray-300">
                                    {{ \App\Models\Template::getContentTypes()[$template->content_type] ?? $template->content_type }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            @if($template->status)
                                <span class="flex items-center gap-1.5 text-green-500 text-[11px] font-bold uppercase tracking-wider">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                                    Aktif
                                </span>
                            @else
                                <span class="flex items-center gap-1.5 text-gray-500 text-[11px] font-bold uppercase tracking-wider">
                                    <span class="w-1.5 h-1.5 bg-gray-600 rounded-full"></span>
                                    Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-5 text-right">
                            <div class="flex items-center justify-end gap-2 text-sm">
                                <a 
                                    href="{{ $template->content_type === 'link' ? $template->content : route('template.preview', $template->id) }}" 
                                    target="_blank" 
                                    class="w-9 h-9 flex items-center justify-center bg-blue-500/10 hover:bg-blue-500 text-blue-400 hover:text-white rounded-xl transition-all"
                                    title="Lihat Demo"
                                >
                                    <i class="fas fa-external-link-alt text-xs"></i>
                                </a>
                                <a href="{{ route('admin.templates.edit', $template->id) }}" class="w-9 h-9 flex items-center justify-center bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white rounded-xl transition-all">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.templates.destroy', $template->id) }}" method="POST" onsubmit="return confirm('Hapus template ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-9 h-9 flex items-center justify-center bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white rounded-xl transition-all">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center text-gray-600 mb-2">
                                    <i class="fas fa-file-code text-2xl"></i>
                                </div>
                                <span class="text-gray-500 font-medium">Belum ada template yang dibuat.</span>
                                <a href="{{ route('admin.templates.create') }}" class="text-blue-500 text-sm hover:underline">Buat template sekarang</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mt-6">
        {{ $templates->links() }}
    </div>
</div>
@endsection
