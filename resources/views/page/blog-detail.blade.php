@extends('layouts.app')

@section('title', $post->getTitle() . ' - ' . setting('site_name', 'Andrew.Devlog'))

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
    .article-content {
        line-height: 1.6;
        color: #374151;
        font-size: 1.05rem;
    }
    .article-content h1, .article-content h2, .article-content h3 {
        font-weight: 800;
        color: #111827;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
        line-height: 1.25;
    }
    .article-content h1 { font-size: 2rem; }
    .article-content h2 { font-size: 1.5rem; }
    .article-content h3 { font-size: 1.25rem; }
    .article-content p { margin-bottom: 1rem; }
    .article-content ul, .article-content ol {
        margin-bottom: 1rem;
        padding-left: 1.25rem;
    }
    .article-content li {
        margin-bottom: 0.25rem;
    }
    .article-content ul { list-style-type: disc; }
    .article-content ol { list-style-type: decimal; }
    .article-content img {
        border-radius: 1rem;
        margin: 1rem auto;
        box-shadow: 0 10px 30px -10px rgba(0,0,0,0.1);
        max-width: 100%;
        display: block;
    }
    .article-content blockquote {
        border-left: 4px solid #0ea5e9;
        padding: 1rem 1.25rem;
        font-style: italic;
        background: #f8fafc;
        border-radius: 0 1rem 1rem 0;
        color: #4b5563;
        margin: 1.5rem 0;
        font-size: 1.05rem;
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;  
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;  
        overflow: hidden;
    }

    /* Uiverse Social Share Button Styles */
    .tooltip-container {
        background: rgb(3, 169, 244);
        background: linear-gradient(138deg, rgba(3, 169, 244, 1) 15%, rgba(63, 180, 233, 1) 65%);
        position: relative;
        cursor: pointer;
        font-size: 17px;
        padding: 0.7em 0.7em;
        border-radius: 50px;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        display: inline-flex;
        width: fit-content;
        height: fit-content;
    }
    .tooltip-container:hover {
        background: #fff;
        transition: all 0.6s;
    }
    .tooltip-container .text {
        display: flex;
        align-items: center;
        justify-content: center;
        fill: #fff;
        transition: all 0.2s;
    }
    .tooltip-container:hover .text {
        fill: rgb(3, 169, 244);
        transition: all 0.6s;
    }
    .tooltip-link {
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        opacity: 0;
        visibility: hidden;
        background: #fff;
        padding: 10px;
        border-radius: 50px;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        z-index: 100;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }
    .tooltip-link i, .tooltip-link svg {
        font-size: 18px;
    }
    /* Hover triggers for tooltips */
    .tooltip-container:hover .tooltip-link.twitter { top: 150%; opacity: 1; visibility: visible; fill: #03a9f4; }
    .tooltip-container:hover .tooltip-link.twitter:hover { background: #03a9f4; fill: #fff; }

    .tooltip-container:hover .tooltip-link.facebook { top: -120%; opacity: 1; visibility: visible; fill: #0462df; }
    .tooltip-container:hover .tooltip-link.facebook:hover { background: #0462df; fill: #fff; }

    .tooltip-container:hover .tooltip-link.whatsapp { top: 10%; left: 80%; opacity: 1; visibility: visible; fill: #1db954; transform: translate(85%, -5px); }
    .tooltip-container:hover .tooltip-link.whatsapp:hover { background: #1db954; fill: #fff; }

    .tooltip-container:hover .tooltip-link.discord { top: 10%; left: -190%; opacity: 1; visibility: visible; fill: #8c9eff; transform: translate(70%, -5px); }
    .tooltip-container:hover .tooltip-link.discord:hover { background: #8c9eff; fill: #fff; }

    /* Fix area to keep tooltips active while moving cursor */
    .tooltip-buffer {
        position: absolute;
        top: -110%;
        left: -115%;
        opacity: 0;
        visibility: hidden;
        width: 150px;
        height: 150px;
        z-index: -1;
    }
    .tooltip-container:hover .tooltip-buffer {
        opacity: 1;
        visibility: visible;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;  
        overflow: hidden;
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
<article class="pt-32 pb-24 bg-gray-50 overflow-hidden relative">
    <!-- Decorative -->
    <div class="absolute top-0 left-0 w-full h-96 bg-gradient-to-b from-primary/5 to-transparent z-0"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Back Button -->
        <a href="{{ route('blog') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-primary font-bold mb-10 transition-colors group">
            <i class="fas fa-arrow-left text-xs group-hover:-translate-x-1 transition-transform"></i> Kembali ke Blog
        </a>

        <!-- Header -->
        <header class="mb-12">
            <div class="flex items-center gap-4 mb-6">
                @if(!empty($post->getLabels()))
                    @foreach($post->getLabels() as $label)
                        <span class="px-4 py-1.5 bg-primary/10 text-primary text-xs font-bold rounded-full uppercase tracking-widest">{{ $label }}</span>
                    @endforeach
                @endif
                <span class="text-gray-400 text-sm font-medium"><i class="far fa-calendar mr-1"></i> {{ date('d M Y', strtotime($post->getPublished())) }}</span>
            </div>
            
            <h1 class="text-xl md:text-3xl font-extrabold text-gray-900 leading-tight mb-8">
                {{ $post->getTitle() }}
            </h1>
            
            <div class="flex flex-wrap items-center justify-between gap-4">
                <!-- Author Card -->
                <div class="flex items-center gap-4 p-4 glass-card rounded-2xl w-max">
                    <div class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center text-primary">
                        <i class="fas fa-user-circle text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900">{{ $post->getAuthor()->getDisplayName() }}</p>
                        <p class="text-xs text-gray-500">Author</p>
                    </div>
                </div>

                <!-- Uiverse Social Share Component -->
                <div class="tooltip-container shrink-0">
                    <span class="text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="18" cy="5" r="3"></circle>
                            <circle cx="6" cy="12" r="3"></circle>
                            <circle cx="18" cy="19" r="3"></circle>
                            <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                            <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                        </svg>
                    </span>
                    
                    <!-- Twitter -->
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->getTitle()) }}" target="_blank" class="tooltip-link twitter">
                        <svg viewBox="0 0 16 16" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334q.002-.211-.006-.422A6.7 6.7 0 0 0 16 3.542a6.7 6.7 0 0 1-1.889.518 3.3 3.3 0 0 0 1.447-1.817 6.5 6.5 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.32 9.32 0 0 1-6.767-3.429 3.29 3.29 0 0 0 1.018 4.382A3.3 3.3 0 0 1 .64 6.575v.045a3.29 3.29 0 0 0 2.632 3.218 3.2 3.2 0 0 1-.865.115 3 3 0 0 1-.614-.057 3.28 3.28 0 0 0 3.067 2.277A6.6 6.6 0 0 1 .78 13.58a6 6 0 0 1-.78-.045A9.34 9.34 0 0 0 5.026 15"></path>
                        </svg>
                    </a>
                    
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="tooltip-link facebook">
                        <svg viewBox="0 0 16 16" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"></path>
                        </svg>
                    </a>
                    
                    <!-- WhatsApp -->
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($post->getTitle() . ' ' . url()->current()) }}" target="_blank" class="tooltip-link whatsapp">
                        <svg viewBox="0 0 16 16" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"></path>
                        </svg>
                    </a>
                    
                    <!-- Link / Share -->
                    <div class="tooltip-link discord">
                        <svg viewBox="0 0 16 16" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.545 2.907a13.2 13.2 0 0 0-3.257-1.011.05.05 0 0 0-.052.025c-.141.25-.297.577-.406.833a12.2 12.2 0 0 0-3.658 0 8 8 0 0 0-.412-.833.05.05 0 0 0-.052-.025c-1.125.194-2.22.534-3.257 1.011a.04.04 0 0 0-.021.018C.356 6.024-.213 9.047.066 12.032q.003.022.021.037a13.3 13.3 0 0 0 3.995 2.02.05.05 0 0 0 .056-.019q.463-.63.818-1.329a.05.05 0 0 0-.01-.059l-.018-.011a9 9 0 0 1-1.248-.595.05.05 0 0 1-.02-.066l.015-.019q.127-.095.248-.195a.05.05 0 0 1 .051-.007c2.619 1.196 5.454 1.196 8.041 0a.05.05 0 0 1 .053.007q.121.1.248.195a.05.05 0 0 1-.004.085 8 8 0 0 1-1.249.594.05.05 0 0 0-.03.03.05.05 0 0 0 .003.041c.24.465.515.909.817 1.329a.05.05 0 0 0 .056.019 13.2 13.2 0 0 0 4.001-2.02.05.05 0 0 0 .021-.037c.334-3.451-.559-6.449-2.366-9.106a.03.03 0 0 0-.02-.019m-8.198 7.307c-.789 0-1.438-.724-1.438-1.612s.637-1.613 1.438-1.613c.807 0 1.45.73 1.438 1.613 0 .888-.637 1.612-1.438 1.612m5.316 0c-.788 0-1.438-.724-1.438-1.612s.637-1.613 1.438-1.613c.807 0 1.451.73 1.438 1.613 0 .888-.631 1.612-1.438 1.612"></path>
                        </svg>
                    </div>

                    <div class="tooltip-buffer"></div>
                </div>
            </div>
        </header>

        <!-- Featured Image -->
        @if(!empty($post->getImages()))
            <div class="mb-12 rounded-3xl overflow-hidden shadow-2xl">
                <img src="{{ $post->getImages()[0]->getUrl() }}" alt="{{ $post->getTitle() }}" class="w-full h-auto">
            </div>
        @endif

        <!-- Content -->
        <div class="article-content bg-white p-5 md:p-8 rounded-[24px] shadow-sm border border-gray-100 mb-6">
            {!! $post->getContent() !!}
        </div>

        <!-- SHARE SECTION -->
        <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4 p-6 bg-white rounded-2xl border border-gray-100 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                    <i class="fas fa-share-alt text-xs"></i>
                </div>
                <span class="text-sm font-bold text-gray-900">Bagikan Artikel</span>
            </div>
            <div class="flex gap-3">
                <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $post->getTitle() }}" target="_blank" class="w-10 h-10 bg-sky-500 hover:bg-sky-600 text-white rounded-full flex items-center justify-center transition-all shadow-sm shadow-sky-500/20">
                    <i class="fab fa-twitter text-sm"></i>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="w-10 h-10 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full flex items-center justify-center transition-all shadow-sm shadow-indigo-600/20">
                    <i class="fab fa-facebook-f text-sm"></i>
                </a>
                <a href="https://api.whatsapp.com/send?text={{ $post->getTitle() }}%20{{ url()->current() }}" target="_blank" class="w-10 h-10 bg-green-500 hover:bg-green-600 text-white rounded-full flex items-center justify-center transition-all shadow-sm shadow-green-500/20">
                    <i class="fab fa-whatsapp text-sm"></i>
                </a>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="mt-6 bg-white p-5 md:p-8 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                <i class="fas fa-comments text-primary text-sm"></i> Tulis Komentar
            </h3>
            
            <div id="blogger-comments" class="w-full">
                <iframe 
                    src="https://www.blogger.com/comment-iframe.g?blogID={{ $blogId }}&postID={{ $post->getId() }}&parent={{ urlencode(url()->current()) }}" 
                    width="100%" 
                    height="350" 
                    frameborder="0" 
                    scrolling="no" 
                    allowtransparency="true"
                    class="rounded-xl"
                ></iframe>
            </div>
        </div>

        <!-- Related Posts -->
        @if(isset($otherPosts) && count($otherPosts) > 0)
        <div class="mt-12">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                <i class="fas fa-newspaper text-primary text-sm"></i> Artikel Lainnya
            </h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($otherPosts as $otherPost)
                    <article class="flex flex-col bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 group border border-gray-100">
                        <div class="relative h-40 overflow-hidden">
                            @php
                                $otherImages = $otherPost->getImages();
                                $otherImage = !empty($otherImages) ? $otherImages[0]->getUrl() : 'https://via.placeholder.com/800x450?text=No+Image';
                            @endphp
                            <img src="{{ $otherImage }}" alt="{{ $otherPost->getTitle() }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        </div>
                        
                        <div class="p-5 flex-1 flex flex-col">
                            <h4 class="text-sm font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors line-clamp-2 leading-snug">
                                <a href="{{ route('blog.show', $otherPost->getId()) }}">
                                    {{ $otherPost->getTitle() }}
                                </a>
                            </h4>
                            <p class="text-[10px] uppercase tracking-widest font-bold text-gray-400 mt-auto flex items-center gap-1.5">
                                <i class="far fa-calendar text-primary"></i> {{ date('d M Y', strtotime($otherPost->getPublished())) }}
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</article>
@endsection
