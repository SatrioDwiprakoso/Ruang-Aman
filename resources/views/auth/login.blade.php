@extends('layouts.app')

@section('content')
    <div class="min-h-[calc(100vh-5rem)] flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md animate-slide-up">
            <div class="text-center mb-8">
                <a href="{{ route('landing') }}" class="inline-flex items-center gap-2 mb-6">
                    <!-- <div class="w-10 h-10 bg-justice rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="font-extrabold text-midnight-700 text-2xl">LAPOR EDU!</span> -->
                </a>
                <h1 class="text-2xl font-extrabold text-midnight-700">Selamat Datang Kembali</h1>
                <p class="text-slate-500 mt-1">Masuk ke akun Anda untuk melanjutkan</p>
            </div>

            <div class="card p-6 md:p-8">
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    @if($errors->any())
                        <div class="p-3 bg-red-50 border border-red-200 rounded-xl">
                            <p class="text-sm text-red-700 font-medium">{{ $errors->first('login') ?: $errors->first() }}</p>
                        </div>
                    @endif
                    <div>
                        <label class="label-field">Username</label>
                        <input type="text" name="username" value="{{ old('username') }}" class="input-field"
                            placeholder="Masukkan username" required autofocus>
                    </div>
                    <div>
                        <label class="label-field">Password</label>
                        <div class="relative">
                            <input type="password" name="password" class="input-field pr-12" placeholder="Masukkan password"
                                required>
                            <button type="button"
                                onclick="this.previousElementSibling.type = this.previousElementSibling.type === 'password' ? 'text' : 'password'"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember"
                                class="w-4 h-4 rounded border-slate-300 text-justice focus:ring-justice">
                            <span class="text-sm text-slate-600">Ingat saya</span>
                        </label>
                    </div>
                    <button type="submit" class="btn-primary w-full">Masuk</button>
                </form>
            </div>

            <p class="text-center text-sm text-slate-500 mt-6">
                Belum punya akun?
                <a href="{{ route('register') }}"
                    class="font-semibold text-justice hover:text-justice-dark transition-colors">Daftar sekarang</a>
            </p>
        </div>
    </div>
@endsection