@extends('layouts.admin')

@section('page-title', 'Kelola Kategori')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-slate-500">{{ $categories->count() }} kategori terdaftar</p>
        <a href="{{ route('admin.kategori.create') }}" class="btn-primary text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Kategori
        </a>
    </div>

    @if($categories->count() > 0)
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($categories as $cat)
                @php $wc = weightColor($cat->weight_level); @endphp
                <div class="card p-5">
                    <div class="flex items-start justify-between mb-3">
                        <span style="{{ weightStyle($cat->weight_level) }}">{{ $cat->weight_level }}</span>
                        <div class="flex items-center gap-1">
                            <a href="{{ route('admin.kategori.edit', $cat->id_category) }}"
                                class="p-1.5 rounded-lg hover:bg-slate-100 text-slate-400 hover:text-midnight-700 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('admin.kategori.destroy', $cat->id_category) }}"
                                onsubmit="return confirm('Hapus kategori ini?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="p-1.5 rounded-lg hover:bg-red-light text-slate-400 hover:text-red transition-colors" {{ $cat->reports_count > 0 ? 'disabled title="Tidak bisa dihapus"' : '' }}>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <h3 class="font-bold text-midnight-700 text-sm leading-snug">{{ $cat->category_name }}</h3>
                    <p class="text-xs text-slate-400 mt-2">{{ $cat->reports_count }} pengaduan terkait</p>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-20">
            <div class="w-20 h-20 bg-slate-100 rounded-3xl flex items-center justify-center mx-auto mb-5">
                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-400 mb-2">Belum Ada Kategori</h3>
            <p class="text-sm text-slate-400 mb-6">Tambahkan kategori pengaduan pertama</p>
            <a href="{{ route('admin.kategori.create') }}" class="btn-primary">Tambah Kategori</a>
        </div>
    @endif
@endsection