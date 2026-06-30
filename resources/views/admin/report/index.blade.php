@extends('layouts.admin')

@section('page-title', 'Data Pengaduan')

@section('content')
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <div class="relative w-full sm:w-80">
            <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <form method="GET" action="{{ route('admin.report.index') }}" class="flex">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul atau token..."
                    class="input-field !pl-10 !rounded-r-none !text-sm flex-1">
                <button type="submit" class="btn-secondary !rounded-l-none !px-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <div class="flex gap-2 overflow-x-auto pb-2 mb-6">
        @foreach(['Semua', 'Pending', 'Diproses', 'Selesai', 'Ditolak'] as $filter)
            <a href="{{ request()->fullUrlWithQuery(['status' => $filter === 'Semua' ? null : $filter, 'search' => request('search') ?: null, 'page' => null]) }}"
                class="flex-shrink-0 px-4 py-2 rounded-full text-sm font-semibold transition-all duration-200 whitespace-nowrap
                      {{ (request('status') ?: 'Semua') === $filter ? 'bg-midnight-700 text-white shadow-lg shadow-midnight-700/25' : 'bg-white text-slate-500 border border-slate-200 hover:border-slate-300' }}">
                {{ $filter }}
            </a>
        @endforeach
    </div>

    @if($reports->count() > 0)
        <div class="space-y-3">
            @foreach($reports as $report)
                <a href="{{ route('admin.report.show', $report->id_report) }}" class="card-hover p-5 block">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center gap-2 mb-2">
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
                            <h3 class="font-bold text-midnight-700 truncate">{{ $report->title }}</h3>
                            <p class="text-xs text-slate-400 mt-1">{{ $report->category->category_name }}</p>
                        </div>
                        <div class="text-left sm:text-right flex-shrink-0 space-y-1">
                            <p class="text-xs text-slate-400">{{ formatDate($report->created_at) }}</p>
                            <p class="text-xs font-mono text-justice">{{ $report->tracking_token }}</p>
                            <p class="text-xs text-slate-500">
                                {{ $report->is_anonymous ? 'Pelapor Anonim' : $report->user->username }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="mt-6">{{ $reports->links() }}</div>
    @else
        <div class="text-center py-20">
            <div class="w-20 h-20 bg-slate-100 rounded-3xl flex items-center justify-center mx-auto mb-5">
                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-400 mb-2">Tidak Ada Pengaduan</h3>
            <p class="text-sm text-slate-400">Belum ada laporan yang masuk dengan filter ini</p>
        </div>
    @endif
@endsection