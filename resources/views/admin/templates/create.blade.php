@extends('layouts.admin')

@section('header_title', 'Tambah Template')
@section('header_subtitle', 'Buat konten baru untuk sistem.')

@section('admin_content')
<div class="px-6 py-4" x-data="{ 
    contentType: @js(old('content_type', 'link')), 
    tags: @js(old('tags') ? json_decode(old('tags'), true) : []), 
    tagInput: '',
    contentLink: @js(old('content', '')),
    thumbUrl: @js(old('thumbnail_url', '')),
    imgLoaded: false,
    
    addTag() {
        let val = this.tagInput.trim().replace(/,/g, '');
        if (val !== '') {
            if (!this.tags.includes(val)) {
                this.tags.push(val);
            }
            this.tagInput = '';
        }
    },
    removeTag(index) {
        this.tags.splice(index, 1);
    },
    getFinalThumb() {
        if (this.thumbUrl) return this.thumbUrl;
        if (this.contentLink && (this.contentLink.startsWith('http://') || this.contentLink.startsWith('https://'))) {
            return `https://s.wordpress.com/mshots/v1/${encodeURIComponent(this.contentLink)}?w=800`;
        }
        return '';
    },
    ensureProtocol() {
        if (this.contentLink && !this.contentLink.startsWith('http://') && !this.contentLink.startsWith('https://') && this.contentLink.includes('.')) {
            this.contentLink = 'https://' + this.contentLink;
        }
    }
}">
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('admin.templates.index') }}" class="w-10 h-10 flex items-center justify-center bg-white/5 hover:bg-white/10 text-gray-400 rounded-xl transition-all">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Tambah Template</h1>
            <p class="text-gray-400 text-sm">Buat konten baru untuk sistem.</p>
        </div>
    </div>

    @if ($errors->any())
    <div class="mb-6 bg-red-500/10 border border-red-500/20 rounded-2xl p-4 animate-in fade-in slide-in-from-top-4 duration-500">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-red-500/20 flex items-center justify-center text-red-500 shrink-0">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div>
                <h5 class="text-red-500 font-bold text-sm mb-1">Terjadi Kesalahan!</h5>
                <ul class="text-red-400/80 text-xs list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    <form action="{{ route('admin.templates.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white/[0.03] border border-white/10 rounded-3xl p-8 backdrop-blur-xl">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 flex items-center gap-2">
                            Nama Template
                            <span class="text-[8px] bg-red-500/20 text-red-500 px-2 py-0.5 rounded-full font-black">WAJIB</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Banner Promo Lebaran" required
                               class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all @error('name') border-red-500 ring-1 ring-red-500 @enderror">
                        @error('name') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Tag Template (Ketik & Enter/Spasi)</label>
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-3 flex flex-wrap gap-2 focus-within:border-blue-500 transition-all min-h-[58px]">
                            <template x-for="(tag, index) in tags" :key="index">
                                <span class="bg-blue-600/20 text-blue-400 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 border border-blue-500/20 animate-in fade-in zoom-in duration-300">
                                    <span x-text="tag"></span>
                                    <button type="button" @click="removeTag(index)" class="hover:text-red-400 transition-colors">
                                        <i class="fas fa-times text-[8px]"></i>
                                    </button>
                                </span>
                            </template>
                            <input type="text" x-model="tagInput" 
                                   @keydown.enter.prevent="addTag()" 
                                   @keydown.space.prevent="addTag()" 
                                   @keydown.comma.prevent="addTag()" 
                                   @blur="addTag()"
                                   placeholder="Contoh: Modern, Portfolio, Business..." 
                                   class="bg-transparent border-none focus:ring-0 focus:outline-none text-white text-sm flex-1 min-w-[200px] py-1 placeholder:text-gray-600">
                        </div>
                        <input type="hidden" name="tags" :value="JSON.stringify(tags)">
                        @error('tags') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        
                        <!-- Legacy fallback for 'type' column (using first tag or 'other') -->
                        <input type="hidden" name="type" :value="tags.length > 0 ? tags[0].toLowerCase().replace(/ /g, '_') : 'other'">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                        Konten Template (Link Demo)
                        <span class="text-[8px] bg-red-500/20 text-red-500 px-2 py-0.5 rounded-full font-black">WAJIB</span>
                    </label>
                    <div class="space-y-6">
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500 group-focus-within:text-blue-500 transition-colors">
                                <i class="fas fa-link"></i>
                            </div>
                            <input type="url" name="content" x-model="contentLink" required
                                   placeholder="https://example.com" 
                                   @input="imgLoaded = false"
                                   @blur="ensureProtocol()"
                                   @keydown.tab="addTag()"
                                   class="w-full bg-white/5 border border-white/10 rounded-xl pl-12 pr-4 py-3 text-white focus:outline-none focus:border-blue-500 transition-all font-mono text-sm tracking-tight @error('content') border-red-500 ring-1 ring-red-500 @enderror">
                            @error('content') <p class="text-red-500 text-[10px] mt-2 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div class="pt-4 border-t border-white/5">
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-3">Custom Thumbnail (Opsional)</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500 group-focus-within:text-blue-500 transition-colors">
                                    <i class="fas fa-image"></i>
                                </div>
                                <input type="url" name="thumbnail_url" x-model="thumbUrl" 
                                       placeholder="Tempel link gambar jika tidak ingin menggunakan snapshot otomatis" 
                                       @input="imgLoaded = false"
                                       class="w-full bg-white/5 border border-white/10 rounded-xl pl-12 pr-4 py-3 text-white focus:outline-none focus:border-blue-500 transition-all text-sm tracking-tight @error('thumbnail_url') border-red-500 ring-1 ring-red-500 @enderror">
                                @error('thumbnail_url') <p class="text-red-500 text-[10px] mt-2 font-bold">{{ $message }}</p> @enderror
                            </div>
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
                    
                    <!-- Hidden field for content type -->
                    <input type="hidden" name="content_type" value="link">
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
                <div class="bg-black/20 rounded-2xl p-4 border border-white/5 min-h-[350px] flex items-center justify-center text-center overflow-hidden h-full">
                    <div id="preview-area" class="text-gray-500 text-xs italic w-full h-full min-h-[300px]">
                        <template x-if="contentLink && (contentLink.startsWith('http://') || contentLink.startsWith('https://'))">
                            <div class="w-full flex flex-col bg-white rounded-xl shadow-2xl overflow-hidden border border-white/10" style="height: 350px;">
                                <div class="bg-gray-100 px-4 py-2 flex items-center gap-3 border-b">
                                    <div class="flex gap-1.5">
                                        <div class="w-2.5 h-2.5 rounded-full bg-red-400"></div>
                                        <div class="w-2.5 h-2.5 rounded-full bg-yellow-400"></div>
                                        <div class="w-2.5 h-2.5 rounded-full bg-green-400"></div>
                                    </div>
                                    <div class="flex-1 bg-white px-3 py-1 rounded-lg text-[10px] text-gray-400 truncate border border-gray-200 shadow-sm text-left" x-text="contentLink">
                                    </div>
                                </div>
                                <div class="flex-1 bg-gray-50 relative group">
                                    <!-- Loader -->
                                    <div x-show="!imgLoaded" class="absolute inset-0 flex flex-col items-center justify-center bg-gray-50 z-10 transition-opacity duration-500">
                                        <div class="w-8 h-8 border-4 border-blue-500/20 border-t-blue-500 rounded-full animate-spin mb-3"></div>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest" x-text="thumbUrl ? 'Loading Image...' : 'Generating Snapshot...'"></p>
                                    </div>

                                    <!-- Tags Preview Overlay -->
                                    <div class="absolute top-4 left-4 z-20 flex flex-wrap gap-2 max-w-[80%]">
                                        <template x-for="tag in tags">
                                            <span class="bg-blue-600 text-white text-[8px] font-black px-3 py-1.5 rounded-lg uppercase tracking-widest shadow-lg shadow-blue-500/20" x-text="tag"></span>
                                        </template>
                                        <template x-if="tags.length === 0">
                                            <span class="bg-gray-400 text-white text-[8px] font-black px-3 py-1.5 rounded-lg uppercase tracking-widest shadow-lg shadow-gray-500/20 italic">No Tags</span>
                                        </template>
                                    </div>

                                    <!-- Image -->
                                    <img :src="getFinalThumb()" 
                                         class="w-full h-full object-cover transition-opacity duration-1000"
                                         :class="imgLoaded ? 'opacity-100' : 'opacity-0'"
                                         @load="imgLoaded = true">
                                    
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-2 backdrop-blur-sm">
                                        <p class="text-white text-[10px] font-bold uppercase tracking-widest px-4 text-center" x-text="thumbUrl ? 'Custom Image Link' : 'Snapshot Website'"></p>
                                        <a :href="contentLink" target="_blank" class="px-4 py-1.5 bg-blue-600 text-white rounded-full text-[10px] font-bold shadow-lg shadow-blue-900/40">Buka Link Asli</a>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template x-if="!contentLink || (!contentLink.startsWith('http://') && !contentLink.startsWith('https://'))">
                            <div class="flex flex-col items-center gap-2">
                                <span class="text-gray-500 italic text-[10px]">Input URL untuk melihat preview...</span>
                                <span class="text-blue-500 font-mono text-[10px]" x-text="contentLink"></span>
                            </div>
                        </template>
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


@endsection
