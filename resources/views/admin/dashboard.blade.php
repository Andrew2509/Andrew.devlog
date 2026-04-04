@extends('layouts.admin')

@section('title', 'Overview Dashboard - ' . setting('site_name', 'Andrew.Devlog') . ' Admin')
@section('header_title', 'Dashboard Overview')
@section('header_subtitle', 'Selamat datang kembali! Berikut ringkasan performa website Anda.')

@section('admin_content')
<!-- Stats Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-10">
    <!-- Stat Card 1 -->
    <div class="bg-gray-900 shadow-2xl border border-white/5 rounded-[32px] p-6 relative overflow-hidden group hover:border-primary/20 transition-all">
        <div class="absolute -top-10 -right-10 w-24 h-24 bg-primary/10 rounded-full blur-2xl group-hover:scale-150 transition-transform"></div>
        <div class="relative z-10 flex items-center justify-between mb-4">
            <div class="w-10 h-10 bg-primary/20 rounded-xl flex items-center justify-center text-primary">
                <i class="fas fa-folder-open text-base"></i>
            </div>
        </div>
        <div class="relative z-10">
            <h3 class="text-2xl font-black text-white tracking-tight">{{ $stats['total_portfolio'] }}</h3>
            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-1">Total Project</p>
        </div>
    </div>

    <!-- Stat Card 2 (Inquiries) -->
    <div class="bg-gray-900 shadow-2xl border border-white/5 rounded-[32px] p-6 relative overflow-hidden group hover:border-green-500/20 transition-all">
        <div class="absolute -top-10 -right-10 w-24 h-24 bg-green-500/10 rounded-full blur-2xl group-hover:scale-150 transition-transform"></div>
        <div class="relative z-10 flex items-center justify-between mb-4">
            <div class="w-10 h-10 bg-green-500/20 rounded-xl flex items-center justify-center text-green-500">
                <i class="fas fa-envelope text-base"></i>
            </div>
            @if($stats['new_inquiries_count'] > 0)
                <span class="bg-primary text-[8px] font-black px-2 py-0.5 rounded-full text-white animate-pulse">NEW ({{ $stats['new_inquiries_count'] }})</span>
            @endif
        </div>
        <div class="relative z-10">
            <h3 class="text-2xl font-black text-white tracking-tight">{{ $stats['total_inquiries'] }}</h3>
            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-1">Total Inbox</p>
        </div>
    </div>

    <!-- Stat Card 3 (Categories) -->
    <div class="bg-gray-900 shadow-2xl border border-white/5 rounded-[32px] p-6 relative overflow-hidden group hover:border-yellow-500/20 transition-all">
        <div class="absolute -top-10 -right-10 w-24 h-24 bg-yellow-500/10 rounded-full blur-2xl group-hover:scale-150 transition-transform"></div>
        <div class="relative z-10 flex items-center justify-between mb-4">
            <div class="w-10 h-10 bg-yellow-500/20 rounded-xl flex items-center justify-center text-yellow-500">
                <i class="fas fa-layer-group text-base"></i>
            </div>
        </div>
        <div class="relative z-10">
            <h3 class="text-2xl font-black text-white tracking-tight">{{ $stats['total_categories'] }}</h3>
            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-1">Layanan</p>
        </div>
    </div>

    <!-- Stat Card 4 (Clients) -->
    <div class="bg-gray-900 shadow-2xl border border-white/5 rounded-[32px] p-6 relative overflow-hidden group hover:border-purple-500/20 transition-all">
        <div class="absolute -top-10 -right-10 w-24 h-24 bg-purple-500/10 rounded-full blur-2xl group-hover:scale-150 transition-transform"></div>
        <div class="relative z-10 flex items-center justify-between mb-4">
            <div class="w-10 h-10 bg-purple-500/20 rounded-xl flex items-center justify-center text-purple-500">
                <i class="fas fa-award text-base"></i>
            </div>
        </div>
        <div class="relative z-10">
            <h3 class="text-2xl font-black text-white tracking-tight">{{ $stats['total_clients'] }}</h3>
            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-1">Partners</p>
        </div>
    </div>

    <!-- Stat Card 5 (Pricing) -->
    <div class="bg-gray-900 shadow-2xl border border-white/5 rounded-[32px] p-6 relative overflow-hidden group hover:border-primary/20 transition-all">
        <div class="absolute -top-10 -right-10 w-24 h-24 bg-primary/10 rounded-full blur-2xl group-hover:scale-150 transition-transform"></div>
        <div class="relative z-10 flex items-center justify-between mb-4">
            <div class="w-10 h-10 bg-primary/20 rounded-xl flex items-center justify-center text-primary">
                <i class="fas fa-tags text-base"></i>
            </div>
        </div>
        <div class="relative z-10">
            <h3 class="text-2xl font-black text-white tracking-tight">{{ $stats['total_prices'] }}</h3>
            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-1">Price Plans</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
    <!-- Latest Portfolio (2/3 width) -->
    <div class="lg:col-span-2 bg-gray-900 shadow-2xl border border-white/5 rounded-[40px] p-8 overflow-hidden group">
        <div class="flex items-center justify-between mb-8">
            <h3 class="text-xl font-black text-white tracking-tight uppercase">Portofolio <span class="text-primary italic">Terbaru</span></h3>
            <a href="{{ route('admin.portfolio.index') }}" class="px-4 py-2 bg-white/5 hover:bg-white/10 text-white rounded-full border border-white/5 text-[10px] font-black uppercase tracking-widest transition-all">Lihat Semua</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-white/5 opacity-50">
                        <th class="pb-4 text-[9px] font-black uppercase tracking-[0.2em] text-gray-500">Project</th>
                        <th class="pb-4 text-[9px] font-black uppercase tracking-[0.2em] text-gray-500">Category</th>
                        <th class="pb-4 text-right text-[9px] font-black uppercase tracking-[0.2em] text-gray-500">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($stats['latest_portfolios'] as $portfolio)
                    <tr class="group/item hover:bg-white/2 transition-colors">
                        <td class="py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl overflow-hidden bg-white/5 flex-shrink-0 animate-pulse">
                                    <img src="{{ $portfolio->thumbnail_url }}" alt="" class="w-full h-full object-cover group-hover/item:scale-110 transition-transform duration-500" onload="this.parentElement.classList.remove('animate-pulse')">
                                </div>
                                <div class="overflow-hidden">
                                    <p class="text-sm font-bold text-white truncate">{{ $portfolio->title }}</p>
                                    <p class="text-[10px] text-gray-500 font-medium uppercase mt-0.5">{{ $portfolio->client_name ?? 'Personal Project' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4">
                            <span class="px-3 py-1 bg-primary/10 text-primary text-[9px] font-black uppercase tracking-widest rounded-full border border-primary/20">
                                {{ $portfolio->category->name ?? 'Uncategorized' }}
                            </span>
                        </td>
                        <td class="py-4 text-right">
                            <a href="{{ route('admin.portfolio.edit', $portfolio) }}" class="w-8 h-8 rounded-lg bg-white/5 border border-white/5 inline-flex items-center justify-center text-gray-500 hover:text-white hover:bg-primary transition-all">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-10 text-center text-gray-600 font-bold uppercase tracking-widest text-xs">Belum ada portofolio</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Inquiries (1/3 width) -->
    <div class="bg-gray-900 shadow-2xl border border-white/5 rounded-[40px] p-8 flex flex-col">
        <div class="flex items-center justify-between mb-8">
            <h3 class="text-xl font-black text-white tracking-tight uppercase">Inbox <span class="text-primary italic">Masuk</span></h3>
            <a href="{{ route('admin.inquiries.index') }}" class="text-[9px] font-black text-primary uppercase tracking-[0.2em] border-b border-primary/20 hover:border-primary transition-all">History</a>
        </div>

        <div class="space-y-4 flex-1">
            @forelse($stats['latest_inquiries'] as $inquiry)
                <div onclick="window.location='{{ route('admin.inquiries.show', $inquiry->id) }}'" class="p-5 bg-white/2 rounded-[28px] border border-white/5 flex items-center gap-4 hover:bg-white/5 transition-all cursor-pointer group relative overflow-hidden">
                    @if($inquiry->status == 'new')
                        <div class="absolute top-0 right-0 w-16 h-16 bg-primary/10 rotate-45 translate-x-10 -translate-y-10 group-hover:scale-150 transition-transform"></div>
                    @endif
                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-gray-800 to-gray-700 flex items-center justify-center text-white text-sm font-black group-hover:scale-105 transition-transform shadow-lg">
                        {{ substr($inquiry->name, 0, 1) }}
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <h4 class="text-xs font-black text-white truncate group-hover:text-primary transition-colors">{{ $inquiry->name }}</h4>
                        <p class="text-[9px] text-gray-500 font-bold uppercase mt-1 tracking-tighter">{{ $inquiry->created_at->diffForHumans() }}</p>
                    </div>
                    @if($inquiry->status == 'new')
                        <div class="w-1.5 h-1.5 bg-primary rounded-full shadow-[0_0_8px_#0ea5e9]"></div>
                    @endif
                </div>
            @empty
                <div class="py-10 text-center text-gray-700 font-bold uppercase tracking-widest text-[9px] border-2 border-dashed border-white/5 rounded-3xl">
                    Inbox Kosong
                </div>
            @endforelse
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Quick Actions -->
    <div class="bg-gray-800/50 backdrop-blur-xl shadow-2xl border border-white/5 rounded-[40px] p-8">
        <h3 class="text-lg font-black text-white tracking-tight uppercase mb-8">Akses <span class="text-primary italic">Cepat</span></h3>
        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('admin.portfolio.create') }}" class="p-6 bg-white/2 border border-white/5 rounded-3xl hover:bg-primary/10 hover:border-primary/20 transition-all group">
                <i class="fas fa-plus-circle text-gray-500 group-hover:text-primary mb-4 text-xl transition-colors"></i>
                <p class="text-xs font-black text-white uppercase tracking-widest">Tambah Project</p>
            </a>
            <a href="{{ route('admin.pricing.create') }}" class="p-6 bg-white/2 border border-white/5 rounded-3xl hover:bg-[#eab308]/10 hover:border-[#eab308]/20 transition-all group">
                <i class="fas fa-tag text-gray-500 group-hover:text-[#eab308] mb-4 text-xl transition-colors"></i>
                <p class="text-xs font-black text-white uppercase tracking-widest">Tambah Harga</p>
            </a>
            <a href="{{ route('admin.settings.index') }}" class="p-6 bg-white/2 border border-white/5 rounded-3xl hover:bg-white/10 transition-all group">
                <i class="fas fa-tools text-gray-500 group-hover:text-white mb-4 text-xl transition-colors"></i>
                <p class="text-xs font-black text-white uppercase tracking-widest">Pengaturan</p>
            </a>
            <a href="{{ url('/') }}" target="_blank" class="p-6 bg-white/2 border border-white/5 rounded-3xl hover:bg-white/10 transition-all group">
                <i class="fas fa-external-link-alt text-gray-500 group-hover:text-white mb-4 text-xl transition-colors"></i>
                <p class="text-xs font-black text-white uppercase tracking-widest">Live Preview</p>
            </a>
        </div>
    </div>

    <!-- Health Status -->
    <div class="bg-gray-900 shadow-2xl border border-white/5 rounded-[40px] p-8 flex flex-col">
        <h3 class="text-lg font-black text-white tracking-tight uppercase mb-8">Status <span class="text-green-500 italic">Kesehatan</span></h3>
        
        <div class="space-y-4 flex-1">
            <div class="p-5 bg-white/2 rounded-3xl border border-white/5">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-green-500/10 flex items-center justify-center text-green-500 text-xs">
                            <i class="fas fa-database"></i>
                        </div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Database Server</p>
                    </div>
                    <span class="text-[9px] font-black text-green-500 uppercase flex items-center gap-2">
                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse shadow-[0_0_8px_#22c55e]"></span>
                        Connected
                    </span>
                </div>
            </div>

            <div class="p-5 bg-white/2 rounded-3xl border border-white/5">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-primary/10 flex items-center justify-center text-primary text-xs">
                            <i class="fas fa-cloud"></i>
                        </div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Orbit WA API</p>
                    </div>
                    <span class="text-[9px] font-black text-primary uppercase flex items-center gap-2">
                        <span class="w-1.5 h-1.5 bg-primary rounded-full animate-pulse shadow-[0_0_8px_#0ea5e9]"></span>
                        Standby
                    </span>
                </div>
            </div>

            <div class="p-6 bg-white/2 rounded-[32px] border border-white/5 mt-auto">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest leading-none">Security Level</p>
                    <span class="text-[10px] text-white font-black uppercase">ULTRA</span>
                </div>
                <div class="w-full bg-white/5 h-2 rounded-full overflow-hidden p-0.5 border border-white/5">
                    <div class="w-full h-full bg-gradient-to-r from-primary via-primary-light to-white rounded-full shadow-[0_0_10px_#0ea5e9]"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
