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
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Tipe Konten</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach($contentTypes as $key => $label)
                        <label class="flex-1 min-w-[140px] cursor-pointer group">
                            <input type="radio" name="content_type" value="{{ $key }}" x-model="contentType" class="hidden" {{ $loop->first ? 'checked' : '' }}>
                            <div class="px-4 py-4 rounded-2xl border transition-all flex flex-col items-center gap-2"
                                 :class="contentType == '{{ $key }}' ? 'bg-blue-600/10 border-blue-600 text-blue-500' : 'bg-white/5 border-white/10 text-gray-500 group-hover:bg-white/[0.07]'">
                                <i class="fas @if($key == 'text') fa-align-left @elseif($key == 'html') fa-code @else fa-link @endif text-xl"></i>
                                <span class="text-[11px] font-bold uppercase tracking-wider">{{ $label }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Konten Template</label>
                    
                    <!-- Text Content -->
                    <div x-show="contentType == 'text'">
                        <textarea name="content_text" id="content_text" rows="6" placeholder="Masukkan teks biasa..."
                                  class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 transition-all">{{ old('content') }}</textarea>
                    </div>

                    <!-- HTML Content -->
                    <div x-show="contentType == 'html'" wire:ignore>
                        <textarea name="content_html" id="content_html" rows="10" placeholder="Editor HTML...">{{ old('content') }}</textarea>
                    </div>

                    <!-- Link Content -->
                    <div x-show="contentType == 'link'" class="space-y-4">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500">
                                <i class="fas fa-link"></i>
                            </div>
                            <input type="url" name="content_link" id="content_link" value="{{ old('content') }}" placeholder="https://example.com" 
                                   class="w-full bg-white/5 border border-white/10 rounded-xl pl-12 pr-4 py-3 text-white focus:outline-none focus:border-blue-500 transition-all">
                        </div>
                        <div class="flex items-center gap-2 px-1">
                            <input type="checkbox" name="is_new_tab" id="is_new_tab" value="1" class="w-4 h-4 bg-white/5 border-white/10 rounded text-blue-600 accent-blue-600">
                            <label for="is_new_tab" class="text-sm text-gray-400 cursor-pointer">Buka di tab baru (target="_blank")</label>
                        </div>
                    </div>
                    
                    @error('content') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    
                    <!-- Hidden field to unify content -->
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
                <div class="bg-black/20 rounded-2xl p-4 border border-white/5 min-h-[150px] flex items-center justify-center text-center">
                    <div id="preview-area" class="text-gray-500 text-xs italic">
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

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        tinymce.init({
            selector: '#content_html',
            height: 400,
            skin: 'oxide-dark',
            content_css: 'dark',
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
            toolbar: 'undo redo | blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            setup: function (editor) {
                editor.on('change', function () {
                    updatePreview();
                });
            }
        });

        const contentTypeInputs = document.querySelectorAll('input[name="content_type"]');
        const textInput = document.getElementById('content_text');
        const linkInput = document.getElementById('content_link');
        const previewArea = document.getElementById('preview-area');
        const finalInput = document.getElementById('final_content');
        const form = document.querySelector('form');

        function updatePreview() {
            const type = document.querySelector('input[name="content_type"]:checked').value;
            let val = '';

            if (type === 'text') {
                val = textInput.value;
                previewArea.innerText = val || 'Input konten untuk melihat preview...';
            } else if (type === 'html') {
                val = tinymce.get('content_html').getContent();
                previewArea.innerHTML = val || 'Input konten untuk melihat preview...';
            } else if (type === 'link') {
                val = linkInput.value;
                previewArea.innerHTML = val ? `<a href="${val}" target="_blank" class="text-blue-500 underline">${val}</a>` : 'Input URL...';
            }
            finalInput.value = val;
        }

        contentTypeInputs.forEach(input => {
            input.addEventListener('change', updatePreview);
        });

        textInput.addEventListener('input', updatePreview);
        linkInput.addEventListener('input', updatePreview);

        form.addEventListener('submit', function() {
            const type = document.querySelector('input[name="content_type"]:checked').value;
            if (type === 'text') {
                finalInput.value = textInput.value;
            } else if (type === 'html') {
                finalInput.value = tinymce.get('content_html').getContent();
            } else if (type === 'link') {
                finalInput.value = linkInput.value;
            }
        });
    });
</script>
@endsection
