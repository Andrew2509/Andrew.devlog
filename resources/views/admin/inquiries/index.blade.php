@extends('layouts.admin')

@section('title', 'Inbox Pesan - ' . setting('site_name', 'Andrew.Devlog') . ' Admin')
@section('header_title', 'Inquiry Inbox')
@section('header_subtitle', 'Kelola semua pertanyaan dan pesanan dari calon klien.')

@section('admin_content')
@if(session('success'))
    <div class="mb-8 p-4 bg-green-500/10 border border-green-500/20 text-green-500 rounded-2xl text-sm font-medium flex items-center gap-3 animate-fade-in">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

<div class="bg-gray-900 shadow-2xl border border-white/5 rounded-[40px] overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-white/5 bg-white/2">
                    <th class="px-4 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest w-16 text-center">Status</th>
                    <th class="px-4 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest">Pengirim</th>
                    <th class="px-4 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest">Pesan Singkat</th>
                    <th class="px-4 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest">Waktu</th>
                    <th class="px-4 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($inquiries as $inquiry)
                <tr class="hover:bg-white/2 transition-colors cursor-pointer group {{ $inquiry->status == 'new' ? 'bg-primary/5' : '' }}" onclick="window.location='{{ route('admin.inquiries.show', $inquiry) }}'">
                    <td class="px-4 py-4 text-center">
                        @if($inquiry->status == 'new')
                            <div class="w-3 h-3 bg-primary rounded-full mx-auto shadow-[0_0_10px_#0ea5e9]"></div>
                        @else
                            <i class="fas fa-check-double text-gray-700 text-xs"></i>
                        @endif
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-primary font-black uppercase text-xs">
                                {{ substr($inquiry->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="text-sm {{ $inquiry->status == 'new' ? 'font-black text-white' : 'font-bold text-gray-400' }}">{{ $inquiry->name }}</h4>
                                <p class="text-[10px] text-gray-500 font-medium uppercase mt-0.5 tracking-tighter">{{ $inquiry->email ?? 'No Email' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <p class="text-sm {{ $inquiry->status == 'new' ? 'text-gray-300 font-medium' : 'text-gray-500' }} truncate max-w-[300px]">
                            {{ $inquiry->message }}
                        </p>
                    </td>
                    <td class="px-4 py-4">
                        <span class="text-[10px] font-black text-gray-600 uppercase tracking-widest">
                            {{ $inquiry->created_at->format('d M, H:i') }}
                        </span>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center justify-center gap-3">
                            <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" onclick="event.stopPropagation()" onsubmit="return confirm('Hapus pesan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-9 h-9 rounded-xl bg-gray-800 text-gray-500 flex items-center justify-center hover:bg-red-500/20 hover:text-red-500 transition-all">
                                    <i class="fas fa-trash-alt text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <div class="flex flex-col items-center gap-4">
                            <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center text-gray-700 text-2xl">
                                <i class="fas fa-envelope-open"></i>
                            </div>
                            <p class="text-gray-500 text-sm font-bold uppercase tracking-widest">Tidak ada pesan masuk</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($inquiries->hasPages())
        <div class="p-8 border-t border-white/5 bg-white/2">
            {{ $inquiries->links() }}
        </div>
    @endif
</div>
@endsection
