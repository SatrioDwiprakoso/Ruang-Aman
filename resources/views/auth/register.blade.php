@extends('layouts.app')

@section('content')
    <div class="min-h-[calc(100vh-5rem)] flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md animate-slide-up">
            <div class="text-center mb-8">
                <a href="{{ route('landing') }}" class="inline-flex items-center gap-2 mb-6">
                    <div class="w-10 h-10 bg-justice rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="font-extrabold text-midnight-700 text-2xl">LAPOR EDU!</span>
                </a>
                <h1 class="text-2xl font-extrabold text-midnight-700">Buat Akun Baru</h1>
                <p class="text-slate-500 mt-1">Daftar untuk mulai melaporkan kasus</p>
            </div>

            <div class="card p-6 md:p-8">
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf
                    @if($errors->any())
                        <div class="p-3 bg-red-50 border border-red-200 rounded-xl">
                            @foreach($errors->all() as $error)
                                <p class="text-sm text-red-700">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <div>
                        <label class="label-field">Username</label>
                        <input type="text" name="username" value="{{ old('username') }}" class="input-field"
                            placeholder="Pilih username unik" required>
                    </div>
                    <div>
                        <label class="label-field">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="input-field"
                            placeholder="email@contoh.com" required>
                    </div>
                    <div>
                        <label class="label-field">Password</label>
                        <input type="password" name="password" class="input-field"
                            placeholder="Min. 8 karakter, huruf besar/kecil & angka" required>
                    </div>
                    <div>
                        <label class="label-field">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="input-field"
                            placeholder="Ulangi password" required>
                    </div>
                    <div class="p-3 bg-amber-50 border border-amber-200 rounded-xl">
                        <p class="text-xs text-amber-700 flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                            Identitas Anda dijamin kerahasiaannya. Platform ini dilindungi dan hanya diakses oleh Tim BK
                            yang berwenang.
                        </p>
                    </div>
                    <button type="submit" class="btn-primary w-full">Daftar Akun</button>
                </form>
            </div>

            <p class="text-center text-sm text-slate-500 mt-6">
                Sudah punya akun?
                <a href="{{ route('login') }}"
                    class="font-semibold text-justice hover:text-justice-dark transition-colors">Masuk di sini</a>
            </p>
        </div>
    </div>
@endsection