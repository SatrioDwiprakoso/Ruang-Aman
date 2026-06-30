@extends('layouts.app')

@section('title', 'Buat Pengaduan - LAPOR EDU!')

@section('content')
    <div class="max-w-2xl mx-auto px-4 py-8 md:py-12">
        <div class="mb-8 animate-slide-up">
            <h1 class="text-2xl md:text-3xl font-extrabold text-midnight-700">Buat Pengaduan Baru</h1>
            <p class="text-slate-500 mt-1">Isi formulir berikut untuk mengirimkan laporan Anda</p>
        </div>

        <div class="card" x-data="multiStepWizard()">
            <div class="px-6 pt-6">
                <div class="flex items-center justify-between mb-2">
                    @foreach(['Kategori', 'Kronologi', 'Bukti', 'Kirim'] as $i => $label)
                        <div class="flex items-center gap-2"
                            :class="step > $i ? 'text-justice' : (step === $i + 1 ? 'text-midnight-700' : 'text-slate-300')">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold transition-all duration-300"
                                :class="step > $i ? 'bg-justice text-white' : (step === $i + 1 ? 'bg-midnight-700 text-white ring-4 ring-midnight-700/20' : 'bg-slate-200 text-slate-400')">
                                <span x-show="step <= {{$i + 1}}">{{ $i + 1 }}</span>
                                <svg x-show="step > {{$i}}" class="w-4 h-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="text-xs font-semibold hidden sm:block">{{ $label }}</span>
                        </div>
                        @if($i < 3)
                            <div class="flex-1 h-0.5 mx-2 rounded-full transition-all duration-300"
                                :class="step > {{$i + 1}} ? 'bg-justice' : 'bg-slate-200'"></div>
                        @endif
                    @endforeach
                </div>
            </div>

            <form method="POST" action="{{ route('pelapor.report.store') }}" enctype="multipart/form-data" class="p-6">
                @csrf

                <!-- Step 1: Kategori -->
                <div x-show="step === 1" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0">
                    <h2 class="text-lg font-bold text-midnight-700 mb-1">Pilih Kategori Pengaduan</h2>
                    <p class="text-sm text-slate-500 mb-5">Pilih jenis kasus yang paling sesuai dengan kejadian</p>
                    <div class="space-y-3">
                        @foreach($categories as $cat)
                            <label
                                class="flex items-start gap-4 p-4 rounded-xl border-2 cursor-pointer transition-all duration-200 hover:border-justice/50"
                                :class="categoryId == {{$cat->id_category}} ? 'border-justice bg-emerald-50/50 shadow-sm' : 'border-slate-100 bg-white'">
                                <input type="radio" name="category_id" value="{{ $cat->id_category }}" x-model="categoryId"
                                    class="mt-1 w-4 h-4 text-justice focus:ring-justice border-slate-300">
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-slate-800 text-sm">{{ $cat->category_name }}</p>
                                    <span style="{{ weightStyle($cat->weight_level) }}">{{ $cat->weight_level }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    <p x-show="errors.category" x-text="errors.category"
                        class="text-sm text-red-500 mt-3 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </p>
                </div>

                <!-- Step 2: Kronologi + ALAMAT BARU -->
                <div x-show="step === 2" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0">
                    <h2 class="text-lg font-bold text-midnight-700 mb-1">Jelaskan Kronologi Kejadian</h2>
                    <p class="text-sm text-slate-500 mb-5">Ceritakan apa yang terjadi secara detail (siapa, kapan, di mana,
                        bagaimana)</p>
                    <div class="space-y-5">
                        <div>
                            <label class="label-field">Judul Pengaduan</label>
                            <input type="text" name="title" x-model="title" class="input-field"
                                placeholder="Contoh: Intimidasi oleh siswa kelas X di koridor" maxlength="200">
                            <div class="flex justify-between mt-1.5">
                                <p x-show="errors.title" x-text="errors.title" class="text-xs text-red-500"></p>
                                <p class="text-xs text-slate-400 ml-auto"><span x-text="title.length"></span>/200</p>
                            </div>
                        </div>
                        <div>
                            <label class="label-field">
                                Alamat / Lokasi Kejadian
                                <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="address" class="input-field"
                                placeholder="Contoh: Koridor lantai 2 dekat ruang BK, gedung utama" maxlength="500"
                                value="{{ old('address') }}">
                            <p class="text-xs text-slate-400 mt-1">Tuliskan lokasi spesifik agar Tim BK mudah
                                menindaklanjuti</p>
                            <p x-show="errors.address" x-text="errors.address" class="text-xs text-red-500 mt-1"></p>
                        </div>
                        <div>
                            <label class="label-field">Kronologi Kejadian</label>
                            <textarea name="chronology" x-model="chronology" rows="8" class="input-field resize-none"
                                placeholder="Jelaskan secara rinci kejadian yang Anda alami atau saksikan. Sebutkan nama pelaku, waktu kejadian, saksi jika ada, dan bentuk kekerasan yang terjadi..."
                                maxlength="5000">{{ old('chronology') }}</textarea>
                            <div class="flex justify-between mt-1.5">
                                <p x-show="errors.chronology" x-text="errors.chronology" class="text-xs text-red-500"></p>
                                <p class="text-xs text-slate-400 ml-auto"><span x-text="chronology.length"></span>/5000</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Bukti -->
                <div x-show="step === 3" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0">
                    <h2 class="text-lg font-bold text-midnight-700 mb-1">Upload Bukti Pendukung</h2>
                    <p class="text-sm text-slate-500 mb-5">Tambahkan foto, screenshot, video, audio, atau dokumen sebagai
                        bukti (opsional)</p>
                    <div
                        class="border-2 border-dashed border-slate-200 rounded-2xl p-8 text-center hover:border-justice/50 transition-colors">
                        <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <p class="text-sm font-medium text-slate-600 mb-1">Klik atau seret file ke sini</p>
                        <p class="text-xs text-slate-400">JPG, PNG, GIF, MP4, MP3, PDF (Maks. 10MB per file)</p>
                        <input type="file" name="evidences[]" multiple accept=".jpg,.jpeg,.png,.gif,.mp4,.mp3,.pdf"
                            class="mt-4 w-full max-w-xs mx-auto text-sm">
                    </div>
                    <p class="text-xs text-slate-400 mt-3 text-center">Anda bisa mengupload lebih dari satu file sekaligus
                    </p>
                </div>

                <!-- Step 4: Anonim & Kirim -->
                <div x-show="step === 4" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0">
                    <h2 class="text-lg font-bold text-midnight-700 mb-1">Konfirmasi & Kirim</h2>
                    <p class="text-sm text-slate-500 mb-5">Periksa kembali dan tentukan opsi anonim</p>
                    <div class="p-5 border-2 border-slate-100 rounded-2xl mb-6">
                        <label class="flex items-start gap-4 cursor-pointer">
                            <div class="relative mt-0.5">
                                <input type="checkbox" name="is_anonymous" value="1" x-model="isAnonymous"
                                    class="sr-only peer">
                                <div
                                    class="w-11 h-6 bg-slate-200 rounded-full peer-focus:ring-4 peer-focus:ring-justice/20 transition-colors peer-checked:bg-justice">
                                </div>
                                <div
                                    class="absolute left-0.5 top-0.5 w-5 h-5 bg-white rounded-full shadow transition-transform peer-checked:translate-x-5">
                                </div>
                            </div>
                            <div>
                                <p class="font-bold text-midnight-700">Kirim sebagai Anonim</p>
                                <p class="text-sm text-slate-500 mt-0.5">Identitas Anda tidak akan ditampilkan kepada admin.
                                    Anda hanya bisa melacak laporan melalui token tiket.</p>
                            </div>
                        </label>
                    </div>
                    <div class="p-5 bg-slate-50 rounded-2xl space-y-3">
                        <h3 class="font-bold text-midnight-700 text-sm">Ringkasan Pengaduan</h3>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Kategori</span>
                            <span class="font-medium text-slate-700 text-right max-w-[60%] truncate"
                                x-text="document.querySelector('input[name=category_id]:checked')?.closest('label')?.querySelector('p')?.textContent || '-'"></span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Judul</span>
                            <span class="font-medium text-slate-700 text-right max-w-[60%] truncate"
                                x-text="title || '-'"></span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Lokasi</span>
                            <span
                                class="font-medium text-slate-700 text-right max-w-[60%] truncate">{{ old('address', '-') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Anonim</span>
                            <span class="font-medium" :class="isAnonymous ? 'text-justice' : 'text-slate-700'"
                                x-text="isAnonymous ? 'Ya' : 'Tidak'"></span>
                        </div>
                    </div>
                    <div class="mt-6 p-4 rounded-xl" style="background:#fffbeb; border:1px solid #fde68a;">
                        <p class="text-xs flex items-start gap-2" style="color:#92400e;">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                            Setelah dikirim, Anda akan mendapat <strong>Token Tiket Unik</strong> untuk melacak status
                            pengaduan. Simpan token tersebut dengan baik.
                        </p>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="flex items-center justify-between mt-8 pt-6 border-t border-slate-100">
                    <button type="button" x-show="step > 1" @click="prevStep" class="btn-ghost">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali
                    </button>
                    <div x-show="step === 1" class="invisible">spacer</div>
                    <button type="button" x-show="step < maxStep" @click="nextStep" class="btn-primary">
                        Lanjut
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    <button type="submit" x-show="step === maxStep" class="btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        Kirim Pengaduan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection