@extends('layouts.admin')

@section('title', 'Kelola Blogger - ' . setting('site_name', 'Andrew.Devlog'))

@section('header_title', 'Blogger Management')
@section('header_subtitle', 'Pantau artikel blog Anda yang terhubung dengan Blogger API.')

@section('admin_content')
<div class="space-y-6">
    <!-- Stats / Info -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white/5 border border-white/5 rounded-3xl p-6 backdrop-blur-md">
            <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mb-1">Status Koneksi</p>
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 rounded-full {{ $error ? 'bg-red-500' : 'bg-green-500 animate-pulse' }}"></div>
                <h3 class="text-xl font-black text-white">{{ $error ? 'Terputus' : 'Terhubung' }}</h3>
            </div>
        </div>
        <div class="bg-white/5 border border-white/5 rounded-3xl p-6 backdrop-blur-md">
            <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mb-1">Blog ID Aktif</p>
            <h3 class="text-xl font-black text-primary truncate">{{ $blogId }}</h3>
        </div>
        <div class="bg-white/5 border border-white/5 rounded-3xl p-6 backdrop-blur-md flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mb-1">Tulis Artikel</p>
                <h3 class="text-xl font-black text-white">Dashboard Blogger</h3>
            </div>
            <a href="https://www.blogger.com/blog/posts/{{ $blogId }}" target="_blank" class="w-10 h-10 bg-primary/20 text-primary rounded-xl flex items-center justify-center hover:bg-primary hover:text-white transition-all">
                <i class="fas fa-external-link-alt"></i>
            </a>
        </div>
    </div>

    @if($error)
        <div class="bg-red-500/10 border border-red-500/20 text-red-500 p-6 rounded-3xl flex items-center gap-4">
            <i class="fas fa-exclamation-circle text-2xl"></i>
            <div>
                <p class="font-bold">Error Konfigurasi</p>
                <p class="text-sm opacity-80">{{ $error }}</p>
            </div>
        </div>
    @endif

    <!-- Table -->
    <div class="bg-white/5 border border-white/5 rounded-3xl overflow-hidden backdrop-blur-md">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-white/5 border-b border-white/10 uppercase text-[10px] font-black tracking-widest text-gray-500">
                    <tr>
                        <th class="px-8 py-5">Judul Postingan</th>
                        <th class="px-8 py-5">Penulis</th>
                        <th class="px-8 py-5">Tanggal</th>
                        <th class="px-8 py-5">Label</th>
                        <th class="px-8 py-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($posts as $post)
                        <tr class="hover:bg-white/[0.02] transition-colors group">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl overflow-hidden bg-gray-800 flex-shrink-0">
                                        @php
                                            $images = $post->getImages();
                                            $image = !empty($images) ? $images[0]->getUrl() : 'https://via.placeholder.com/100x100?text=No+Img';
                                        @endphp
                                        <img src="{{ $image }}" class="w-full h-full object-cover" alt="">
                                    </div>
                                    <div class="max-w-md">
                                        <p class="text-white font-bold truncate group-hover:text-primary transition-colors">{{ $post->getTitle() }}</p>
                                        <p class="text-[10px] text-gray-500 mt-1 uppercase tracking-wider">ID: {{ $post->getId() }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-2">
                                    <i class="far fa-user-circle text-gray-600"></i>
                                    <span class="text-sm font-medium">{{ $post->getAuthor()->getDisplayName() }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-sm text-gray-400 font-mono">{{ date('Y-m-d', strtotime($post->getPublished())) }}</span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex flex-wrap gap-1">
                                    @php $labels = $post->getLabels(); @endphp
                                    @if(!empty($labels))
                                        @foreach($labels as $label)
                                            <span class="text-[9px] bg-primary/10 text-primary px-2 py-0.5 rounded-md font-black uppercase">{{ $label }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-[9px] text-gray-600">No Labels</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('blog.show', $post->getId()) }}" target="_blank" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-white/10 text-white flex items-center justify-center transition-all" title="Lihat di Web">
                                        <i class="fas fa-eye text-xs"></i>
                                    </a>
                                    <a href="https://www.blogger.com/blog/post/edit/{{ $blogId }}/{{ $post->getId() }}" target="_blank" class="w-8 h-8 rounded-lg bg-primary/10 hover:bg-primary text-primary hover:text-white flex items-center justify-center transition-all" title="Edit di Blogger">
                                        <i class="fas fa-edit text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center">
                                <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center text-2xl text-gray-600 mx-auto mb-4">
                                    <i class="fas fa-ghost"></i>
                                </div>
                                <p class="text-gray-500 font-bold uppercase tracking-widest italic">Belum ada postingan ditemukan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($nextPageToken || $prevPageToken)
        <div class="flex justify-center gap-4 mt-10">
            @if($prevPageToken)
                <a href="{{ route('admin.blogger.index', ['page' => $prevPageToken]) }}" class="px-6 py-2.5 bg-white/5 border border-white/5 text-white font-bold rounded-xl hover:bg-white/10 transition-all flex items-center gap-2 text-xs">
                    <i class="fas fa-chevron-left"></i> Sebelumnya
                </a>
            @endif
            @if($nextPageToken)
                <a href="{{ route('admin.blogger.index', ['page' => $nextPageToken]) }}" class="px-6 py-2.5 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark transition-all flex items-center gap-2 text-xs shadow-lg shadow-primary/20">
                    Berikutnya <i class="fas fa-chevron-right"></i>
                </a>
            @endif
        </div>
    @endif
</div>
@endsection
