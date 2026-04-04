@extends('layouts.app')

@section('title', 'Blog - ' . setting('site_name', 'Andrew.Devlog'))

@section('head')
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: {
                        DEFAULT: '#0ea5e9',
                        light: '#38bdf8',
                        dark: '#0369a1',
                        50: '#f0f9ff',
                        100: '#e0effe',
                    }
                }
            }
        }
    }
</script>
<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;  
        overflow: hidden;
    }
</style>
@endsection

@section('content')
<section class="relative pt-32 pb-24 overflow-hidden bg-gray-50">
    <!-- Decorative Blobs -->
    <div class="absolute top-0 left-0 w-96 h-96 bg-primary/10 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-200/20 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6 tracking-tight">
                Wawasan & <span class="text-primary italic">Berita Terbaru</span>
            </h1>
            <p class="text-lg text-gray-600 leading-relaxed">
                Temukan tips, trik, dan berita terbaru seputar teknologi web, SEO, dan strategi bisnis digital untuk membantu bisnis Anda berkembang.
            </p>
        </div>

        @if(isset($error))
            <div class="max-w-2xl mx-auto p-8 glass-card rounded-3xl text-center border-red-100 mb-12">
                <div class="w-16 h-16 bg-red-100 text-red-500 rounded-full flex items-center justify-center text-2xl mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Konfigurasi Dibutuhkan</h3>
                <p class="text-gray-600 mb-6">{{ $error }}</p>
                <div class="flex flex-col gap-3 items-center">
                    <code class="bg-gray-100 px-4 py-2 rounded-lg text-sm text-gray-700">BLOGGER_API_KEY=...</code>
                    <code class="bg-gray-100 px-4 py-2 rounded-lg text-sm text-gray-700">BLOGGER_BLOG_ID=...</code>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($posts as $post)
                    <article class="flex flex-col bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 group border border-gray-100 hover:-translate-y-2">
                        <div class="relative h-56 overflow-hidden">
                            @php
                                $images = $post->getImages();
                                $image = !empty($images) ? $images[0]->getUrl() : 'https://via.placeholder.com/800x450?text=No+Image';
                                $labels = $post->getLabels();
                            @endphp
                            <img src="{{ $image }}" alt="{{ $post->getTitle() }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute top-4 left-4">
                                <span class="px-4 py-1.5 bg-primary/90 text-white text-xs font-bold rounded-full backdrop-blur-md uppercase tracking-widest">
                                    {{ !empty($labels) ? $labels[0] : 'Article' }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-8 flex-1 flex flex-col">
                            <div class="flex items-center gap-3 text-xs text-gray-400 mb-4 font-medium">
                                <span class="flex items-center gap-1"><i class="far fa-calendar"></i> {{ date('d M Y', strtotime($post->getPublished())) }}</span>
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <span class="flex items-center gap-1"><i class="far fa-user"></i> {{ $post->getAuthor()->getDisplayName() }}</span>
                            </div>
                            
                            <h2 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-primary transition-colors leading-tight">
                                <a href="{{ route('blog.show', $post->getId()) }}">
                                    {{ $post->getTitle() }}
                                </a>
                            </h2>
                            
                            <div class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-3">
                                {!! strip_tags($post->getContent()) !!}
                            </div>
                            
                            <div class="mt-auto pt-6 border-t border-gray-50">
                                <a href="{{ route('blog.show', $post->getId()) }}" class="inline-flex items-center gap-2 text-primary font-bold text-sm hover:gap-3 transition-all group/btn">
                                    Baca Selengkapnya 
                                    <i class="fas fa-arrow-right text-xs group-hover/btn:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full py-24 text-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center text-3xl text-gray-300 mx-auto mb-6">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <p class="text-gray-500 font-bold uppercase tracking-widest italic">Belum ada artikel yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($nextPageToken || $prevPageToken)
                <div class="mt-16 flex justify-center gap-4">
                    @if($prevPageToken)
                        <a href="{{ route('blog', ['page' => $prevPageToken]) }}" class="px-8 py-3 bg-white border border-gray-200 text-gray-700 font-bold rounded-full hover:bg-gray-50 transition-all flex items-center gap-2 shadow-sm">
                            <i class="fas fa-chevron-left text-xs"></i> Sebelumnya
                        </a>
                    @endif
                    
                    @if($nextPageToken)
                        <a href="{{ route('blog', ['page' => $nextPageToken]) }}" class="px-8 py-3 bg-primary text-white font-bold rounded-full hover:bg-primary-dark transition-all flex items-center gap-2 shadow-lg shadow-primary/20">
                            Berikutnya <i class="fas fa-chevron-right text-xs"></i>
                        </a>
                    @endif
                </div>
            @endif
        @endif
    </div>
</section>
@endsection
