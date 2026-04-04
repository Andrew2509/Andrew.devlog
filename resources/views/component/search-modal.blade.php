<!-- Search Modal Overlay -->
<div id="search-modal" class="fixed inset-0 z-[60] hidden transition-all duration-300 backdrop-blur-sm bg-black/40">
    <div class="flex items-start justify-center pt-24 px-4 min-h-screen">
        <div class="w-full max-w-2xl bg-white rounded-3xl shadow-2xl shadow-black/30 overflow-hidden transform transition-all scale-95 opacity-0 duration-300" id="search-container">
            <!-- Header -->
            <div class="px-6 py-5 border-b border-gray-100 flex items-center gap-4">
                <i class="fas fa-search text-gray-400 text-lg"></i>
                <input 
                    type="text" 
                    id="search-input" 
                    placeholder="Apa yang ingin Anda cari? (Contoh: Website UMKM, Landing Page)" 
                    class="flex-1 bg-transparent border-none outline-none text-lg text-gray-800 placeholder-gray-400 focus:ring-0"
                    autocomplete="off"
                >
                <div class="flex items-center gap-2">
                    <kbd class="hidden sm:inline-flex h-6 select-none items-center gap-1 rounded border border-gray-100 bg-gray-50 px-2 font-mono text-[10px] font-medium text-gray-400 opacity-100">
                        ESC
                    </kbd>
                    <button onclick="closeSearch()" class="text-gray-400 hover:text-gray-600 focus:outline-none p-1">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <!-- Body -->
            <div class="max-h-[60vh] overflow-y-auto p-4 custom-scrollbar">
                <!-- Recent Queries / Suggestions -->
                <div id="search-results-placeholder">
                    <div class="p-4">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Layanan Populer</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <button onclick="fillSearch('Pembuatan Website')" class="flex items-center gap-3 p-3 rounded-2xl border border-gray-50 bg-gray-50/50 hover:bg-primary-50 hover:border-primary-100 group transition-all text-left">
                                <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all">
                                    <i class="fas fa-desktop"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-700">Website UMKM</p>
                                    <p class="text-[10px] text-gray-400">Jasa pembuatan website murah</p>
                                </div>
                            </button>
                            <button onclick="fillSearch('Landing Page')" class="flex items-center gap-3 p-3 rounded-2xl border border-gray-50 bg-gray-50/50 hover:bg-primary-50 hover:border-primary-100 group transition-all text-left">
                                <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all">
                                    <i class="fas fa-rocket"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-700">Landing Page</p>
                                    <p class="text-[10px] text-gray-400">Optimasi konversi penjualan</p>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Actual Results (hidden by default) -->
                <div id="search-results-area" class="hidden">
                    <!-- Results will be injected here via JS if needed -->
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 flex items-center justify-between text-[10px] text-gray-400 font-medium tracking-wide">
                <div class="flex items-center gap-4">
                    <span class="flex items-center gap-1.5"><kbd class="bg-white border rounded px-1 min-w-[1.2rem] text-center">↵</kbd> untuk memilih</span>
                    <span class="flex items-center gap-1.5"><kbd class="bg-white border rounded px-1 min-w-[1.2rem] text-center">↑↓</kbd> untuk navigasi</span>
                </div>
                <div class="flex items-center gap-1 opacity-60">
                    <span>Didukung oleh</span>
                    <span class="font-black text-xs text-gray-900 tracking-tighter">Andrew.Devlog Search</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const searchModal = document.getElementById('search-modal');
    const searchContainer = document.getElementById('search-container');
    const searchInput = document.getElementById('search-input');
    const resultsArea = document.getElementById('search-results-area');
    const placeholderArea = document.getElementById('search-results-placeholder');
    let searchTimeout;

    function openSearch() {
        searchModal.classList.remove('hidden');
        setTimeout(() => {
            searchContainer.classList.remove('scale-95', 'opacity-0');
            searchContainer.classList.add('scale-100', 'opacity-100');
            searchInput.focus();
        }, 10);
    }

    function closeSearch() {
        searchContainer.classList.remove('scale-100', 'opacity-100');
        searchContainer.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            searchModal.classList.add('hidden');
        }, 300);
    }

    function fillSearch(term) {
        searchInput.value = term;
        performSearch(term);
    }

    searchInput.addEventListener('input', (e) => {
        const query = e.target.value;
        
        clearTimeout(searchTimeout);
        
        if (query.length < 2) {
            resultsArea.classList.add('hidden');
            placeholderArea.classList.remove('hidden');
            return;
        }

        searchTimeout = setTimeout(() => {
            performSearch(query);
        }, 400);
    });

    async function performSearch(query) {
        resultsArea.innerHTML = `
            <div class="p-12 text-center">
                <i class="fas fa-circle-notch fa-spin text-primary text-2xl mb-3"></i>
                <p class="text-xs text-gray-400 font-medium">Mencari hasil terbaik untuk "${query}"...</p>
            </div>
        `;
        resultsArea.classList.remove('hidden');
        placeholderArea.classList.add('hidden');

        try {
            const response = await fetch(`/api/search?q=${encodeURIComponent(query)}`);
            const data = await response.json();
            renderResults(data);
        } catch (error) {
            resultsArea.innerHTML = `
                <div class="p-8 text-center text-red-500 font-medium">
                    <i class="fas fa-exclamation-triangle mb-2"></i>
                    <p class="text-sm">Terjadi kesalahan saat melakukan pencarian.</p>
                </div>
            `;
        }
    }

    function renderResults(data) {
        let html = '';
        let totalResults = 0;

        const categories = [
            { key: 'services', label: 'Layanan & Paket' },
            { key: 'portfolio', label: 'Portofolio' },
            { key: 'articles', label: 'Artikel Blog' }
        ];

        categories.forEach(cat => {
            if (data[cat.key] && data[cat.key].length > 0) {
                totalResults += data[cat.key].length;
                html += `
                    <div class="mb-8 last:mb-0">
                        <div class="flex items-center gap-3 px-4 mb-4">
                            <span class="h-[1px] flex-1 bg-gray-100"></span>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest whitespace-nowrap">${cat.label}</p>
                            <span class="h-[1px] flex-1 bg-gray-100"></span>
                        </div>
                        <div class="grid grid-cols-1 gap-2">`;
                
                data[cat.key].forEach(item => {
                    html += `
                        <a href="${item.url}" class="flex items-center gap-4 p-4 rounded-2xl hover:bg-primary/5 group transition-all border border-transparent hover:border-primary/10">
                            <div class="w-12 h-12 rounded-xl overflow-hidden bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-primary group-hover:text-white transition-all shadow-sm shrink-0">
                                ${item.image ? 
                                    `<img src="${item.image}" alt="${item.title}" class="w-full h-full object-cover">` : 
                                    `<i class="${item.icon} text-sm"></i>`
                                }
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-gray-700 group-hover:text-gray-900 transition-colors line-clamp-1">${item.title}</p>
                                <p class="text-[10px] text-gray-400 font-medium">${item.type}</p>
                            </div>
                            <i class="fas fa-arrow-right ml-auto text-[10px] text-gray-300 opacity-0 group-hover:opacity-100 transition-all -translate-x-2 group-hover:translate-x-0 group-hover:text-primary"></i>
                        </a>
                    `;
                });

                html += `</div></div>`;
            }
        });

        if (totalResults === 0) {
            html = `
                <div class="p-12 text-center">
                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                        <i class="fas fa-search text-2xl"></i>
                    </div>
                    <p class="text-gray-500 font-bold mb-1">Hasil tidak ditemukan</p>
                    <p class="text-gray-400 text-xs px-12">Maaf, kami tidak dapat menemukan apa yang Anda cari. Coba gunakan kata kunci lain.</p>
                </div>
            `;
        }

        resultsArea.innerHTML = html;
    }

    // Keyboard Shortcuts
    document.addEventListener('keydown', (e) => {
        if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
            e.preventDefault();
            openSearch();
        }
        
        if (e.key === 'Escape' && !searchModal.classList.contains('hidden')) {
            closeSearch();
        }
    });

    // Close on backdrop click
    searchModal.addEventListener('click', (e) => {
        if (e.target === searchModal) {
            closeSearch();
        }
    });
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: #f1f5f9;
        border-radius: 20px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background-color: #e2e8f0;
    }
</style>
