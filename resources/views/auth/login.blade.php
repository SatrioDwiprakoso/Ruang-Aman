<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - RUANG AMAN</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-white min-h-screen antialiased m-0 p-0 overflow-x-hidden">

    <div class="flex flex-col md:flex-row w-full min-h-screen">
        
        <div class="hidden md:flex md:w-[45%] lg:w-[40%] bg-gradient-to-br from-[#1e3a5f] via-[#0f4c5c] to-[#006d77] text-white p-10 lg:p-16 flex-col justify-between relative overflow-hidden">
            <a href="{{ route('landing') }}" class="flex items-center gap-3 z-10 hover:opacity-90 transition">
                <div class="bg-white/10 p-2 rounded-lg backdrop-blur-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="font-bold text-lg tracking-wide">RUANG AMAN</span>
            </a>

            <div class="my-auto max-w-md z-10 py-10">
                <h1 class="text-4xl lg:text-5xl font-bold leading-tight mb-4">
                    Berani Lapor,<br>Sekolah Aman<br>Tanpa Kekerasan.
                </h1>
                <p class="text-white/80 text-sm lg:text-base leading-relaxed">
                    Masuk untuk menyampaikan dan memantau pengaduanmu secara aman, rahasia, dan tuntas.
                </p>
            </div>

            <div class="space-y-4 z-10">
                <div class="flex items-center gap-3 text-sm text-white/90">
                    <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    Identitas terlindungi & bisa anonim
                </div>
                <div class="flex items-center gap-3 text-sm text-white/90">
                    <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    Penanganan transparan & terlacak
                </div>
            </div>

            <div class="absolute -bottom-10 -left-10 w-64 h-64 border-4 border-white/5 rounded-full pointer-events-none"></div>
            <div class="absolute -bottom-20 -left-20 w-96 h-96 border-[6px] border-white/5 rounded-full pointer-events-none"></div>
        </div>

        <div class="w-full md:w-[55%] lg:w-[60%] flex flex-col justify-center items-center px-6 py-12 sm:px-16 lg:px-24 bg-white relative">
            <div class="w-full max-w-md">
                
                <div class="flex bg-slate-100 p-1 rounded-xl mb-10 w-full">
                    <a href="{{ route('login') }}" class="w-1/2 text-center py-2.5 text-sm font-semibold rounded-lg bg-white text-slate-900 shadow-sm transition">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="w-1/2 text-center py-2.5 text-sm font-semibold rounded-lg text-slate-500 hover:text-slate-900 transition">
                        Daftar
                    </a>
                </div>

                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-[#0f2d4a] tracking-tight mb-2">Selamat Datang</h2>
                    <p class="text-slate-500 text-sm">Masuk ke akunmu untuk melanjutkan.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-5 w-full">
                    @csrf
                    
                    @if($errors->any())
                        <div class="p-3 bg-red-50 border border-red-200 rounded-xl mb-4">
                            <p class="text-sm text-red-700 font-medium">{{ $errors->first('login') ?: $errors->first() }}</p>
                        </div>
                    @endif

                    <div>
                        <label class="block text-sm font-semibold text-[#0f2d4a] mb-2">Username</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </span>
                            <input type="text" name="username" value="{{ old('username') }}" required autofocus
                                class="w-full pl-11 pr-4 py-3 bg-[#f8fafc] border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#00a896] placeholder-slate-400" 
                                placeholder="Masukkan username">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-[#0f2d4a] mb-2">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </span>
                            <input type="password" name="password" required
                                class="w-full pl-11 pr-11 py-3 bg-[#f8fafc] border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#00a896] placeholder-slate-400" 
                                placeholder="Masukkan password">
                            
                            <button type="button" 
                                onclick="this.previousElementSibling.type = this.previousElementSibling.type === 'password' ? 'text' : 'password'"
                                class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-slate-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-[#00a896] focus:ring-[#00a896]">
                            <span class="text-sm text-slate-600">Ingat saya</span>
                        </label>
                        
                        <a href="#" class="text-sm font-semibold text-[#00a896] hover:underline">Lupa password?</a>
                    </div>

                    <button type="submit" 
                        class="w-full bg-[#00a896] hover:bg-[#028074] text-white font-semibold py-3 px-4 rounded-xl shadow-md transition-all mt-4">
                        Masuk
                    </button>
                </form>

                <p class="text-center text-sm text-slate-500 mt-8">
                    Belum punya akun? <a href="{{ route('register') }}" class="font-bold text-[#00a896] hover:underline ml-1">Daftar di sini</a>
                </p>

            </div>
        </div>
    </div>

</body>
</html>