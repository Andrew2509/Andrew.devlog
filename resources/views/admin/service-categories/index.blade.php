@extends('layouts.admin')

@section('title', 'Kategori Layanan - ' . setting('site_name', 'Andrew.Devlog') . ' Admin')
@section('header_title', 'Kategori Layanan')
@section('header_subtitle', 'Kelola pengelompokan jasa dan karya Anda.')

@section('admin_content')
<div class="mb-8 flex justify-between items-center">
    <div class="text-xs font-bold text-gray-500 uppercase tracking-widest">
        Total: {{ $categories->count() }} Kategori
    </div>
    <a href="{{ route('admin.service_categories.create') }}" class="bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-2xl font-bold text-sm transition-all shadow-lg shadow-primary/20 flex items-center gap-2">
        <i class="fas fa-plus text-xs"></i>
        TAMBAH KATEGORI
    </a>
</div>

@if(session('success'))
    <div class="mb-8 bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 px-6 py-4 rounded-2xl text-sm font-bold flex items-center gap-3">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($categories as $category)
        <div class="bg-gray-900 border border-white/5 rounded-[32px] p-8 hover:border-primary/30 transition-all group relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-primary/5 rounded-full blur-2xl group-hover:bg-primary/10 transition-all"></div>
            
            <div class="flex items-start justify-between mb-6 relative z-10">
                <div class="w-14 h-14 bg-white/5 rounded-2xl flex items-center justify-center text-primary text-2xl group-hover:scale-110 transition-transform">
                    <i class="{{ $category->icon ?? 'fas fa-th-large' }}"></i>
                </div>
                <div class="flex gap-2 items-center">
                    <div class="px-3 py-1 bg-primary/10 text-primary border border-primary/20 rounded-lg text-[10px] font-black uppercase tracking-widest leading-none flex items-center justify-center">
                        #{{ $category->order }}
                    </div>
                    <a href="{{ route('admin.service_categories.edit', $category) }}" class="w-10 h-10 bg-white/2 hover:bg-white/10 rounded-xl flex items-center justify-center text-gray-500 hover:text-white transition-all">
                        <i class="fas fa-edit text-xs"></i>
                    </a>
                    <form action="{{ route('admin.service_categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-10 h-10 bg-red-500/5 hover:bg-red-500/20 rounded-xl flex items-center justify-center text-red-500/50 hover:text-red-500 transition-all">
                            <i class="fas fa-trash text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="relative z-10">
                <h3 class="text-white font-black text-xl tracking-tight mb-2 uppercase">{{ $category->name }}</h3>
                <p class="text-gray-500 text-xs font-semibold tracking-widest uppercase mb-4">{{ $category->slug }}</p>
                <p class="text-gray-400 text-sm leading-relaxed line-clamp-2">
                    {{ $category->description ?? 'Tidak ada deskripsi.' }}
                </p>
            </div>
        </div>
    @empty
        <div class="col-span-full py-20 text-center bg-white/2 border border-dashed border-white/5 rounded-[40px]">
            <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-600 text-3xl">
                <i class="fas fa-layer-group"></i>
            </div>
            <h3 class="text-white font-bold text-lg mb-2">Belum Ada Kategori</h3>
            <p class="text-gray-500 text-sm max-w-xs mx-auto mb-8">Mulailah dengan menambahkan kategori layanan pertama Anda.</p>
            <a href="{{ route('admin.service_categories.create') }}" class="inline-flex items-center gap-2 text-primary font-bold hover:underline">
                <i class="fas fa-plus text-xs"></i>
                Tambah Sekarang
            </a>
        </div>
    @endforelse
</div>
@endsection
