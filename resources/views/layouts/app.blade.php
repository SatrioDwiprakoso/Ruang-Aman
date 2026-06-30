<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'LAPOR EDU! - Platform Pengaduan Sekolah')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50" x-data>

    <!-- Top Navigation (Desktop) -->
    <nav class="hidden md:block fixed top-0 left-0 right-0 z-40 bg-white/80 backdrop-blur-xl border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
            <a href="{{ route('landing') }}" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-justice rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="font-extrabold text-midnight-700 text-lg">LAPOR EDU!</span>
            </a>
            <div class="flex items-center gap-1">
                <a href="{{ route('landing') }}"
                    class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-midnight-700 rounded-lg hover:bg-slate-50 transition-colors">Beranda</a>
                @guest
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-midnight-700 rounded-lg hover:bg-slate-50 transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-primary text-sm !py-2 !px-5">Daftar</a>
                @endguest
                @auth
                    <a href="{{ route('pelapor.report.create') }}" class="btn-primary text-sm !py-2 !px-5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Buat Laporan
                    </a>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-slate-50 transition-colors">
                            <div class="w-8 h-8 bg-safe/20 rounded-full flex items-center justify-center">
                                <span
                                    class="text-sm font-bold text-safe-dark">{{ strtoupper(substr(auth()->user()->username, 0, 1)) }}</span>
                            </div>
                            <span class="text-sm font-medium text-slate-700">{{ auth()->user()->username }}</span>
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        @php $unreadCount = auth()->user()->unreadNotifications()->count(); @endphp
                        @if($unreadCount > 0)
                            <span
                                class="absolute -top-0.5 -right-0.5 w-4 h-4 bg-red-500 rounded-full text-[10px] text-white flex items-center justify-center font-bold">{{ $unreadCount }}</span>
                        @endif
                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50">
                            <a href="{{ route('pelapor.report.index') }}"
                                class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50 hover:text-midnight-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Riwayat Pengaduan
                            </a>
                            <a href="{{ route('pelapor.notification.index') }}"
                                class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50 hover:text-midnight-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                Notifikasi
                                @if($unreadCount > 0)
                                    <span
                                        class="ml-auto bg-red-100 text-red-600 text-xs font-bold px-2 py-0.5 rounded-full">{{ $unreadCount }}</span>
                                @endif
                            </a>
                            <a href="{{ route('pelapor.profile.edit') }}"
                                class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50 hover:text-midnight-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Profil Saya
                            </a>
                            <hr class="my-2 border-slate-100">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-500 hover:bg-red-50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Bottom Navigation (Mobile) -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/90 backdrop-blur-xl border-t border-slate-100">
        <div class="flex items-center justify-around h-16 px-2">
            <a href="{{ route('landing') }}"
                class="flex flex-col items-center gap-0.5 py-1 px-3 rounded-lg {{ request()->routeIs('landing') ? 'text-justice' : 'text-slate-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1h-2z" />
                </svg>
                <span class="text-[10px] font-semibold">Beranda</span>
            </a>
            @auth
                <a href="{{ route('pelapor.report.create') }}"
                    class="flex flex-col items-center gap-0.5 py-1 px-3 rounded-lg {{ request()->routeIs('pelapor.report.create') ? 'text-justice' : 'text-slate-400' }}">
                    <div
                        class="w-10 h-10 -mt-5 bg-justice rounded-full flex items-center justify-center shadow-lg shadow-justice/30">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <span class="text-[10px] font-semibold">Lapor</span>
                </a>
                <a href="{{ route('pelapor.report.index') }}"
                    class="flex flex-col items-center gap-0.5 py-1 px-3 rounded-lg relative {{ request()->routeIs('pelapor.report.index') ? 'text-justice' : 'text-slate-400' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="text-[10px] font-semibold">Riwayat</span>
                    @php $mobUnread = auth()->user()->unreadNotifications()->count(); @endphp
                    @if($mobUnread > 0)
                        <span
                            class="absolute -top-0.5 right-1 w-4 h-4 bg-red-500 rounded-full text-[9px] text-white flex items-center justify-center font-bold">{{ $mobUnread }}</span>
                    @endif
                </a>
                <a href="{{ route('pelapor.profile.edit') }}"
                    class="flex flex-col items-center gap-0.5 py-1 px-3 rounded-lg {{ request()->routeIs('pelapor.profile.*') ? 'text-justice' : 'text-slate-400' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="text-[10px] font-semibold">Profil</span>
                </a>
            @endauth
            @guest
                <a href="{{ route('login') }}"
                    class="flex flex-col items-center gap-0.5 py-1 px-3 rounded-lg text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    <span class="text-[10px] font-semibold">Masuk</span>
                </a>
            @endguest
        </div>
    </nav>

    <!-- Toast Notification -->
    <div x-data="toast()" x-show="show"
        x-init="@if(session('success')) display('{{ session('success') }}', 'success') @endif @if(session('error')) display('{{ session('error') }}', 'error') @endif"
        class="fixed top-20 right-4 z-[60] max-w-sm" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-x-0"
        x-transition:leave-end="opacity-0 translate-x-8">
        <div class="flex items-start gap-3 p-4 rounded-xl shadow-2xl border"
            :class="type === 'success' ? 'bg-emerald-50 border-emerald-200' : 'bg-red-50 border-red-200'">
            <div class="flex-shrink-0 mt-0.5" :class="type === 'success' ? 'text-emerald-500' : 'text-red-500'">
                <svg x-show="type === 'success'" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <svg x-show="type === 'error'" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <p class="text-sm font-medium flex-1" :class="type === 'success' ? 'text-emerald-800' : 'text-red-800'"
                x-html="message"></p>
            <button @click="show = false" class="flex-shrink-0"
                :class="type === 'success' ? 'text-emerald-400 hover:text-emerald-600' : 'text-red-400 hover:text-red-600'">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Main Content -->
    <main class="@auth md:pt-16 @endauth pb-20 md:pb-0">
        @yield('content')
    </main>

    <!-- PANIC BUTTON -->
    @auth
        @if(auth()->user()->isPelapor())
            <button onclick="window.location.href='https://www.google.com'" class="fixed z-50 flex items-center gap-2 px-4 py-3 bg-red-500 hover:bg-red-600 text-white font-bold rounded-full shadow-2xl shadow-red-500/40 transition-all duration-200 active:scale-90
                               bottom-24 md:bottom-6 right-4 md:right-6 animate-pulse-slow"
                title="Tombol Darurat - Alihkan halaman dengan cepat">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-2.694-.833-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
                <span class="text-sm hidden sm:inline">PANIC</span>
            </button>
        @endif
    @endauth

</body>

</html>