@extends('layouts.admin')

@section('title', 'Dipercaya oleh - Admin Dashboard')
@section('header_title', 'Dipercaya oleh')
@section('header_subtitle', 'Kelola daftar perusahaan yang telah bekerja sama dengan Anda.')

@section('admin_content')
<div class="bg-white/5 backdrop-blur-xl rounded-[2.5rem] border border-white/5 overflow-hidden shadow-2xl">
    <div class="p-8 flex justify-between items-center border-b border-white/5">
        <div>
            <h3 class="text-xl font-bold text-white">Daftar Partner & Client</h3>
            <p class="text-gray-500 text-sm mt-1">Total: {{ $clients->count() }} Perusahaan</p>
        </div>
        <a href="{{ route('admin.clients.create') }}" class="px-6 py-3 bg-primary hover:bg-primary-dark text-white rounded-2xl font-bold transition-all flex items-center gap-2 shadow-lg shadow-primary/20 hover:-translate-y-1">
            <i class="fas fa-plus text-xs"></i>
            <span>Tambah Client</span>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white/5">
                    <th class="px-8 py-5 text-gray-400 font-bold text-xs uppercase tracking-widest">Logo</th>
                    <th class="px-8 py-5 text-gray-400 font-bold text-xs uppercase tracking-widest">Nama Perusahaan</th>
                    <th class="px-8 py-5 text-gray-400 font-bold text-xs uppercase tracking-widest text-center">Urutan</th>
                    <th class="px-8 py-5 text-gray-400 font-bold text-xs uppercase tracking-widest text-center">Status</th>
                    <th class="px-8 py-5 text-gray-400 font-bold text-xs uppercase tracking-widest text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($clients as $client)
                <tr class="hover:bg-white/[0.02] transition-colors group">
                    <td class="px-8 py-5">
                        <div class="w-16 h-16 bg-white rounded-xl p-2 flex items-center justify-center border border-white/10 group-hover:scale-110 transition-transform">
                            <img src="{{ $client->logo_url }}" alt="{{ $client->name }}" class="max-h-full max-w-full object-contain grayscale group-hover:grayscale-0 transition-all">
                        </div>
                    </td>
                    <td class="px-8 py-5">
                        <p class="text-white font-bold">{{ $client->name }}</p>
                        @if($client->url)
                            <a href="{{ $client->url }}" target="_blank" class="text-xs text-primary hover:underline italic">{{ $client->url }}</a>
                        @endif
                    </td>
                    <td class="px-8 py-5 text-center">
                        <span class="bg-white/5 text-gray-400 px-3 py-1 rounded-lg font-mono">{{ $client->order }}</span>
                    </td>
                    <td class="px-8 py-5 text-center">
                        <button onclick="toggleVisibility('{{ $client->id }}')" class="w-12 h-6 rounded-full relative transition-all {{ $client->is_active ? 'bg-primary' : 'bg-gray-700' }}" id="toggle-{{ $client->id }}">
                            <div class="w-4 h-4 bg-white rounded-full absolute top-1 transition-all {{ $client->is_active ? 'left-7' : 'left-1' }}"></div>
                        </button>
                    </td>
                    <td class="px-8 py-5">
                        <div class="flex justify-end items-center gap-3">
                            <a href="{{ route('admin.clients.edit', $client->id) }}" class="w-10 h-10 bg-white/5 hover:bg-primary/20 text-gray-400 hover:text-primary rounded-xl flex items-center justify-center transition-all">
                                <i class="fas fa-edit text-sm"></i>
                            </a>
                            <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus client ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-10 h-10 bg-white/5 hover:bg-red-500/20 text-gray-400 hover:text-red-500 rounded-xl flex items-center justify-center transition-all">
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
                            <div class="w-20 h-20 bg-white/5 rounded-3xl flex items-center justify-center text-gray-600">
                                <i class="fas fa-building text-3xl"></i>
                            </div>
                            <p class="text-gray-500 font-medium">Belum ada client yang ditambahkan.</p>
                            <a href="{{ route('admin.clients.create') }}" class="text-primary hover:underline font-bold">Mulai Tambahkan Sekarang</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function toggleVisibility(id) {
        fetch(`{{ url('admin/clients') }}/${id}/toggle/is_active`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const button = document.getElementById(`toggle-${id}`);
                const dot = button.querySelector('div');
                
                if (button.classList.contains('bg-primary')) {
                    button.classList.replace('bg-primary', 'bg-gray-700');
                    dot.classList.replace('left-7', 'left-1');
                } else {
                    button.classList.replace('bg-gray-700', 'bg-primary');
                    dot.classList.replace('left-1', 'left-7');
                }
            }
        });
    }
</script>
@endsection
