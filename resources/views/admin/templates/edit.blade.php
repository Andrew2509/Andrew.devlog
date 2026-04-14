@extends('layouts.admin')

@section('header_title', 'Edit Template')
@section('header_subtitle', 'Perbarui konten template Anda.')

@section('admin_content')
<div class="px-6 py-4" x-data="{ contentType: '{{ $template->content_type }}' }">
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('admin.templates.index') }}" class="w-10 h-10 flex items-center justify-center bg-white/5 hover:bg-white/10 text-gray-400 rounded-xl transition-all">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Edit Template</h1>
            <p class="text-gray-400 text-sm">Perbarui konten template Anda.</p>
        </div>
    </div>

    <form action="{{ route('admin.templates.update', $template->id) }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        @method('PUT')
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white/[0.03] border border-white/10 rounded-3xl p-8 backdrop-blur-xl">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Template</label>
                        <input type="text" name="name" value="{{ old('name', $template->name) }}" placeholder="Contoh: Banner Promo Lebaran" 
                               class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all @error('name') border-red-500 @enderror">
                        @error('name') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Jenis Template</label>
                        <select name="type" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 transition-all custom-select">
                            @foreach($types as $key => $label)
                                <option value="{{ $key }}" {{ old('type', $template->type) == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Tipe Konten</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach($contentTypes as $key => $label)
                        <label class="flex-1 min-w-[140px] cursor-pointer group">
                            <input type="radio" name="content_type" value="{{ $key }}" x-model="contentType" class="hidden" {{ old('content_type', $template->content_type) == $key ? 'checked' : '' }}>
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
                                  class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 transition-all">{{ $template->content_type == 'text' ? $template->content : old('content') }}</textarea>
                    </div>

                    <!-- Link Content -->
                    <div x-show="contentType === 'link'" class="space-y-4">
                        <input type="url" id="content_link" class="w-full bg-black/20 border border-white/5 rounded-2xl p-4 text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" value="{{ $template->content_type === 'link' ? $template->content : '' }}" placeholder="https://example.com">
                        
                        <!-- Tip Box -->
                        <div class="bg-blue-500/10 border border-blue-500/20 rounded-2xl p-6">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-blue-500/20 flex items-center justify-center text-blue-400 shrink-0">
                                    <i class="fas fa-lightbulb"></i>
                                </div>
                                <div class="flex-1">
                                    <h5 class="text-blue-400 font-bold mb-1">Tips Preview Terbaik</h5>
                                    <p class="text-gray-400 text-sm leading-relaxed">
                                        Gunakan <strong>Direct Link</strong> (Link Tanpa Frame) agar pratinjau tampil mewah tanpa error "Access Denied". 
                                        <br><br>
                                        <span class="text-xs text-blue-400/80 italic bg-blue-500/5 px-2 py-1 rounded-md border border-blue-500/10">
                                            Contoh HTML Codex: Klik "Remove Frame" lalu copy URL barunya.
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- HTML Content -->
                    <div x-show="contentType == 'html'" wire:ignore>
                        <textarea name="content_html" id="content_html" rows="10" placeholder="Editor HTML...">{{ $template->content_type == 'html' ? $template->content : old('content') }}</textarea>
                    </div>

                    <!-- Link Content -->
                    <div x-show="contentType == 'link'" class="space-y-4">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500">
                                <i class="fas fa-link"></i>
                            </div>
                            <input type="url" name="content_link" id="content_link" value="{{ $template->content_type == 'link' ? $template->content : old('content') }}" placeholder="https://example.com" 
                                   class="w-full bg-white/5 border border-white/10 rounded-xl pl-12 pr-4 py-3 text-white focus:outline-none focus:border-blue-500 transition-all">
                        </div>
                        <div class="flex items-center gap-2 px-1">
                            <input type="checkbox" name="is_new_tab" id="is_new_tab" value="1" {{ $template->is_new_tab ? 'checked' : '' }} class="w-4 h-4 bg-white/5 border-white/10 rounded text-blue-600 accent-blue-600">
                            <label for="is_new_tab" class="text-sm text-gray-400 cursor-pointer">Buka di tab baru (target="_blank")</label>
                        </div>
                    </div>
                    
                    @error('content') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    
                    <!-- Hidden field to unify content -->
                    <input type="hidden" name="content" id="final_content" value="{{ $template->content }}">
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
                            <input type="checkbox" name="status" id="status" value="1" {{ $template->status ? 'checked' : '' }} class="absolute opacity-0 w-full h-full cursor-pointer z-10 peer">
                            <div class="absolute inset-x-0 w-6 h-6 bg-white rounded-full transition-all duration-200 left-0 peer-checked:left-6 peer-checked:bg-blue-600 shadow-sm border border-white/10"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white/[0.03] border border-white/10 rounded-3xl p-6 backdrop-blur-xl">
                <h3 class="text-sm font-bold text-white mb-4 flex items-center gap-2">
                    <i class="fas fa-eye text-orange-500"></i> Preview
                </h3>
                <div class="bg-black/20 rounded-2xl p-4 border border-white/5 min-h-[350px] flex items-center justify-center text-center overflow-hidden h-full">
                    <div id="preview-area" class="text-gray-300 text-xs w-full h-full min-h-[300px]">
                        @if($template->content_type == 'html')
                            {!! $template->content !!}
                        @elseif($template->content_type == 'link')
                            @if(Str::startsWith($template->content, ['http://', 'https://']))
                                <div class="w-full flex flex-col bg-white rounded-xl shadow-2xl overflow-hidden border border-white/10" style="height: 350px;">
                                    <div class="bg-gray-100 px-4 py-2 flex items-center gap-3 border-b">
                                        <div class="flex gap-1.5">
                                            <div class="w-2.5 h-2.5 rounded-full bg-red-400"></div>
                                            <div class="w-2.5 h-2.5 rounded-full bg-yellow-400"></div>
                                            <div class="w-2.5 h-2.5 rounded-full bg-green-400"></div>
                                        </div>
                                        <div class="flex-1 bg-white px-3 py-1 rounded-lg text-[10px] text-gray-400 truncate border border-gray-200 shadow-sm">
                                            {{ $template->content }}
                                        </div>
                                        <a href="{{ $template->content }}" target="_blank" class="text-blue-500 hover:text-blue-700">
                                            <i class="fas fa-external-link-alt text-[10px]"></i>
                                        </a>
                                    </div>
                                    <div class="flex-1 bg-gray-50 relative group">
                                        <img src="https://s.wordpress.com/mshots/v1/{{ urlencode($template->content) }}?w=800" class="w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-2 backdrop-blur-sm">
                                            <p class="text-white text-[10px] font-bold uppercase tracking-widest px-4 text-center">Snapshot Website</p>
                                            <a href="{{ $template->content }}" target="_blank" class="px-4 py-1.5 bg-blue-600 text-white rounded-full text-[10px] font-bold shadow-lg shadow-blue-900/40">Buka Link Asli</a>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <a href="{{ $template->content }}" target="_blank" class="text-blue-500 underline">{{ $template->content }}</a>
                            @endif
                        @else
                            {{ $template->content }}
                        @endif
                    </div>
                </div>
            </div>

            <button type="submit" id="btn-save" class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-bold tracking-wide transition-all shadow-xl shadow-blue-900/30 flex items-center justify-center gap-2">
                <i class="fas fa-save"></i>
                PERBARUI TEMPLATE
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

        function transformUrl(url) {
            if (!url) return url;
            // HTML Codex transformation
            const codexRegex = /htmlcodex\.com\/([^\/]+)-website-template\/?$/i;
            const match = url.match(codexRegex);
            if (match) {
                return `https://htmlcodex.com/demo/?template=${match[1]}`;
            }
            return url;
        }

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
                // Auto transform URL
                const originalUrl = linkInput.value;
                const transformedUrl = transformUrl(originalUrl);
                
                if (originalUrl !== transformedUrl) {
                    linkInput.value = transformedUrl;
                    val = transformedUrl;
                } else {
                    val = originalUrl;
                }

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
                                <a href="${val}" target="_blank" class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-external-link-alt text-[10px]"></i>
                                </a>
                            </div>
                            <div class="flex-1 bg-gray-50 relative group">
                                <img src="https://s.wordpress.com/mshots/v1/${encodeURIComponent(val)}?w=800" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-2 backdrop-blur-sm">
                                    <p class="text-white text-[10px] font-bold uppercase tracking-widest px-4 text-center">Snapshot Website</p>
                                    <a href="${val}" target="_blank" class="px-4 py-1.5 bg-blue-600 text-white rounded-full text-[10px] font-bold shadow-lg shadow-blue-900/40">Buka Link Asli</a>
                                </div>
                            </div>
                        </div>`;
                } else {
                    previewArea.innerHTML = val ? `<a href="${val}" target="_blank" class="text-blue-500 underline">${val}</a>` : 'Input URL...';
                }
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
        
        // Initial sync
        setTimeout(updatePreview, 500);
    });
</script>
@endsection
