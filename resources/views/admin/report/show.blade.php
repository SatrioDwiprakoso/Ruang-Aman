@extends('layouts.admin')

@section('page-title', 'Detail Pengaduan')

@section('content')
    <a href="{{ route('admin.report.index') }}"
        class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-midnight-700 mb-6 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke Daftar
    </a>

    @php
        $isDitolak = $report->status === 'Ditolak';
        $statuses = ['Pending', 'Diproses', 'Selesai'];
        $currentIdx = array_search($report->status, $statuses);
        if ($currentIdx === false)
            $currentIdx = -1;
    @endphp

    <!-- Timeline -->
    <div class="card p-6 mb-6">
        <div class="flex items-center justify-between relative">
            @foreach($statuses as $i => $st)
                @php
                    $done = $i < $currentIdx && !$isDitolak;
                    $active = $i === $currentIdx && !$isDitolak;
                    $dotBg = $isDitolak ? 'background:#fee2e2;' : ($done || $active ? 'background:#10b981;' : 'background:#e2e8f0;');
                    $dotText = $isDitolak ? 'color:#dc2626;' : ($done || $active ? 'color:#fff;' : 'color:#94a3b8;');
                    $labelColor = $isDitolak ? 'color:#dc2626;' : ($done || $active ? 'color:#10b981;' : 'color:#cbd5e1;');
                    $lineColor = $isDitolak ? 'background:#fecaca;' : ($i < $currentIdx ? 'background:#10b981;' : 'background:#e2e8f0;');
                @endphp
                <div class="flex flex-col items-center relative z-10 flex-1">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center transition-all duration-500 shadow-sm"
                        style="{{ $dotBg }}{{ $dotText }}">
                        @if($done)
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
                        @elseif($isDitolak)
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        @else
                            <span class="text-sm font-bold">{{ $i + 1 }}</span>
                        @endif
                    </div>
                    <span class="text-xs font-bold mt-2" style="{{ $labelColor }}">{{ $st }}</span>
                </div>
                @if($i < 2)
                    <div class="flex-1 h-1 rounded-full -mx-2 transition-all duration-500" style="{{ $lineColor }}"></div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <!-- Detail -->
            <div class="card p-6">
                <div class="flex flex-wrap items-center gap-2 mb-4">
                    <span
                        style="{{ weightStyle($report->category->weight_level) }}">{{ $report->category->weight_level }}</span>
                    <span style="{{ statusStyle($report->status) }}">{{ $report->status }}</span>
                    @if($report->is_anonymous)
                        <span style="{{ anonimStyle() }}">
                            <svg style="width:12px; height:12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Anonim
                        </span>
                    @endif
                </div>
                <h1 class="text-xl font-extrabold text-midnight-700 mb-4">{{ $report->title }}</h1>
                <div class="space-y-3 mb-6">
                    <div class="flex items-start gap-3 text-sm">
                        <span class="text-slate-400 w-28 flex-shrink-0 pt-0.5">Kategori</span>
                        <span class="font-medium text-slate-700">{{ $report->category->category_name }}</span>
                    </div>
                    <div class="flex items-start gap-3 text-sm">
                        <span class="text-slate-400 w-28 flex-shrink-0 pt-0.5">Lokasi</span>
                        <span class="font-medium text-slate-700">{{ $report->address }}</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <span class="text-slate-400 w-28 flex-shrink-0">Tanggal</span>
                        <span class="font-medium text-slate-700">{{ formatDate($report->created_at) }}</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <span class="text-slate-400 w-28 flex-shrink-0">Token Tiket</span>
                        <span
                            class="font-mono font-bold text-justice bg-emerald-50 px-3 py-1 rounded-lg">{{ $report->tracking_token }}</span>
                    </div>
                    <div class="flex items-start gap-3 text-sm">
                        <span class="text-slate-400 w-28 flex-shrink-0 pt-0.5">Pelapor</span>
                        <span
                            class="font-medium text-slate-700">{{ $report->is_anonymous ? 'Identitas dilindungi' : $report->user->username . ' (' . $report->user->email . ')' }}</span>
                    </div>
                </div>
                <div class="border-t border-slate-100 pt-4 mb-5">
                    <a href="{{ route('admin.surat.cetak', $report->id_report) }}" target="_blank"
                        class="btn-outline text-sm !py-2 !px-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Cetak Surat PDF
                    </a>
                </div>
                <div class="border-t border-slate-100 pt-5">
                    <h3 class="font-bold text-midnight-700 mb-2">Kronologi Kejadian</h3>
                    <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line">{{ $report->chronology }}</p>
                </div>
            </div>

            <!-- Evidences -->
            @if($report->evidences->count() > 0)
                <div class="card p-6">
                    <h3 class="font-bold text-midnight-700 mb-4">Bukti Pendukung ({{ $report->evidences->count() }})</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach($report->evidences as $evidence)
                            @php
                                $filePath = $evidence->file_path;
                                $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                                $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                $fileUrl = asset('storage/' . $filePath);
                            @endphp
                            @if($isImage)
                                <div class="aspect-square rounded-xl overflow-hidden bg-slate-100 border border-slate-200">
                                    <a href="{{ $fileUrl }}" target="_blank" class="block w-full h-full">
                                        <img src="{{ $fileUrl }}" alt="Bukti"
                                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                    </a>
                                </div>
                            @else
                                <a href="{{ $fileUrl }}" target="_blank"
                                    class="aspect-square rounded-xl bg-slate-50 border border-slate-200 flex flex-col items-center justify-center gap-2 hover:shadow-lg hover:border-justice/30 transition-all p-4">
                                    @if(in_array($ext, ['mp4', 'avi', 'mkv', 'mov']))
                                        <svg class="w-10 h-10" style="color:#3b82f6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-xs font-medium uppercase" style="color:#2563eb;">{{ $ext }}</span>
                                    @elseif(in_array($ext, ['mp3', 'wav', 'ogg', 'aac']))
                                        <svg class="w-10 h-10" style="color:#a855f7;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                        </svg>
                                        <span class="text-xs font-medium uppercase" style="color:#7c3aed;">{{ $ext }}</span>
                                    @elseif($ext === 'pdf')
                                        <svg class="w-10 h-10" style="color:#ef4444;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-xs font-medium uppercase" style="color:#dc2626;">PDF</span>
                                    @else
                                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <span class="text-xs text-slate-500 font-medium uppercase">{{ $ext }}</span>
                                    @endif
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Riwayat Tanggapan -->
            <div class="card p-6">
                <h3 class="font-bold text-midnight-700 mb-4">Riwayat Tanggapan</h3>
                @if($report->feedbackResponses->count() > 0)
                    <div class="space-y-4">
                        @foreach($report->feedbackResponses as $response)
                            <div class="flex gap-3">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0"
                                    style="background:#dbeafe;">
                                    <svg class="w-5 h-5" style="color:#2563eb;" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div class="flex-1 bg-slate-50 rounded-2xl rounded-tl-sm p-4">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="text-sm font-bold text-midnight-700">{{ $response->admin->username }}</span>
                                        <span class="text-xs text-slate-400">{{ formatDate($response->created_at) }}</span>
                                    </div>
                                    <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line">
                                        {{ $response->response_text }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-slate-400 text-center py-6">Belum ada tanggapan</p>
                @endif
            </div>
        </div>

        <!-- Form Tanggapan - PERBAIKAN LAYOUT -->
        <div>
            <div class="card p-5 lg:sticky lg:top-20" style="max-height: calc(100vh - 120px); overflow-y: auto;">
                <h3 class="font-bold text-midnight-700 mb-4 text-base">Berikan Tanggapan</h3>
                <form method="POST" action="{{ route('admin.report.tanggapan', $report->id_report) }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="label-field">Ubah Status</label>
                        <select name="status" class="input-field text-sm !py-2.5" required>
                            <option value="Diproses" {{ $report->status === 'Diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="Selesai" {{ $report->status === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Ditolak" {{ $report->status === 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <div>
                        <label class="label-field">Isi Tanggapan</label>
                        <textarea name="response_text" rows="5" class="input-field resize-none text-sm"
                            placeholder="Tuliskan tindakan yang telah diambil..." required></textarea>
                    </div>
                    <button type="submit" class="btn-primary w-full text-sm !py-2.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        Kirim Tanggapan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection