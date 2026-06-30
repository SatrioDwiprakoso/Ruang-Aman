@extends('layouts.app')

@section('title', 'Detail Pengaduan - LAPOR EDU!')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-8 md:py-12">
        <a href="{{ route('pelapor.report.index') }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-midnight-700 mb-6 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Riwayat
        </a>

        @php
            $sc = statusColor($report->status);
            $isDitolak = $report->status === 'Ditolak';
            $statuses = ['Pending', 'Diproses', 'Selesai'];
            $currentIdx = array_search($report->status, $statuses);
            if ($currentIdx === false)
                $currentIdx = -1;
        @endphp

        <!-- Status Timeline Tracker -->
        <div class="card p-6 mb-6 animate-slide-up">
            <div class="flex items-center justify-between relative">
                @foreach($statuses as $i => $st)
                    <div class="flex flex-col items-center relative z-10 flex-1">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center transition-all duration-500
                            {{ $isDitolak ? 'bg-red-100 text-red' : ($i <= $currentIdx ? 'bg-justice text-white shadow-lg shadow-justice/30' : 'bg-slate-100 text-slate-300') }}">
                            @if($i < $currentIdx && !$isDitolak)
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            @elseif($isDitolak)
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            @else
                                <span class="text-sm font-bold">{{ $i + 1 }}</span>
                            @endif
                        </div>
                        <span class="text-xs font-bold mt-2 {{ $i <= $currentIdx && !$isDitolak ? 'text-justice' : ($isDitolak ? 'text-red' : 'text-slate-300') }}">
                            {{ $st }}
                        </span>
                    </div>
                    @if($i < 2)
                        <div class="flex-1 h-1 rounded-full -mx-2 transition-all duration-500
                            {{ $isDitolak ? 'bg-red-200' : ($i < $currentIdx ? 'bg-justice' : 'bg-slate-200') }}"></div>
                    @endif
                @endforeach
            </div>
            @if($isDitolak)
                <div class="mt-4 p-3 bg-red-light border border-red rounded-xl text-center">
                    <p class="text-sm font-semibold text-red">Pengaduan ini telah ditolak oleh Tim BK</p>
                </div>
            @endif
        </div>

            <!-- Detail -->
    <div class="card p-6 mb-6 animate-slide-up">
    <div class="flex flex-wrap items-center gap-2 mb-4">
                <span style="{{ weightStyle($report->category->weight_level) }}">{{ $report->category->weight_level }}</span>
                <span style="{{ statusStyle($report->status) }}">{{ $report->status }}</span>
                @if($report->is_anonymous)
                <span style="{{ anonimStyle() }}">
                    <svg style="width:12px; height:12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    Anonim
                </span>
                @endif
            </div>
        <h1 class="text-xl font-extrabold text-midnight-700 mb-4">{{ $report->title }}</h1>
        <div class="space-y-3 mb-6">
            <div class="flex items-start gap-3 text-sm">
                <span class="text-slate-400 w-24 flex-shrink-0 pt-0.5">Kategori</span>
                <span class="font-medium text-slate-700">{{ $report->category->category_name }}</span>
            </div>
            <div class="flex items-start gap-3 text-sm">
                <span class="text-slate-400 w-24 flex-shrink-0 pt-0.5">Lokasi</span>
                <span class="font-medium text-slate-700">{{ $report->address }}</span>
            </div>
            <div class="flex items-center gap-3 text-sm">
                <span class="text-slate-400 w-24 flex-shrink-0">Tanggal</span>
                <span class="font-medium text-slate-700">{{ formatDate($report->created_at) }}</span>
            </div>
            <div class="flex items-center gap-3 text-sm">
                <span class="text-slate-400 w-24 flex-shrink-0">Token Tiket</span>
                <span class="font-mono font-bold text-justice bg-emerald-50 px-3 py-1 rounded-lg">{{ $report->tracking_token }}</span>
            </div>
        </div>

        <!-- Tombol Cetak Surat -->
        <div class="border-t border-slate-100 pt-4 mb-5">
            <a href="{{ route('pelapor.surat.cetak', $report->id_report) }}" target="_blank" class="btn-outline text-sm !py-2.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
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
            <div class="card p-6 mb-6 animate-slide-up">
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
                                    <img src="{{ $fileUrl }}" alt="Bukti" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                </a>
                            </div>
                        @else
                            <a href="{{ $fileUrl }}" target="_blank" class="aspect-square rounded-xl bg-slate-50 border border-slate-200 flex flex-col items-center justify-center gap-2 hover:shadow-lg hover:border-justice/30 transition-all p-4">
                                @if(in_array($ext, ['mp4', 'avi', 'mkv', 'mov']))
                                    <svg class="w-10 h-10 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    <span class="text-xs text-blue-500 font-medium uppercase">{{ $ext }}</span>
                                @elseif(in_array($ext, ['mp3', 'wav', 'ogg', 'aac']))
                                    <svg class="w-10 h-10 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/></svg>
                                    <span class="text-xs text-purple-500 font-medium uppercase">{{ $ext }}</span>
                                @elseif($ext === 'pdf')
                                    <svg class="w-10 h-10 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                    <span class="text-xs text-red-500 font-medium uppercase">PDF</span>
                                @else
                                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    <span class="text-xs text-slate-500 font-medium uppercase">{{ $ext }}</span>
                                @endif
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Admin Responses -->
        <div class="card p-6 animate-slide-up">
            <h3 class="font-bold text-midnight-700 mb-4">Tanggapan Tim BK</h3>
            @if($report->feedbackResponses->count() > 0)
                <div class="space-y-4">
                    @foreach($report->feedbackResponses as $response)
                        <div class="flex gap-3">
                            <div class="w-10 h-10 bg-blue-light rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                            <div class="flex-1 bg-slate-50 rounded-2xl rounded-tl-sm p-4">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-sm font-bold text-midnight-700">{{ $response->admin->username }}</span>
                                    <span class="text-xs text-slate-400">{{ formatDate($response->created_at) }}</span>
                                </div>
                                <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line">{{ $response->response_text }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="w-12 h-12 text-slate-200 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    <p class="text-sm text-slate-400">Belum ada tanggapan dari Tim BK</p>
                </div>
            @endif
        </div>
    </div>
@endsection