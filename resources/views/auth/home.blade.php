@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section
        class="relative overflow-hidden bg-gradient-to-br from-midnight-700 via-midnight-800 to-emerald-900 pt-12 md:pt-16 pb-20 md:pb-32">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-96 h-96 bg-justice/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-safe/10 rounded-full blur-3xl"></div>
            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-justice/5 rounded-full blur-3xl">
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 md:px-6">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-center lg:text-left animate-slide-up">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full mb-6">
                        <span class="w-2 h-2 bg-justice rounded-full animate-pulse"></span>
                        <span class="text-xs font-semibold text-emerald-200 tracking-wide">SDG 16 — Keadilan, Perdamaian &
                            Kelembagaan Kuat</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-[1.1] mb-6">
                        Wujudkan Sekolah yang <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-justice-light to-safe-light">Aman &
                            Adil</span>
                    </h1>
                    <p class="text-lg text-slate-300 max-w-xl mx-auto lg:mx-0 mb-8 leading-relaxed">
                        Platform rahasia untuk melaporkan perundungan, kekerasan, dan pelanggaran etik di lingkungan
                        sekolah. Suaramu dilindungi, laporanmu berarti.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start">
                        <a href="{{ Auth::check() ? route('pelapor.report.create') : route('register') }}"
                            class="btn-primary text-base !py-3.5 !px-8">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            {{ Auth::check() ? 'Buat Pengaduan' : 'Daftar & Laporkan' }}
                        </a>
                        <a href="#tentang"
                            class="btn-outline !border-white/30 !text-white hover:!bg-white/10 text-base !py-3.5 !px-8">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="hidden lg:flex justify-center animate-float">
                    <div class="relative">
                        <div
                            class="w-72 h-72 bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl flex items-center justify-center">
                            <img src="{{ asset('goal-16.png') }}" alt="SDG 16"
                                class="w-56 h-56 object-contain drop-shadow-2xl">
                        </div>
                        <div class="absolute -top-4 -right-4 glass px-4 py-2 animate-pulse-slow">
                            <span class="text-xs font-bold text-emerald-200">100% Rahasia</span>
                        </div>
                        <div class="absolute -bottom-4 -left-4 glass px-4 py-2">
                            <span class="text-xs font-bold text-emerald-200">Dilindungi Hukum</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wave separator -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 100" fill="none" class="w-full">
                <path
                    d="M0 50L48 45C96 40 192 30 288 33C384 37 480 53 576 58C672 63 768 57 864 48C960 40 1056 30 1152 30C1248 30 1344 40 1392 45L1440 50V100H0Z"
                    class="fill-slate-50" />
            </svg>
        </div>
    </section>

    <!-- Tentang Kami -->
    <section id="tentang" class="py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="text-center mb-14">
                <span
                    class="inline-block px-4 py-1 bg-justice/10 text-justice font-bold text-xs uppercase tracking-widest rounded-full mb-4">Tentang
                    Kami</span>
                <h2 class="section-title">Visi, Misi & Sanksi Pelanggaran</h2>
                <p class="section-subtitle mx-auto mt-3">Memahami hak dan perlindungan Anda sebagai siswa di lingkungan
                    sekolah</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <!-- Visi -->
                <div class="card-hover p-7">
                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-midnight-700 mb-3">Visi Hukum</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Mewujudkan lingkungan sekolah yang bebas dari segala
                        bentuk kekerasan, perundungan, dan diskriminasi sesuai amanat Permendikbud No. 82/2015 tentang
                        Pencegahan dan Penanganan Kekerasan di Lingkungan Satuan Pendidikan.</p>
                </div>
                <!-- Misi -->
                <div class="card-hover p-7">
                    <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-midnight-700 mb-3">Misi Perlindungan</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Menyediakan saluran pelaporan yang aman, anonim, dan
                        terlindungi. Setiap laporan ditangani secara profesional oleh Tim BK dan TPPK sekolah dengan standar
                        konfidensialitas tinggi.</p>
                </div>
                <!-- Sanksi -->
                <div class="card-hover p-7">
                    <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-2.694-.833-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-midnight-700 mb-3">Sanksi Pelanggaran</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Pelaku perundungan dikenakan sanksi sesuai tingkat
                        kesalahan: teguran lisan/tertulis, skorsing, pemanggilan orang tua, hingga pelaporan ke pihak
                        berwajib untuk kasus berat yang melanggar hukum.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Cara Kerja -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="text-center mb-14">
                <span
                    class="inline-block px-4 py-1 bg-safe/10 text-safe-dark font-bold text-xs uppercase tracking-widest rounded-full mb-4">Cara
                    Kerja</span>
                <h2 class="section-title">4 Langkah Mudah Melaporkan</h2>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach(['Pilih Kategori', 'Isi Kronologi', 'Upload Bukti', 'Kirim & Pantau'] as $i => $step)
                    <div class="text-center group">
                        <div class="relative inline-flex mb-5">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-justice to-safe rounded-2xl flex items-center justify-center shadow-lg shadow-justice/20 group-hover:scale-110 transition-transform duration-300">
                                <span class="text-2xl font-black text-white">{{ $i + 1 }}</span>
                            </div>
                            @if($i < 3)
                                <svg class="hidden lg:block absolute -right-10 top-1/2 -translate-y-1/2 w-8 h-8 text-slate-200"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            @endif
                        </div>
                        <h3 class="font-bold text-midnight-700 mb-1">{{ $step }}</h3>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Kontak -->
    <section id="kontak" class="py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="text-center mb-14">
                <span
                    class="inline-block px-4 py-1 bg-blue-50 text-blue-600 font-bold text-xs uppercase tracking-widest rounded-full mb-4">Kontak
                    & Saluran</span>
                <h2 class="section-title">Butuh Bantuan Langsung?</h2>
                <p class="section-subtitle mx-auto mt-3">Hubungi saluran darurat berikut jika Anda atau teman Anda dalam
                    bahaya</p>
            </div>
            <div class="grid sm:grid-cols-3 gap-6">
                <div class="card-hover p-7 text-center">
                    <div class="w-16 h-16 bg-justice/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-justice" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-midnight-700 mb-2">Tim BK Sekolah</h3>
                    <p class="text-sm text-slate-500 mb-3">Konseling dan pendampingan psikologis</p>
                    <p class="text-sm font-semibold text-justice">Guru BK Ruang 201</p>
                </div>
                <div class="card-hover p-7 text-center">
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-midnight-700 mb-2">Komite Sekolah</h3>
                    <p class="text-sm text-slate-500 mb-3">Pengawasan dan mediasi eksternal</p>
                    <p class="text-sm font-semibold text-blue-500">Ruang Komite Lantai 1</p>
                </div>
                <div class="card-hover p-7 text-center">
                    <div class="w-16 h-16 bg-red-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-midnight-700 mb-2">TPPK Sekolah</h3>
                    <p class="text-sm text-slate-500 mb-3">Tim Pencegahan & Penanganan Kekerasan</p>
                    <p class="text-sm font-semibold text-red-500">Hotline: 112 / 119</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-midnight-700 text-white py-10">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-justice rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="font-bold">LAPOR EDU</span>
                    <span class="text-slate-400 text-sm">— Platform Pengaduan Sekolah</span>
                </div>
                <p class="text-sm text-slate-400">Berdasarkan SDG 16 & Permendikbud No. 82/2015</p>
            </div>
        </div>
    </footer>
@endsection