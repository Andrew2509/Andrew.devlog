@extends('layouts.admin')

@section('title', 'Tambah Portfolio - ' . setting('site_name', 'Andrew.Devlog') . ' Admin')
@section('header_title', 'Tambah Project')
@section('header_subtitle', 'Publikasikan karya digital terbaru Anda.')

@section('admin_content')
<div class="mb-8">
    <a href="{{ route('admin.portfolio.index') }}" class="text-gray-500 hover:text-primary text-xs font-bold uppercase tracking-widest flex items-center gap-2 transition-colors">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Daftar
    </a>
</div>

<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data" class="bg-gray-900 shadow-2xl border border-white/5 rounded-[40px] p-10 space-y-10">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Basic Info -->
            <div class="space-y-6">
                <div>
                    <label class="block text-gray-500 text-[10px] font-black uppercase tracking-widest mb-3 ml-1" for="title">Judul Proyek</label>
                    <input type="text" name="title" id="title" required value="{{ old('title') }}"
                        class="w-full bg-white border {{ $errors->has('title') ? 'border-red-500/50' : 'border-white/5' }} text-gray-900 px-6 py-4 rounded-2xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none font-medium"
                        placeholder="Contoh: E-Commerce Store V2">
                    @error('title')
                        <p class="mt-2 text-red-500 text-[10px] font-bold ml-1 uppercase">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-500 text-[10px] font-black uppercase tracking-widest mb-3 ml-1" for="category">Kategori</label>
                    <input type="text" name="category" id="category" required value="{{ old('category') }}"
                        class="w-full bg-white border {{ $errors->has('category') ? 'border-red-500/50' : 'border-white/5' }} text-gray-900 px-6 py-4 rounded-2xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none font-medium"
                        placeholder="Contoh: Web Development / UI Design">
                    @error('category')
                        <p class="mt-2 text-red-500 text-[10px] font-bold ml-1 uppercase">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-500 text-[10px] font-black uppercase tracking-widest mb-3 ml-1" for="link">Live URL (Opsional)</label>
                    <input type="url" name="link" id="link" value="{{ old('link') }}"
                        class="w-full bg-white border border-white/5 text-gray-900 px-6 py-4 rounded-2xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none font-medium"
                        placeholder="https://example.com">
                </div>
            </div>

            <!-- Image Upload Section -->
            <div class="space-y-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-2">
                    <label class="block text-gray-500 text-[10px] font-black uppercase tracking-widest ml-1">Gambar Preview <span class="text-red-500">*</span></label>
                    
                    <!-- Toggle -->
                    <div class="flex p-1 bg-white/5 rounded-xl border border-white/10 w-fit">
                        <button type="button" onclick="setImageType('file')" id="btn-file" class="px-3 py-1.5 rounded-lg font-black text-[9px] uppercase tracking-widest transition-all bg-primary text-black">
                            FILE
                        </button>
                        <button type="button" onclick="setImageType('url')" id="btn-url" class="px-3 py-1.5 rounded-lg font-black text-[9px] uppercase tracking-widest transition-all text-gray-400 hover:text-white">
                            URL
                        </button>
                    </div>
                    <input type="hidden" name="image_type" id="image_type" value="{{ old('image_type', 'file') }}">
                </div>

                <div class="relative group">
                    <!-- File Input Container -->
                    <div id="file-input-container" class="{{ old('image_type', 'file') == 'file' ? '' : 'hidden' }}">
                        <div class="w-full aspect-[4/3] bg-white/2 border-2 border-dashed border-white/5 rounded-[32px] flex flex-col items-center justify-center transition-all group-hover:bg-white/5 group-hover:border-primary/30 overflow-hidden relative cursor-pointer" onclick="document.getElementById('image').click()">
                            <img id="preview-file" class="absolute inset-0 w-full h-full object-cover hidden">
                            <div id="placeholder-file" class="text-center flex flex-col items-center gap-3">
                                <div class="w-12 h-12 bg-primary/10 rounded-2xl flex items-center justify-center text-primary text-xl">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest leading-relaxed">Pilih Gambar<br><span class="text-gray-600 font-medium tracking-normal">(Max 4MB, Rekomendasi 4:3)</span></p>
                            </div>
                        </div>
                        <input type="file" name="image" id="image" class="hidden" accept="image/*" onchange="previewImage(this)">
                    </div>

                    <!-- URL Input Container -->
                    <div id="url-input-container" class="{{ old('image_type') == 'url' ? '' : 'hidden' }} space-y-4">
                        <div class="relative group">
                            <input type="url" name="image_url" id="image_url" value="{{ old('image_url') }}" placeholder="https://example.com/image.jpg"
                                class="w-full bg-white border border-white/5 text-gray-900 px-6 py-4 rounded-2xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none font-medium"
                                oninput="previewUrl(this.value)">
                        </div>
                        <!-- URL Preview -->
                        <div id="url-preview-container" class="hidden border-2 border-dashed border-white/5 rounded-[32px] aspect-[4/3] overflow-hidden bg-white/2 relative">
                            <img id="preview-url" src="" class="absolute inset-0 w-full h-full object-cover" />
                        </div>
                    </div>
                </div>
                @error('image')<p class="mt-2 text-red-500 text-[10px] font-bold ml-1 uppercase">{{ $message }}</p>@enderror
                @error('image_url')<p class="mt-2 text-red-500 text-[10px] font-bold ml-1 uppercase">{{ $message }}</p>@enderror
            </div>
        </div>

        <!-- Description -->
        <div>
            <label class="block text-gray-500 text-[10px] font-black uppercase tracking-widest mb-3 ml-1" for="description">Deskripsi Project</label>
            <textarea name="description" id="description" required rows="4"
                class="w-full bg-white border {{ $errors->has('description') ? 'border-red-500/50' : 'border-white/5' }} text-gray-900 px-6 py-6 rounded-[32px] focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none font-medium"
                placeholder="Ceritakan sedikit tentang proyek ini, tantangan, and solusi...">{{ old('description') }}</textarea>
            @error('description')
                <p class="mt-2 text-red-500 text-[10px] font-bold ml-1 uppercase">{{ $message }}</p>
            @enderror
        </div>

        <!-- Featured Status -->
        <div class="flex items-center gap-4 bg-white/2 border border-white/5 p-6 rounded-3xl">
            <label class="relative inline-flex items-center cursor-pointer group">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" class="sr-only peer">
                <div class="w-14 h-7 bg-gray-800 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-gray-500 after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary peer-checked:after:bg-white"></div>
            </label>
            <div class="leading-tight">
                <p class="text-sm font-bold text-white uppercase tracking-tighter">Project Utama (Featured)</p>
                <p class="text-[10px] text-gray-500 font-medium">Tampilkan di posisi teratas halaman utama.</p>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-black py-5 rounded-[32px] transition-all shadow-lg shadow-primary/20 hover:shadow-primary/40 active:scale-[0.98] flex items-center justify-center gap-3 group">
                <span>TERBITKAN PROJECT</span>
                <i class="fas fa-bolt group-hover:scale-125 transition-transform"></i>
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    function setImageType(type) {
        const imageTypeInput = document.getElementById('image_type');
        const fileContainer = document.getElementById('file-input-container');
        const urlContainer = document.getElementById('url-input-container');
        const btnFile = document.getElementById('btn-file');
        const btnUrl = document.getElementById('btn-url');

        imageTypeInput.value = type;

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
        const preview = document.getElementById('preview-file');
        const placeholder = document.getElementById('placeholder-file');
        
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
        const preview = document.getElementById('preview-url');
        const container = document.getElementById('url-preview-container');
        
        if (url && (url.startsWith('http') || url.match(/\.(jpeg|jpg|gif|png|webp|svg)$/) != null)) {
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
        const currentType = document.getElementById('image_type').value;
        const currentUrl = document.getElementById('image_url').value;
        setImageType(currentType);
        if (currentUrl) previewUrl(currentUrl);
    });
</script>
@endsection
