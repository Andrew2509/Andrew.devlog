@extends('layouts.admin')

@section('title', 'Edit Client - Admin Dashboard')
@section('header_title', 'Edit Client')
@section('header_subtitle', 'Perbarui detail perusahaan partner atau client Anda.')

@section('admin_content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white/5 backdrop-blur-xl rounded-[2.5rem] border border-white/5 overflow-hidden shadow-2xl">
        <form action="{{ route('admin.clients.update', $client->id) }}" method="POST" enctype="multipart/form-data" class="p-10 space-y-8">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Name -->
                <div class="space-y-3">
                    <label class="text-sm font-bold text-gray-400 uppercase tracking-widest px-1">Nama Perusahaan <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $client->name) }}" placeholder="Contoh: Google, Microsoft, dll." required
                        class="w-full bg-white/5 border border-white/10 text-white px-6 py-4 rounded-2xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all placeholder:text-gray-600">
                    @error('name')<p class="text-red-500 text-xs mt-1 px-1">{{ $message }}</p>@enderror
                </div>

                <!-- Order -->
                <div class="space-y-3">
                    <label class="text-sm font-bold text-gray-400 uppercase tracking-widest px-1">Urutan Tampil</label>
                    <input type="number" name="order" value="{{ old('order', $client->order) }}" placeholder="0"
                        class="w-full bg-white/5 border border-white/10 text-white px-6 py-4 rounded-2xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all placeholder:text-gray-600">
                    @error('order')<p class="text-red-500 text-xs mt-1 px-1">{{ $message }}</p>@enderror
                </div>

                <!-- URL -->
                <div class="space-y-3 md:col-span-2">
                    <label class="text-sm font-bold text-gray-400 uppercase tracking-widest px-1">Website URL (Optional)</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none text-gray-600 group-focus-within:text-primary transition-colors">
                            <i class="fas fa-link"></i>
                        </div>
                        <input type="url" name="url" value="{{ old('url', $client->url) }}" placeholder="https://example.com"
                            class="w-full bg-white/5 border border-white/10 text-white pl-14 pr-6 py-4 rounded-2xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all placeholder:text-gray-600">
                    </div>
                    @error('url')<p class="text-red-500 text-xs mt-1 px-1">{{ $message }}</p>@enderror
                </div>

                @php
                    $isUrl = str_starts_with($client->logo, 'http');
                @endphp
                
                <!-- Logo -->
                <div class="space-y-3 md:col-span-2 border-t border-white/5 pt-8">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
                        <label class="text-sm font-bold text-gray-400 uppercase tracking-widest px-1">Logo Perusahaan</label>
                        
                        <!-- Toggle -->
                        <div class="flex p-1 bg-white/5 rounded-xl border border-white/10 w-fit">
                            <button type="button" onclick="setLogoType('file')" id="btn-file" class="px-4 py-2 rounded-lg font-black text-[10px] uppercase tracking-widest transition-all {{ !$isUrl ? 'bg-primary text-black' : 'text-gray-400 hover:text-white' }}">
                                <i class="fas fa-upload mr-2"></i> Upload File
                            </button>
                            <button type="button" onclick="setLogoType('url')" id="btn-url" class="px-4 py-2 rounded-lg font-black text-[10px] uppercase tracking-widest transition-all {{ $isUrl ? 'bg-primary text-black' : 'text-gray-400 hover:text-white' }}">
                                <i class="fas fa-link mr-2"></i> Link URL
                            </button>
                        </div>
                        <input type="hidden" name="logo_type" id="logo_type" value="{{ old('logo_type', $isUrl ? 'url' : 'file') }}">
                    </div>

                    <div class="relative group">
                        <!-- File Input Container -->
                        <div id="file-input-container" class="{{ old('logo_type', $isUrl ? 'url' : 'file') == 'file' ? '' : 'hidden' }}">
                            <label for="logo" class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-white/10 rounded-3xl cursor-pointer bg-white/5 hover:bg-white/[0.08] hover:border-primary/30 transition-all group overflow-hidden">
                                <div id="preview-placeholder" class="flex flex-col items-center justify-center pt-5 pb-6 {{ !$isUrl && $client->logo ? 'hidden' : '' }}">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-600 group-hover:text-primary mb-3 transition-colors"></i>
                                    <p class="mb-2 text-sm text-gray-400 font-bold tracking-tight">Ketik atau seret logo baru ke sini</p>
                                    <p class="text-xs text-gray-600">Atau biarkan kosong untuk tetap menggunakan yang lama</p>
                                </div>
                                <img id="logo-preview-file" src="{{ !$isUrl ? $client->logo_url : '' }}" class="absolute inset-0 w-full h-full object-contain p-6 bg-white {{ !$isUrl && $client->logo ? '' : 'hidden' }}" />
                                <input id="logo" name="logo" type="file" class="hidden" accept="image/*" onchange="previewImage(this)" />
                            </label>
                        </div>

                        <!-- URL Input Container -->
                        <div id="url-input-container" class="{{ old('logo_type', $isUrl ? 'url' : 'file') == 'url' ? '' : 'hidden' }} space-y-4">
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none text-gray-600 group-focus-within:text-primary transition-colors">
                                    <i class="fas fa-image"></i>
                                </div>
                                <input type="url" name="logo_url" id="logo_url" value="{{ old('logo_url', $isUrl ? $client->logo : '') }}" placeholder="https://example.com/logo.png"
                                    class="w-full bg-white/5 border border-white/10 text-white pl-14 pr-6 py-4 rounded-2xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all placeholder:text-gray-600"
                                    oninput="previewUrl(this.value)">
                            </div>
                            <!-- URL Preview -->
                            <div id="url-preview-container" class="{{ $isUrl || old('logo_url') ? '' : 'hidden' }} border-2 border-dashed border-white/10 rounded-3xl h-48 overflow-hidden bg-white p-6">
                                <img id="logo-preview-url" src="{{ old('logo_url', $isUrl ? $client->logo : '') }}" class="w-full h-full object-contain" />
                            </div>
                        </div>
                    </div>
                    @error('logo')<p class="text-red-500 text-xs mt-1 px-1">{{ $message }}</p>@enderror
                    @error('logo_url')<p class="text-red-500 text-xs mt-1 px-1">{{ $message }}</p>@enderror
                </div>

                <!-- Status -->
                <div class="md:col-span-2">
                    <div class="flex items-center gap-4 bg-white/5 p-6 rounded-2xl border border-white/10">
                        <div class="w-12 h-12 rounded-xl bg-primary/20 flex items-center justify-center text-primary">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-white font-bold">Status Aktif</p>
                            <p class="text-gray-500 text-xs mt-1">Tampilkan client ini di marquee beranda.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ $client->is_active ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-14 h-7 bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-1 after:left-1 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary shadow-lg"></div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4 pt-6">
                <a href="{{ route('admin.clients.index') }}" class="flex-1 px-8 py-4 bg-white/5 hover:bg-white/10 text-white rounded-2xl font-bold text-center transition-all">Batal</a>
                <button type="submit" class="flex-[2] px-8 py-4 bg-primary hover:bg-primary-dark text-white rounded-2xl font-bold transition-all shadow-xl shadow-primary/20 hover:-translate_y-1 active:scale-95">Perbarui Client</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function setLogoType(type) {
        const logoTypeInput = document.getElementById('logo_type');
        const fileContainer = document.getElementById('file-input-container');
        const urlContainer = document.getElementById('url-input-container');
        const btnFile = document.getElementById('btn-file');
        const btnUrl = document.getElementById('btn-url');

        logoTypeInput.value = type;

        if (type === 'file') {
            fileContainer.classList.remove('hidden');
            urlContainer.classList.add('hidden');
            
            btnFile.classList.add('bg-primary', 'text-black');
            btnFile.classList.remove('text-gray-400', 'hover:text-white');
            
            btnUrl.classList.remove('bg-primary', 'text-black');
            btnUrl.classList.add('text-gray-400', 'hover:text-white');
        } else {
            fileContainer.classList.add('hidden');
            urlContainer.classList.remove('hidden');
            
            btnUrl.classList.add('bg-primary', 'text-black');
            btnUrl.classList.remove('text-gray-400', 'hover:text-white');
            
            btnFile.classList.remove('bg-primary', 'text-black');
            btnFile.classList.add('text-gray-400', 'hover:text-white');
        }
    }

    function previewImage(input) {
        const preview = document.getElementById('logo-preview-file');
        const placeholder = document.getElementById('preview-placeholder');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewUrl(url) {
        const preview = document.getElementById('logo-preview-url');
        const container = document.getElementById('url-preview-container');
        
        if (url && (url.match(/\.(jpeg|jpg|gif|png|webp|svg)$/) != null || url.includes('http'))) {
            preview.src = url;
            container.classList.remove('hidden');
            
            preview.onerror = function() {
                container.classList.add('hidden');
            };
        } else {
            container.classList.add('hidden');
        }
    }

    // Initialize on load
    document.addEventListener('DOMContentLoaded', function() {
        const currentType = document.getElementById('logo_type').value;
        const currentUrl = document.getElementById('logo_url').value;
        setLogoType(currentType);
        if (currentUrl) previewUrl(currentUrl);
    });
</script>
@endsection
