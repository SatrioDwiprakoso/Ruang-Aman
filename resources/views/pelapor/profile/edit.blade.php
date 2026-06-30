@extends('layouts.app')

@section('title', 'Profil Saya - LAPOR EDU!')

@section('content')
    <div class="max-w-lg mx-auto px-4 py-8 md:py-12">
        <div class="mb-8 animate-slide-up">
            <h1 class="text-2xl md:text-3xl font-extrabold text-midnight-700">Profil Saya</h1>
            <p class="text-slate-500 mt-1">Kelola informasi akun Anda</p>
        </div>

        <!-- Avatar -->
        <div class="flex items-center gap-4 mb-8 card p-5 animate-slide-up">
            <div class="w-16 h-16 bg-safe/20 rounded-2xl flex items-center justify-center">
                <span
                    class="text-2xl font-black text-safe-dark">{{ strtoupper(substr(auth()->user()->username, 0, 2)) }}</span>
            </div>
            <div>
                <p class="font-bold text-midnight-700 text-lg">{{ auth()->user()->username }}</p>
                <p class="text-sm text-slate-500">{{ auth()->user()->email }}</p>
                <span class="badge bg-justice/10 text-justice mt-1">{{ auth()->user()->role }}</span>
            </div>
        </div>

        <!-- Edit Email -->
        <div class="card p-6 mb-6 animate-slide-up">
            <h2 class="font-bold text-midnight-700 mb-4">Ubah Email</h2>
            <form method="POST" action="{{ route('pelapor.profile.update') }}" class="space-y-4">
                @csrf @method('PUT')
                <div>
                    <label class="label-field">Email</label>
                    <input type="email" name="email" value="{{ auth()->user()->email }}" class="input-field" required>
                </div>
                <button type="submit" class="btn-primary">Simpan Email</button>
            </form>
        </div>

        <!-- Edit Password -->
        <div class="card p-6 animate-slide-up">
            <h2 class="font-bold text-midnight-700 mb-4">Ubah Password</h2>
            <form method="POST" action="{{ route('pelapor.profile.password') }}" class="space-y-4">
                @csrf @method('PUT')
                <div>
                    <label class="label-field">Password Lama</label>
                    <input type="password" name="current_password" class="input-field" required>
                </div>
                <div>
                    <label class="label-field">Password Baru</label>
                    <input type="password" name="password" class="input-field"
                        placeholder="Min. 8 karakter, huruf besar/kecil & angka" required>
                </div>
                <div>
                    <label class="label-field">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="input-field" required>
                </div>
                <button type="submit" class="btn-secondary">Ubah Password</button>
            </form>
        </div>
    </div>
@endsection