@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="card p-5">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background:#fffbeb;">
                <svg class="w-5 h-5" style="color:#d97706;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <p class="text-2xl font-extrabold text-midnight-700">{{ $totalPending }}</p>
            <p class="text-xs text-slate-500 font-medium mt-0.5">Menunggu Diproses</p>
        </div>
        <div class="card p-5">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background:#eff6ff;">
                <svg class="w-5 h-5" style="color:#2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
            </div>
            <p class="text-2xl font-extrabold text-midnight-700">{{ $totalDiproses }}</p>
            <p class="text-xs text-slate-500 font-medium mt-0.5">Sedang Diproses</p>
        </div>
        <div class="card p-5">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background:#ecfdf5;">
                <svg class="w-5 h-5" style="color:#059669;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <p class="text-2xl font-extrabold text-midnight-700">{{ $totalSelesai }}</p>
            <p class="text-xs text-slate-500 font-medium mt-0.5">Selesai Ditangani</p>
        </div>
        <div class="card p-5">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background:#f1f5f9;">
                <svg class="w-5 h-5 text-midnight-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <p class="text-2xl font-extrabold text-midnight-700">{{ $totalKasus }}</p>
            <p class="text-xs text-slate-500 font-medium mt-0.5">Total Keseluruhan</p>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Chart -->
        <div class="lg:col-span-2 card p-6">
            <h2 class="text-lg font-bold text-midnight-700 mb-5">Tren Kasus Bulan Ini per Kategori</h2>
            @if($chartData->sum('reports_count') > 0)
                <div class="space-y-4">
                    @foreach($chartData as $cat)
                        @php $maxCount = $chartData->max('reports_count') ?: 1;
                        $barWidth = max(($cat->reports_count / $maxCount) * 100, 4); @endphp
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <span
                                    class="text-sm font-medium text-slate-700 truncate max-w-[70%]">{{ $cat->category_name }}</span>
                                <div class="flex items-center gap-2 flex-shrink-0">
                                    @if($cat->reports_count == 0)
                                        <span class="text-xs font-bold text-slate-300">0</span>
                                    @else
                                        <span class="text-sm font-bold text-midnight-700">{{ $cat->reports_count }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="w-full h-4 rounded-full overflow-hidden" style="background:#f1f5f9;">
                                <div class="h-full rounded-full transition-all duration-700"
                                    style="width: {{ $barWidth }}%; background: {{ weightBarColor($cat->weight_level) }}; {{ $cat->reports_count == 0 ? 'opacity:0.3' : '' }}">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-10">
                    <p class="text-sm text-slate-400">Belum ada data kasus bulan ini</p>
                </div>
            @endif
        </div>

        <!-- Laporan Terbaru -->
        <div class="card p-6">
            <h2 class="text-lg font-bold text-midnight-700 mb-5">Laporan Terbaru</h2>
            @if($recentReports->count() > 0)
                <div class="space-y-3">
                    @foreach($recentReports as $recentReport)
                        <a href="{{ route('admin.report.show', $recentReport->id_report) }}"
                            class="block p-3 rounded-xl bg-slate-50 hover:bg-slate-100 transition-colors">
                            <div class="flex items-center gap-2 mb-1">
                                <span style="{{ statusStyle($recentReport->status) }}">{{ $recentReport->status }}</span>
                                <span
                                    style="{{ weightStyle($recentReport->category->weight_level) }}">{{ $recentReport->category->weight_level }}</span>
                            </div>
                            <p class="text-sm font-semibold text-midnight-700 truncate">{{ $recentReport->title }}</p>
                            <p class="text-xs text-slate-400 mt-1">
                                {{ $recentReport->is_anonymous ? 'Anonim' : $recentReport->user->username }} ·
                                {{ $recentReport->created_at->diffForHumans() }}</p>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-10">
                    <p class="text-sm text-slate-400">Belum ada laporan masuk</p>
                </div>
            @endif
        </div>
    </div>
@endsection