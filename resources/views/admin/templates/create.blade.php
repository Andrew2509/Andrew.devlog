@extends('layouts.admin')

@section('header_title', 'Tambah Template')
@section('header_subtitle', 'Buat konten baru untuk sistem.')

@section('admin_content')
<div class="px-6 py-4" x-data="{ contentType: 'text' }">
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('admin.templates.index') }}" class="w-10 h-10 flex items-center justify-center bg-white/5 hover:bg-white/10 text-gray-400 rounded-xl transition-all">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Tambah Template</h1>
            <p class="text-gray-400 text-sm">Buat konten baru untuk sistem.</p>
        </div>
    </div>

    <form action="{{ route('admin.templates.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white/[0.03] border border-white/10 rounded-3xl p-8 backdrop-blur-xl">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Template</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Banner Promo Lebaran" 
                               class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all @error('name') border-red-500 @enderror">
                        @error('name') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Jenis Template</label>
                        <select name="type" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 transition-all custom-select">
                            @foreach($types as $key => $label)
                                <option value="{{ $key }}" {{ old('type') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Konten Template (Link Demo)</label>
                    <div class="space-y-4">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500">
                                <i class="fas fa-link"></i>
                            </div>
                            <input type="url" name="content_link" id="content_link" value="{{ old('content') }}" placeholder="https://example.com" 
                                   class="w-full bg-white/5 border border-white/10 rounded-xl pl-12 pr-4 py-3 text-white focus:outline-none focus:border-blue-500 transition-all font-mono text-sm tracking-tight @error('content') border-red-500 @enderror">
                        </div>

                        <!-- Info Box -->
                        <div class="bg-blue-500/10 border border-blue-500/20 rounded-2xl p-6 shadow-xl shadow-blue-500/5">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-blue-500/20 flex items-center justify-center text-blue-400 shrink-0">
                                    <i class="fas fa-magic"></i>
                                </div>
                                <div class="flex-1">
                                    <h5 class="text-blue-400 font-bold text-sm mb-1">Otomasi Pintar</h5>
                                    <p class="text-gray-400 text-xs leading-relaxed">
                                        Cukup tempelkan link website. Sistem kami akan memprosesnya untuk memberikan pratinjau snapshot terbaik secara otomatis.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 px-1">
                            <input type="checkbox" name="is_new_tab" id="is_new_tab" value="1" checked class="w-4 h-4 bg-white/5 border-white/10 rounded text-blue-600 accent-blue-600 cursor-pointer">
                            <label for="is_new_tab" class="text-sm text-gray-400 cursor-pointer">Buka pratinjau di tab baru</label>
                        </div>
                    </div>
                    
                    @error('content') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    
                    <!-- Hidden field to unify content -->
                    <input type="hidden" name="content_type" value="link">
                    <input type="hidden" name="content" id="final_content">
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white/[0.03] border border-white/10 rounded-3xl p-6 backdrop-blur-xl">
                <h3 class="text-sm font-bold text-white mb-4 flex items-center gap-2">
                    <i class="fas fa-cog text-blue-500"></i> Setelan
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 rounded-2xl bg-white/5 border border-white/5">
                        <span class="text-sm text-gray-300 font-medium">Status Aktif</span>
                        <div class="relative inline-block w-12 h-6 transition duration-200 ease-in-out bg-white/10 rounded-full cursor-pointer">
                            <input type="checkbox" name="status" id="status" value="1" checked class="absolute opacity-0 w-full h-full cursor-pointer z-10 peer">
                            <div class="absolute inset-x-0 w-6 h-6 bg-white rounded-full transition-all duration-200 left-0 peer-checked:left-6 peer-checked:bg-blue-600 shadow-sm border border-white/10"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white/[0.03] border border-white/10 rounded-3xl p-6 backdrop-blur-xl">
                <h3 class="text-sm font-bold text-white mb-4 flex items-center gap-2">
                    <i class="fas fa-eye text-orange-500"></i> Preview
                </h3>
                <div class="bg-black/20 rounded-2xl p-4 border border-white/5 min-h-[300px] flex items-center justify-center text-center overflow-hidden h-full">
                    <div id="preview-area" class="text-gray-500 text-xs italic w-full h-full min-h-[250px]">
                        Input konten untuk melihat preview...
                    </div>
                </div>
            </div>

            <button type="submit" id="btn-save" class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-bold tracking-wide transition-all shadow-xl shadow-blue-900/30 flex items-center justify-center gap-2">
                <i class="fas fa-save"></i>
                SIMPAN TEMPLATE
            </button>
        </div>
    </form>
</div>

<style>
    .tox-tinymce { border: none !important; border-radius: 12px !important; }
    .custom-select { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='white'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1rem; }
    option { background-color: #1a1a1a; color: white; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const linkInput = document.getElementById('content_link');
        const previewArea = document.getElementById('preview-area');
        const finalInput = document.getElementById('final_content');
        const form = document.querySelector('form');

        function updatePreview() {
            const val = linkInput.value;
            
            if (val && (val.startsWith('http://') || val.startsWith('https://'))) {
                previewArea.innerHTML = `
                    <div class="w-full flex flex-col bg-white rounded-xl shadow-2xl overflow-hidden border border-white/10" style="height: 350px;">
                        <div class="bg-gray-100 px-4 py-2 flex items-center gap-3 border-b">
                            <div class="flex gap-1.5">
                                <div class="w-2.5 h-2.5 rounded-full bg-red-400"></div>
                                <div class="w-2.5 h-2.5 rounded-full bg-yellow-400"></div>
                                <div class="w-2.5 h-2.5 rounded-full bg-green-400"></div>
                            </div>
                            <div class="flex-1 bg-white px-3 py-1 rounded-lg text-[10px] text-gray-400 truncate border border-gray-200 shadow-sm">
                                ${val}
                            </div>
                        </div>
                        <div class="flex-1 bg-gray-50 relative group">
                            <div id="snapshot-loader" class="absolute inset-0 flex flex-col items-center justify-center bg-gray-50 z-10 transition-opacity duration-500">
                                <div class="w-8 h-8 border-4 border-blue-500/20 border-t-blue-500 rounded-full animate-spin mb-3"></div>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Generating Snapshot...</p>
                            </div>
                            <img src="https://s.wordpress.com/mshots/v1/${encodeURIComponent(val)}?w=800" 
                                 class="w-full h-full object-cover transition-opacity duration-1000 opacity-0"
                                 onload="this.classList.remove('opacity-0'); document.getElementById('snapshot-loader').classList.add('opacity-0'); setTimeout(() => document.getElementById('snapshot-loader').remove(), 500);">
                            
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-2 backdrop-blur-sm">
                                <p class="text-white text-[10px] font-bold uppercase tracking-widest px-4 text-center">Snapshot Website</p>
                                <a href="${val}" target="_blank" class="px-4 py-1.5 bg-blue-600 text-white rounded-full text-[10px] font-bold shadow-lg shadow-blue-900/40">Buka Link Asli</a>
                            </div>
                        </div>
                    </div>`;
            } else {
                previewArea.innerHTML = val ? `<a href="${val}" target="_blank" class="text-blue-500 underline text-xs font-mono">${val}</a>` : '<span class="text-gray-500 italic text-[10px]">Input URL untuk melihat preview...</span>';
            }
            finalInput.value = val;
        }

        linkInput.addEventListener('input', updatePreview);
        linkInput.addEventListener('blur', updatePreview);

        form.addEventListener('submit', function() {
            finalInput.value = linkInput.value;
        });

        // Initial sync
        updatePreview();
    });
</script>
@endsection
