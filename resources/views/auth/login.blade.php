@extends('layouts.app')

@section('title', 'Admin Login - ' . setting('site_name', 'Andrew.Devlog'))

@section('content')
<section class="min-h-screen pt-32 pb-20 flex items-center justify-center bg-[#0b0f1a] relative overflow-hidden">
    <!-- Background Accents -->
    <div class="absolute top-1/4 -left-20 w-80 h-80 bg-primary/10 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-1/4 -right-20 w-80 h-80 bg-primary/10 rounded-full blur-[120px]"></div>

    <div class="max-w-md w-full px-4 relative z-10">
        <div class="text-center mb-10">
            <div class="w-16 h-16 bg-primary rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-primary/20 rotate-12">
                <i class="fas fa-bolt text-white text-3xl"></i>
            </div>
            <h1 class="text-3xl font-black text-white mb-2 tracking-tight">Admin <span class="text-primary">{{ setting('site_name', 'Andrew.Devlog') }}</span></h1>
            <p class="text-gray-400">Masuk untuk mengelola Dashboard Anda</p>
        </div>

        <div class="bg-gray-900/50 backdrop-blur-xl border border-gray-800 rounded-3xl p-8 shadow-2xl">
            @if(session('error'))
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-500 rounded-2xl text-sm font-medium flex items-center gap-3">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ url('/login') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-gray-400 text-xs font-bold uppercase tracking-wider mb-2 ml-1" for="email">Email</label>
                    <div class="relative group">
                        <input type="email" name="email" id="email" 
                            class="w-full bg-gray-800/50 border {{ $errors->has('email') ? 'border-red-500/50' : 'border-gray-800' }} text-white px-6 py-4 rounded-2xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none group-hover:border-gray-700"
                            placeholder="{{ 'admin@' . strtolower(str_replace(' ', '', setting('site_name', 'andrew.devlog'))) . '.my.id' }}" required value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <p class="mt-2 text-red-500 text-xs font-medium ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-400 text-xs font-bold uppercase tracking-wider mb-2 ml-1" for="password">Password</label>
                    <div class="relative group">
                        <input type="password" name="password" id="password" 
                            class="w-full bg-gray-800/50 border {{ $errors->has('password') ? 'border-red-500/50' : 'border-gray-800' }} text-white px-6 py-4 rounded-2xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none group-hover:border-gray-700"
                            placeholder="••••••••" required>
                    </div>
                </div>

                <div class="flex items-center justify-between px-1">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative">
                            <input type="checkbox" name="remember" class="peer sr-only">
                            <div class="w-5 h-5 bg-gray-800 border border-gray-700 rounded-md peer-checked:bg-primary peer-checked:border-primary transition-all"></div>
                            <i class="fas fa-check absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[10px] text-white opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                        </div>
                        <span class="text-sm text-gray-400 group-hover:text-gray-300 transition-colors">Ingat Saya</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-4 rounded-2xl transition-all shadow-lg shadow-primary/20 hover:shadow-primary/40 active:scale-[0.98] mt-4 flex items-center justify-center gap-3">
                    <span>Masuk ke Dashboard</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ url('/') }}" class="text-gray-500 hover:text-primary text-sm transition-colors flex items-center justify-center gap-2">
                <i class="fas fa-chevron-left text-xs"></i>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>
@endsection
