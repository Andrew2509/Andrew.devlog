@extends('layouts.admin')

@section('title', 'Tambah Kategori - ' . setting('site_name', 'Andrew.Devlog') . ' Admin')
@section('header_title', 'Tambah Kategori')
@section('header_subtitle', 'Buat kategori baru untuk layanan Anda.')

@section('admin_content')
<div class="max-w-4xl">
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('admin.service_categories.index') }}" class="w-12 h-12 bg-white/5 hover:bg-white/10 rounded-2xl flex items-center justify-center text-gray-500 hover:text-white transition-all border border-white/5 shadow-xl">
            <i class="fas fa-chevron-left text-xs"></i>
        </a>
        <div class="text-xs font-bold text-gray-500 uppercase tracking-widest px-4 py-2 bg-white/5 rounded-xl border border-white/5">
            Form Baru
        </div>
    </div>

    <form action="{{ route('admin.service_categories.store') }}" method="POST" class="bg-gray-900 border border-white/5 rounded-[40px] p-10 relative overflow-hidden shadow-2xl">
        <div class="absolute -right-20 -top-20 w-80 h-80 bg-primary/5 rounded-full blur-3xl"></div>
        <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-primary/5 rounded-full blur-3xl"></div>
        
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
            <!-- Parent Category -->
            <div class="space-y-3">
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest flex items-center gap-2">
                    <i class="fas fa-sitemap text-primary"></i>
                    Induk Kategori (Opsional)
                </label>
                <select name="parent_id" class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-semibold appearance-none">
                    <option value="">-- Pilih Induk Kategori --</option>
                    @foreach($parentCategories as $parent)
                        <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                            {{ $parent->name }}
                        </option>
                    @endforeach
                </select>
                @error('parent_id') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-tight">{{ $message }}</p> @enderror
            </div>

            <!-- Name -->
            <div class="space-y-3">
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest flex items-center gap-2">
                    <i class="fas fa-heading text-primary"></i>
                    Nama Kategori
                </label>
                <input type="text" name="name" placeholder="Misal: Web Development" 
                    class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-semibold"
                    value="{{ old('name') }}" required>
                @error('name') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-tight">{{ $message }}</p> @enderror
            </div>

            <!-- Icon -->
            <div class="space-y-3">
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest flex items-center gap-2">
                    <i class="fas fa-icons text-primary"></i>
                    Icon (FA Class)
                </label>
                <input type="text" name="icon" placeholder="fas fa-laptop" 
                    class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-semibold"
                    value="{{ old('icon', 'fas fa-th-large') }}">
                <p class="text-[10px] text-gray-500 font-medium">Contoh: fas fa-code, fas fa-palette, fas fa-mobile-alt</p>
                @error('icon') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-tight">{{ $message }}</p> @enderror
            </div>

            <!-- Position -->
            <div class="space-y-3">
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest flex items-center gap-2">
                    <i class="fas fa-sort-numeric-down text-primary"></i>
                    Urutan Tampilan
                </label>
                <input type="number" name="order" placeholder="0" 
                    class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-semibold"
                    value="{{ old('order', 0) }}" min="0">
                <p class="text-[10px] text-gray-500 font-medium">Angka kecil akan tampil lebih awal (0, 1, 2, ...)</p>
                @error('order') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-tight">{{ $message }}</p> @enderror
            </div>

            <!-- Image URL -->
            <div class="space-y-3 md:col-span-2">
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest flex items-center gap-2">
                    <i class="fas fa-image text-primary"></i>
                    Link Gambar Kategori
                </label>
                <div class="flex gap-4 items-start">
                    <div class="flex-1">
                        <input type="url" name="image" id="category_image_input" placeholder="https://example.com/image.jpg" 
                            class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-semibold"
                            value="{{ old('image') }}">
                        <p class="text-[10px] text-gray-500 font-medium mt-2">Masukkan link gambar (Unsplash, Pinterest, etc). Gambar ini akan muncul di halaman detail layanan.</p>
                        @error('image') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-tight">{{ $message }}</p> @enderror
                    </div>
                    <div id="image_preview_container" class="w-32 h-20 rounded-xl bg-white/5 border border-white/5 overflow-hidden flex items-center justify-center shrink-0">
                        <i class="fas fa-image text-white/20 text-xl" id="placeholder_icon"></i>
                        <img id="image_preview" src="" alt="Preview" class="w-full h-full object-cover hidden">
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="space-y-3 md:col-span-2">
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest flex items-center gap-2">
                    <i class="fas fa-align-left text-primary"></i>
                    Deskripsi Singkat
                </label>
                <textarea name="description" rows="4" placeholder="Jelaskan secara singkat tentang kategori ini..." 
                    class="w-full bg-white text-gray-900 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-primary transition-all font-medium resize-none">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-tight">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mt-12 flex justify-end relative z-10">
            <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-10 py-4 rounded-2xl font-black text-sm transition-all shadow-xl shadow-primary/25 flex items-center gap-3 uppercase tracking-widest">
                <span>Simpan Kategori</span>
                <i class="fas fa-save text-xs opacity-50"></i>
            </button>
        </div>
    </form>
</div>

@section('scripts')
<script>
    const imageInput = document.getElementById('category_image_input');
    const imagePreview = document.getElementById('image_preview');
    const previewContainer = document.getElementById('image_preview_container');
    const placeholderIcon = document.getElementById('placeholder_icon');

    function updatePreview() {
        const url = imageInput.value;
        if (url) {
            imagePreview.src = url;
            imagePreview.classList.remove('hidden');
            placeholderIcon.classList.add('hidden');
        } else {
            imagePreview.classList.add('hidden');
            placeholderIcon.classList.remove('hidden');
        }
    }

    imageInput.addEventListener('input', updatePreview);
    // Initial preview if data exists
    updatePreview();
</script>
@endsection
@endsection
