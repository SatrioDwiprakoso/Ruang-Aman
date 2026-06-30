@extends('layouts.app')

@section('title', 'Notifikasi - LAPOR EDU!')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-8 md:py-12">
        <div class="flex items-center justify-between mb-8 animate-slide-up">
            <div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-midnight-700">Notifikasi</h1>
                <p class="text-slate-500 mt-1">Pemberitahuan terbaru dari Tim BK</p>
            </div>
            @if(auth()->user()->unreadNotifications()->count() > 0)
                <form method="POST" action="{{ route('pelapor.notification.readAll') }}" class="flex-shrink-0">
                    @csrf
                    <button type="submit" class="btn-ghost text-xs">Tandai Semua Dibaca</button>
                </form>
            @endif
        </div>

        @if($notifications->count() > 0)
            <div class="space-y-3">
                @foreach($notifications as $notif)
                    <div class="card p-5 flex items-start gap-4" @if(!$notif->is_read)
                    style="border-left: 4px solid #10b981; background: #f0fdf4;" @endif>
                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0" @if(!$notif->is_read)
                        style="background:#d1fae5;" @else style="background:#f1f5f9;" @endif>
                            <svg class="w-5 h-5" @if(!$notif->is_read) style="color:#059669;" @else style="color:#94a3b8;" @endif
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-slate-700 leading-relaxed">{{ $notif->message }}</p>
                            <p class="text-xs text-slate-400 mt-2">{{ formatDate($notif->created_at) }}</p>
                        </div>
                        @if(!$notif->is_read)
                            <form method="POST" action="{{ route('pelapor.notification.read', $notif->id_notification) }}"
                                class="flex-shrink-0">
                                @csrf
                                <button type="submit" class="text-xs font-semibold transition-colors" style="color:#059669;">Tandai
                                    Dibaca</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="mt-6">{{ $notifications->links() }}</div>
        @else
            <div class="text-center py-20">
                <div class="w-20 h-20 bg-slate-100 rounded-3xl flex items-center justify-center mx-auto mb-5">
                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-400 mb-2">Tidak Ada Notifikasi</h3>
                <p class="text-sm text-slate-400">Semua notifikasi sudah dibaca atau belum ada</p>
            </div>
        @endif
    </div>
@endsection