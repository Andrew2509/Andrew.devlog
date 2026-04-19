@php
    $categories = \App\Models\ServiceCategory::whereNull('parent_id')
                    ->with(['children' => function($q) {
                        $q->orderBy('order')->orderBy('name');
                    }])
                    ->orderBy('order')
                    ->orderBy('name')
                    ->get();
    $currentCategory = $currentCategory ?? null;
@endphp

<div class="category-sidebar">
    <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6 px-4">
        Kategori Layanan
    </div>

    <div class="space-y-3">
        @foreach($categories as $category)
            @php
                $isActive = $currentCategory && ($currentCategory->id == $category->id || $currentCategory->parent_id == $category->id);
                $hasChildren = $category->children->count() > 0;
            @endphp

            <div class="group">
                <!-- Parent Link -->
                <a href="{{ route('harga.layanan', $category->slug) }}"
                   class="flex items-center justify-between px-5 py-4 rounded-2xl transition-all duration-300 {{ $isActive ? 'bg-primary/5 text-primary border-r-4 border-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <div class="flex items-center gap-4">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ $isActive ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'bg-gray-100 text-gray-400 group-hover:bg-primary/10 group-hover:text-primary' }} transition-colors">
                            <i class="{{ $category->icon ?? 'fas fa-th-large' }} text-sm"></i>
                        </div>
                        <span class="font-bold text-sm tracking-tight">{{ $category->name }}</span>
                    </div>
                    @if($hasChildren)
                        <i class="fas fa-chevron-up text-[10px] transition-transform {{ $isActive ? '' : 'rotate-180' }}"></i>
                    @endif
                </a>

                <!-- Children List --> 
                @if($hasChildren && $isActive)
                    <div class="mt-2 ml-14 space-y-3 py-2">
                        @foreach($category->children as $child)
                            <a href="{{ route('harga.layanan', $child->slug) }}"
                               class="flex items-center gap-3 text-xs font-semibold {{ $currentCategory && $currentCategory->id == $child->id ? 'text-gray-900' : 'text-gray-400 hover:text-gray-700' }} transition-colors group/child">
                                <span class="w-1.5 h-1.5 rounded-full {{ $currentCategory && $currentCategory->id == $child->id ? 'bg-primary' : 'bg-gray-200 group-hover/child:bg-gray-400' }} transition-colors"></span>
                                {{ $child->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <!-- Additional Static Items matching the UI if needed, or just more categories -->
    @if($categories->isEmpty())
        <p class="text-gray-400 text-xs italic px-4">Belum ada kategori.</p>
    @endif
</div>

<style>
    .category-sidebar .border-r-4 {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }
</style>
